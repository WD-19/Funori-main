<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PayPalController
{
    public function createPayment(Request $request)
    {
        try {
            // Validate request data
            $request->validate([
                'cart_data' => 'required|array',
                'shipping_address' => 'required|array',
                'total_amount' => 'required|numeric'
            ]);

            // Store order data in session
            session([
                'pending_order' => [
                    'cart_data' => $request->cart_data,
                    'shipping_address' => $request->shipping_address,
                    'total_amount' => $request->total_amount,
                    'shipping_method' => $request->shipping_method,
                    'payment_method' => 'paypal'
                ]
            ]);

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($request->total_amount, 2, '.', '')
                        ],
                        "description" => "Order Payment"
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return response()->json(['url' => $link['href']]);
                    }
                }
            }

            return response()->json(['error' => 'Something went wrong.'], 500);
        } catch (\Exception $e) {
            Log::error('PayPal Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function success(Request $request)
    {
        try {
            Log::info('PayPal Success Callback', [
                'token' => $request->token,
                'PayerID' => $request->PayerID
            ]);

            if (!session()->has('pending_order')) {
                throw new \Exception('No pending order found in session');
            }

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken(); // <- ĐẢM BẢO access token được lấy

            try {
                $response = $provider->capturePaymentOrder($request->token);

                Log::info('PayPal Capture Response', ['response' => $response]);

                if (isset($response['error'])) {
                    $error = $response['error'];
                    $errorMessage = $error['message'] ?? 'Unknown error';

                    if (isset($error['details'][0]['issue'])) {
                        switch ($error['details'][0]['issue']) {
                            case 'INSTRUMENT_DECLINED':
                                return view('client.checkout.failed', [
                                    'error' => 'Thẻ/phương thức thanh toán bị từ chối. Vui lòng thử phương thức khác.'
                                ]);
                            default:
                                Log::error('PayPal Error Details', ['error' => $error]);
                                return view('client.checkout.failed', [
                                    'error' => $errorMessage
                                ]);
                        }
                    }

                    return view('client.checkout.failed', [
                        'error' => $errorMessage
                    ]);
                }

                if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                    return $this->handleSuccessfulPayment($response);
                }

                Log::warning('Payment not completed', [
                    'status' => $response['status'] ?? 'UNKNOWN',
                    'response' => $response
                ]);

                return view('client.checkout.failed', [
                    'error' => 'Thanh toán chưa hoàn tất. Vui lòng thử lại.'
                ]);
            } catch (\Exception $e) {
                Log::error('PayPal Capture Error', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return view('client.checkout.failed', [
                    'error' => 'Lỗi xử lý thanh toán: ' . $e->getMessage()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('PayPal Handler Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return view('client.checkout.failed', [
                'error' => 'Đã xảy ra lỗi trong quá trình xử lý.'
            ]);
        }
    }


    private function handleSuccessfulPayment($response)
    {
        DB::beginTransaction();
        try {
            $orderData = session('pending_order');

            // Validate order data
            if (!isset($orderData['total_amount'], $orderData['shipping_address'], $orderData['cart_data'])) {
                throw new \Exception('Thiếu thông tin đơn hàng.');
            }

            $shippingAddress = $orderData['shipping_address'];
            $orderData = [
                'order_code' => 'ORD-' . strtoupper(uniqid()),
                'ordered_at' => now(),

                // Thông tin người mua/nhận hàng
                'customer_name' => $shippingAddress['name'],
                'customer_phone' => $shippingAddress['phone'],
                'customer_email' => $shippingAddress['email'],
                'buyer_name' => $shippingAddress['name'],
                'buyer_phone' => $shippingAddress['phone'],
                'buyer_email' => $shippingAddress['email'],
                'buyer_address' => $shippingAddress['address'],

                'shipping_name' => $shippingAddress['name'],
                'shipping_phone' => $shippingAddress['phone'],
                'shipping_email' => $shippingAddress['email'],
                'shipping_address' => $shippingAddress['address'],

                // Thông tin đơn hàng
                'payment_method_id' => $orderData['payment_method_id'],
                'shipping_method_id' => $orderData['shipping_method_id'],
                'subtotal_amount' => $orderData['total_amount'],
                'shipping_fee' => $orderData['shipping_fee'] ?? 0,
                'tax_amount' => 0,
                'discount_amount' => $orderData['discount'] ?? 0,
                'discount_code' => $orderData['discount_code'] ?? null,
                'total_amount' => $orderData['total_amount'],

                'order_status' => 'pending_confirmation',
                'payment_status' => 'paid',
                'transaction_id' => $response['id']
            ];

            if (Auth::check()) {
                $orderData['user_id'] = Auth::id();
            }

            $order = Order::create($orderData);

            // Tạo order items
            foreach ($orderData['cart_data'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price_at_addition'],
                    'subtotal' => $item['price_at_addition'] * $item['quantity'],
                    'product_name' => $item['product']['name'],
                ]);

                // Cập nhật kho hàng
                if (isset($item['product_variant_id'])) {
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
            }

            DB::commit();

            // Clear sessions
            session()->forget(['pending_order', 'cart']);

            Log::info('Payment processed successfully', [
                'order_id' => $order->id,
                'transaction_id' => $response['id']
            ]);

            return view('client.checkout.success', [
                'order' => $order
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Creation Failed: ' . $e->getMessage());
            return view('client.checkout.failed', [
                'error' => 'Không thể tạo đơn hàng: ' . $e->getMessage()
            ]);
        }
    }
    public function cancel()
    {
        // Xóa session đơn hàng
        session()->forget('pending_order');
        return view('client.checkout.cancelled');
    }
}
