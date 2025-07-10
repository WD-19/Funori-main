<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class CheckoutController
{
    /**
     * Hiển thị trang thanh toán duy nhất (One-Page Checkout).
     */
    public function index()
    {
        $cart = Session::get('cart');

        // Kiểm tra giỏ hàng có trống không
        if (empty($cart['items'])) {
            return redirect()->route('client.view-cart')
                ->with('error', 'Giỏ hàng trống!');
        }

        // Lấy thông tin cần thiết cho trang checkout
       $addresses = Auth::check()
            ? json_decode(Auth::user()->addresses, true) ?? []
            : [];
        $paymentMethods  = PaymentMethod::all();
        $shippingMethods = ShippingMethod::all();

        // Trả về view checkout duy nhất với tất cả dữ liệu
        return view('client.checkout.index', compact(
            'cart',
            'addresses',
            'paymentMethods',
            'shippingMethods'
        ));
    }

    /**
     * Xử lý đơn hàng từ trang checkout duy nhất.
     */
    public function processCheckout(Request $request)
    {
        // Validate toàn bộ dữ liệu từ form
        $validatedData = $request->validate([
            'customer_name'      => 'required|string|max:255',
            'customer_phone'     => 'required|string|max:20',
            'customer_email'     => 'required|email|max:255',
            'shipping_address'   => 'required|string|max:255',
            'province'           => 'required|string',
            'district'           => 'required|string',
            'ward'               => 'required|string',
            'payment_method_id'  => 'required|exists:payment_methods,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'customer_note'      => 'nullable|string',
        ]);

        $cart = Session::get('cart');
        if (empty($cart['items'])) {
            return redirect()->route('client.view-cart')->with('error', 'Giỏ hàng của bạn đã trống!');
        }

        // --- START: Xác thực lại giỏ hàng trước khi xử lý ---
        foreach ($cart['items'] as $key => $item) {
            // Lấy tên sản phẩm từ session một cách an toàn để hiển thị lỗi
            $productName = $item['product']['name'] ?? 'Một sản phẩm';

            $product = Product::find($item['product_id']);

            // 1. Kiểm tra sản phẩm có tồn tại không
            if (!$product) {
                return redirect()->route('client.view-cart')->with('error', "Sản phẩm '{$productName}' không còn tồn tại. Vui lòng xóa khỏi giỏ hàng và thử lại.");
            }

            // 2. Kiểm tra biến thể và số lượng tồn kho
            if ($item['product_variant_id']) {
                $variant = ProductVariant::find($item['product_variant_id']);
                if (!$variant) {
                    return redirect()->route('client.view-cart')->with('error', "Một tùy chọn của sản phẩm '{$productName}' không còn tồn tại. Vui lòng xóa và chọn lại.");
                }
                if ($variant->stock_quantity < $item['quantity']) {
                    return redirect()->route('client.view-cart')->with('error', "Sản phẩm '{$productName}' không đủ số lượng trong kho (còn {$variant->stock_quantity}). Vui lòng cập nhật lại giỏ hàng.");
                }
            } else {
                if ($product->stock_quantity < $item['quantity']) {
                    return redirect()->route('client.view-cart')->with('error', "Sản phẩm '{$productName}' không đủ số lượng trong kho (còn {$product->stock_quantity}). Vui lòng cập nhật lại giỏ hàng.");
                }
            }
        }
        // --- END: Xác thực lại giỏ hàng ---

        DB::beginTransaction();
        try {
            // Lấy thông tin phí vận chuyển từ DB
            $shippingMethod = ShippingMethod::find($validatedData['shipping_method_id']);
            $shippingFee = $shippingMethod ? $shippingMethod->cost : 0;

            // Tính toán lại tổng tiền cuối cùng
            $subtotal = $cart['total']; // Giả sử 'total' từ cart() là subtotal
            $tax = 0; // Hoặc tính toán lại nếu cần
            $discount = 0; // Hoặc tính toán lại nếu cần
            $totalAmount = $subtotal + $shippingFee + $tax - $discount;

            // Ghép địa chỉ đầy đủ từ các trường
            $fullShippingAddress = implode(', ', array_filter([
                $validatedData['shipping_address'],
                $validatedData['ward'],
                $validatedData['district'],
                $validatedData['province'],
            ]));

            $orderData = [
                'order_code'         => 'ORD-' . strtoupper(uniqid()),
                'customer_name'      => $validatedData['customer_name'],
                'customer_phone'     => $validatedData['customer_phone'],
                'customer_email'     => $validatedData['customer_email'],
                'shipping_address'   => $fullShippingAddress, // Lưu địa chỉ đầy đủ
                'province'           => $validatedData['province'],
                'district'           => $validatedData['district'],
                'ward'               => $validatedData['ward'],
                'customer_note'      => $validatedData['customer_note'],
                'payment_method_id'  => $validatedData['payment_method_id'],
                'shipping_method_id' => $validatedData['shipping_method_id'],
                'subtotal_amount'    => $subtotal, 'tax_amount'         => $tax, 'shipping_fee'       => $shippingFee, 'discount_amount'    => $discount, 'total_amount'       => $totalAmount, 'order_status'      => 'pending_confirmation',

                // Đồng bộ thông tin người mua (buyer) và người nhận (shipping) với thông tin khách hàng từ form
                // để đảm bảo dữ liệu nhất quán trên toàn hệ thống (hóa đơn, trang admin, v.v.)
                'buyer_name'         => $validatedData['customer_name'],
                'buyer_phone'        => $validatedData['customer_phone'],
                'buyer_email'        => $validatedData['customer_email'],
                'buyer_address'      => $fullShippingAddress,
                'shipping_name'      => $validatedData['customer_name'],
                'shipping_phone'     => $validatedData['customer_phone'],
                'shipping_email'     => $validatedData['customer_email'],
            ];

             if (Auth::check()) {
                $orderData['user_id'] = Auth::id();
            }
            $order = Order::create($orderData);

            foreach ($cart['items'] as $item) {
                OrderItem::create([
                    'order_id'           => $order->id,
                    'product_id'         => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity'           => $item['quantity'],
                    'price'              => $item['price_at_addition'],
                    'subtotal'           => $item['price_at_addition'] * $item['quantity'], // Thêm subtotal
                    'product_name'       => $item['product']['name'],
                ]);

                // --- START: Cập nhật kho hàng an toàn (chống race condition) ---
                if ($item['product_variant_id']) {
                    $updated = ProductVariant::where('id', $item['product_variant_id'])
                        ->where('stock_quantity', '>=', $item['quantity'])
                        ->decrement('stock_quantity', $item['quantity']);
                    if (!$updated) {
                        throw new \Exception("Sản phẩm '{$item['product']['name']}' đã hết hàng hoặc không đủ số lượng.");
                    }
                } else {
                    $updated = Product::where('id', $item['product_id'])
                        ->where('stock_quantity', '>=', $item['quantity'])
                        ->decrement('stock_quantity', $item['quantity']);
                    if (!$updated) {
                        throw new \Exception("Sản phẩm '{$item['product']['name']}' đã hết hàng hoặc không đủ số lượng.");
                    }
                }
                // --- END: Cập nhật kho hàng an toàn ---
            }

            Session::forget('cart');
            DB::commit();

            return redirect()->route('client.checkout.success', ['order' => $order->id])
                ->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Ghi log lỗi để debug
            // Log::error('Checkout Error: ' . $e->getMessage());
            // Kiểm tra xem có phải lỗi do hết hàng không để đưa ra thông báo cụ thể
            if (str_contains($e->getMessage(), 'hết hàng') || str_contains($e->getMessage(), 'không đủ số lượng')) {
                return redirect()->route('client.view-cart')->with('error', $e->getMessage());
            }
            
            return back()->withInput()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        if (!session('success')) {
            return redirect()->route('home');
        }

        $order = null;
        if ($request->has('order')) {
            $order = Order::with(['items.product.thumbnail', 'items.productVariant', 'paymentMethod', 'shippingMethod'])
                ->find($request->query('order'));
        }
        return view('client.checkout.success', compact('order'));
    }
}
