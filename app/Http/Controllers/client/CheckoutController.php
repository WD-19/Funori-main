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
     * Prepares the cart for checkout by filtering only selected items.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prepareCheckout(Request $request)
    {
        $selectedItemIds = $request->input('selected_items', []);

        if (empty($selectedItemIds)) {
            return redirect()->route('client.view-cart')->with('error', 'Vui lòng chọn sản phẩm để thanh toán.');
        }

        // Get the full cart items from the session, which were set by CartController
        $fullCartItems = Session::get('cart.items', []);
        if (empty($fullCartItems)) {
            return redirect()->route('client.view-cart')->with('error', 'Giỏ hàng của bạn đã trống.');
        }

        $selectedItems = [];
        $newTotal = 0;

        // Filter the cart items based on the IDs of the selected checkboxes
        foreach ($fullCartItems as $item) {
            if (in_array($item['id'], $selectedItemIds)) {
                $selectedItems[] = $item;
                $newTotal += $item['quantity'] * $item['price_at_addition'];
            }
        }

        if (empty($selectedItems)) {
            return redirect()->route('client.view-cart')->with('error', 'Sản phẩm bạn chọn không hợp lệ.');
        }

        // Overwrite the session cart with ONLY the selected items for the checkout process.
        Session::put('cart.items', $selectedItems);
        Session::put('cart.total', $newTotal);

        // Now, redirect to the actual checkout page
        return redirect()->route('client.checkout.index');
    }
    /**
     * Hiển thị trang thanh toán duy nhất (One-Page Checkout).
     */
    public function index()
    {
        $cart = [
            'items' => Session::get('cart.items', []),
            'total' => Session::get('cart.total', 0),
            'discount' => Session::get('cart.discount', 0),
            'discount_code' => Session::get('cart.discount_code', null),
        ];

        if (empty($cart['items'])) {
            return redirect()->route('client.view-cart')->with('error', 'Giỏ hàng trống hoặc chưa chọn sản phẩm để thanh toán!');
        }

        // Lấy thông tin cần thiết cho trang checkout
        $addresses = Auth::check()
            ? Auth::user()->addresses // Lấy collection các địa chỉ đã lưu
            : collect(); // Trả về collection rỗng nếu chưa đăng nhập
        $paymentMethods  = PaymentMethod::where('is_active', 1)->get();
        $shippingMethods = ShippingMethod::where('is_active', 1)->get();

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
        $rules = [
            // Thông tin người mua (thanh toán)
            'buyer_name'         => 'required|string|max:255',
            'buyer_phone'        => 'required|string|max:20',
            'buyer_email'        => 'required|email|max:255',
            'buyer_address'      => 'required|string|max:255',
            'buyer_province'     => 'required|string',
            'buyer_district'     => 'required|string',
            'buyer_ward'         => 'required|string',

            // Thông tin chung
            'payment_method_id'  => 'required|exists:payment_methods,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'customer_note'      => 'nullable|string',
            'ship_to_different_address' => 'nullable|string', // Chấp nhận giá trị 'on' từ checkbox
        ];

        // Thêm validation cho địa chỉ giao hàng nếu checkbox được chọn
        if ($request->filled('ship_to_different_address')) {
            $rules += [
                'shipping_name'    => 'required|string|max:255',
                'shipping_phone'   => 'required|string|max:20',
                'shipping_email'   => 'required|email|max:255',
                'shipping_address' => 'required|string|max:255',
                'shipping_province' => 'required|string',
                'shipping_district' => 'required|string',
                'shipping_ward'    => 'required|string',
            ];
        }

        // Thêm thông báo lỗi và tên thuộc tính tùy chỉnh để người dùng dễ hiểu
        $messages = [
            'required' => 'Vui lòng nhập :attribute.',
            'email'    => 'Địa chỉ email không hợp lệ.',
            'exists'   => 'Phương thức đã chọn không hợp lệ.',

            // Buyer info
            'buyer_name.required' => 'Vui lòng nhập họ tên người mua.',
            'buyer_phone.required' => 'Vui lòng nhập số điện thoại người mua.',
            'buyer_email.required' => 'Vui lòng nhập email người mua.',
            'buyer_address.required' => 'Vui lòng nhập địa chỉ cụ thể của người mua.',
            'buyer_province.required' => 'Vui lòng chọn Tỉnh/Thành phố của người mua.',
            'buyer_district.required' => 'Vui lòng chọn Quận/Huyện của người mua.',
            'buyer_ward.required' => 'Vui lòng chọn Phường/Xã của người mua.',

            // Shipping info
            'shipping_name.required' => 'Vui lòng nhập họ tên người nhận.',
            'shipping_phone.required' => 'Vui lòng nhập số điện thoại người nhận.',
            'shipping_email.required' => 'Vui lòng nhập email người nhận.',
            'shipping_address.required' => 'Vui lòng nhập địa chỉ cụ thể của người nhận.',
            'shipping_province.required' => 'Vui lòng chọn Tỉnh/Thành phố của người nhận.',
            'shipping_district.required' => 'Vui lòng chọn Quận/Huyện của người nhận.',
            'shipping_ward.required' => 'Vui lòng chọn Phường/Xã của người nhận.',

            // Methods
            'payment_method_id.required' => 'Vui lòng chọn phương thức thanh toán.',
            'shipping_method_id.required' => 'Vui lòng chọn phương thức vận chuyển.',
        ];

        $attributes = [
            'buyer_name' => 'họ tên người mua',
            'buyer_phone' => 'số điện thoại người mua',
            'buyer_email' => 'email người mua',
            'buyer_address' => 'địa chỉ người mua',
            'shipping_name' => 'họ tên người nhận',
            'shipping_phone' => 'số điện thoại người nhận',
            'shipping_email' => 'email người nhận',
            'shipping_address' => 'địa chỉ người nhận',
        ];

        $validatedData = $request->validate($rules, $messages, $attributes);

        $cart = [
            'items' => Session::get('cart.items', []),
            'total' => Session::get('cart.total', 0),
            'discount' => Session::get('cart.discount', 0),
            'discount_code' => Session::get('cart.discount_code', null),
        ];

        if (empty($cart['items'])) {
            return redirect()->route('client.view-cart')->with('error', 'Giỏ hàng của bạn đã trống!');
        }
        // Lưu dữ liệu checkout vào session
        Session::put('checkout_data', $validatedData);
        // Kiểm tra phương thức thanh toán

        // Tính toán totalAmount ở đây, trước khi kiểm tra phương thức thanh toán
        $shippingMethod = ShippingMethod::find($validatedData['shipping_method_id']);
        $shippingFee = $shippingMethod ? $shippingMethod->cost : 0;

        $discount = $cart['discount'] ?? 0;
        $subtotal = $cart['total'];
        $tax = 0;
        $totalAmount = $subtotal + $shippingFee + $tax - $discount;

        // --- Tạo đơn hàng trước khi thanh toán VNPAY ---
        // Ghép địa chỉ người mua
        $fullBuyerAddress = implode(', ', array_filter([
            $validatedData['buyer_address'],
            $validatedData['buyer_ward'],
            $validatedData['buyer_district'],
            $validatedData['buyer_province'],
        ]));

        // Xử lý thông tin giao hàng
        if ($request->filled('ship_to_different_address')) {
            $shippingName    = $validatedData['shipping_name'];
            $shippingPhone   = $validatedData['shipping_phone'];
            $shippingEmail   = $validatedData['shipping_email'];
            $fullShippingAddress = implode(', ', array_filter([
                $validatedData['shipping_address'],
                $validatedData['shipping_ward'],
                $validatedData['shipping_district'],
                $validatedData['shipping_province'],
            ]));
        } else {
            $shippingName    = $validatedData['buyer_name'];
            $shippingPhone   = $validatedData['buyer_phone'];
            $shippingEmail   = $validatedData['buyer_email'];
            $fullShippingAddress = $fullBuyerAddress;
        }

        $orderData = [
            'order_code'         => 'ORD-' . strtoupper(uniqid()),
            'ordered_at'         => now(),
            'customer_name'      => $validatedData['buyer_name'],
            'customer_phone'     => $validatedData['buyer_phone'],
            'customer_email'     => $validatedData['buyer_email'],
            'buyer_name'         => $validatedData['buyer_name'],
            'buyer_phone'        => $validatedData['buyer_phone'],
            'buyer_email'        => $validatedData['buyer_email'],
            'buyer_address'      => $fullBuyerAddress,
            'customer_note'      => $validatedData['customer_note'],
            'payment_method_id'  => $validatedData['payment_method_id'],
            'shipping_method_id' => $validatedData['shipping_method_id'],
            'subtotal_amount'    => $subtotal,
            'tax_amount'         => $tax,
            'shipping_fee'       => $shippingFee,
            'discount_amount'    => $discount,
            'discount_code'      => $cart['discount_code'] ?? null,
            'total_amount'       => $totalAmount,
            'order_status'       => 'pending_confirmation',
            'shipping_name'      => $shippingName,
            'shipping_phone'     => $shippingPhone,
            'shipping_email'     => $shippingEmail,
            'shipping_address'   => $fullShippingAddress,
            'payment_status'     => 'pending',
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
                'subtotal'           => $item['price_at_addition'] * $item['quantity'],
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

        if (PaymentMethod::find($validatedData['payment_method_id'])->name === 'VNPAY') {
            // Gọi phương thức pay của VnPayController
            $vnpayController = new \App\Http\Controllers\VnPayController();
            $vnpayRequest = new Request();
            $vnpayRequest->replace([
                'total_vnpay' => $totalAmount,
                'order_code' => $order->order_code, // truyền đúng mã đơn hàng
            ]);
            $vnpResponse = $vnpayController->pay($vnpayRequest);
            if ($vnpResponse instanceof \Illuminate\Http\RedirectResponse) {
                return $vnpResponse;
            }
            if (is_object($vnpResponse) && method_exists($vnpResponse, 'getData')) {
                $data = $vnpResponse->getData(true);
                if (!empty($data['data'])) {
                    return redirect()->away($data['data']);
                }
            }
            if (is_string($vnpResponse)) {
                return redirect()->away($vnpResponse);
            }
            return back()->with('error', 'Không thể chuyển hướng sang VNPAY!');
        }






        $paymentMethod = PaymentMethod::find($request->payment_method_id);
        if ($paymentMethod->code === 'paypal') {
            // Đảm bảo order đã được tạo trước đó  
            if (!isset($order) || !$order->id) {
                return redirect()->route('client.checkout')
                    ->with('error', 'Có lỗi xảy ra khi tạo đơn hàng');
            }

            // Chuyển hướng qua GET request với order_id
            return redirect()->route('paypal.process', ['order_id' => $order->id]);
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

            $discount = $cart['discount'] ?? 0;
            $discountCode = $cart['discount_code'] ?? null;
            $subtotal = $cart['total'];
            $tax = 0;
            $totalAmount = $subtotal + $shippingFee + $tax - $discount;

            // Ghép địa chỉ người mua
            $fullBuyerAddress = implode(', ', array_filter([
                $validatedData['buyer_address'],
                $validatedData['buyer_ward'],
                $validatedData['buyer_district'],
                $validatedData['buyer_province'],
            ]));

            // Xử lý thông tin giao hàng
            if ($request->filled('ship_to_different_address')) {
                $shippingName    = $validatedData['shipping_name'];
                $shippingPhone   = $validatedData['shipping_phone'];
                $shippingEmail   = $validatedData['shipping_email'];
                $fullShippingAddress = implode(', ', array_filter([
                    $validatedData['shipping_address'],
                    $validatedData['shipping_ward'],
                    $validatedData['shipping_district'],
                    $validatedData['shipping_province'],
                ]));
            } else {
                // Nếu không, sử dụng thông tin người mua cho giao hàng
                $shippingName    = $validatedData['buyer_name'];
                $shippingPhone   = $validatedData['buyer_phone'];
                $shippingEmail   = $validatedData['buyer_email'];
                $fullShippingAddress = $fullBuyerAddress;
            }

            $orderData = [
                'order_code'         => 'ORD-' . strtoupper(uniqid()),
                'ordered_at'         => now(), // Thêm ngày đặt hàng

                // Giữ lại các trường customer_* để tương thích, lấy từ thông tin người mua
                'customer_name'      => $validatedData['buyer_name'],
                'customer_phone'     => $validatedData['buyer_phone'],
                'customer_email'     => $validatedData['buyer_email'],

                // Thông tin người mua (để thanh toán, xuất hóa đơn)
                'buyer_name'         => $validatedData['buyer_name'],
                'buyer_phone'        => $validatedData['buyer_phone'],
                'buyer_email'        => $validatedData['buyer_email'],
                'buyer_address'      => $fullBuyerAddress,

                'customer_note'      => $validatedData['customer_note'],
                'payment_method_id'  => $validatedData['payment_method_id'],
                'shipping_method_id' => $validatedData['shipping_method_id'],
                'subtotal_amount'    => $subtotal,
                'tax_amount'         => $tax,
                'shipping_fee'       => $shippingFee,
                'discount_amount'    => $discount,
                'discount_code'      => $discountCode,
                'total_amount'       => $totalAmount,
                'order_status'       => 'pending_confirmation',

                // Thông tin người nhận hàng (để giao hàng)
                'shipping_name'      => $shippingName,
                'shipping_phone'     => $shippingPhone,
                'shipping_email'     => $shippingEmail,
                'shipping_address'   => $fullShippingAddress,
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
        // Không kiểm tra session('success') vì khi redirect từ route khác sẽ mất session này
        $order = null;
        $paymentDetails = null;
        if ($request->has('order')) {
            $order = Order::with(['items.product.images', 'items.productVariant', 'paymentMethod', 'shippingMethod'])
                ->find($request->query('order'));
            // Nếu là thanh toán VNPAY và có payment_details thì giải mã
            if ($order && $order->paymentMethod && strtolower($order->paymentMethod->name) === 'vnpay' && $order->payment_details) {
                $paymentDetails = is_array($order->payment_details) ? $order->payment_details : json_decode($order->payment_details, true);
            }
        }
        // Nếu không tìm thấy order, chuyển về trang chủ hoặc trang đơn hàng của user
        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng!');
        }
        return view('client.checkout.success', compact('order', 'paymentDetails'));
    }
}
