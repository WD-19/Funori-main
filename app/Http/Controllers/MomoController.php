<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MomoController
{
    private $partnerCode = 'MOMOBKUN20180529';
    private $accessKey = 'klm05TvNBzhg7h7j';
    private $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    private $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';

    /**
     * Khởi tạo thanh toán MoMo (redirect sang MoMo).
     */
    public function pay(Request $request)
    {
        $orderCode = $request->input('order_code');
        $amount = (int) $request->input('total_momo');
        $orderId = $orderCode ?? (time() . '_' . ($request->user_id ?? 'guest'));
        $orderInfo = 'Thanh toán đơn hàng Funori #' . $orderId;
        $redirectUrl = route('momo.return');
        $ipnUrl = route('momo.notify');
        $extraData = "";

        $requestId = uniqid('momo_');
        $requestType = "captureWallet";

        $rawHash = "accessKey={$this->accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$ipnUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$this->partnerCode}&redirectUrl={$redirectUrl}&requestId={$requestId}&requestType={$requestType}";
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'partnerName' => "Funori",
            'storeId' => "FunoriStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        Log::info('MoMo Payment Request:', ['data' => $data, 'rawHash' => $rawHash]);

        $result = $this->execPostRequest($this->endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        Log::info('MoMo Payment Response:', $jsonResult);

        Session::put('momo_order_id', $orderId);
        Session::put('momo_request_id', $requestId);

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        } else {
            Log::error('MoMo Payment Error: ', $jsonResult);
            Session::forget('order_data');
            $errorMessage = 'Có lỗi xảy ra khi tạo thanh toán MoMo';
            if (isset($jsonResult['message'])) {
                $errorMessage .= ': ' . $jsonResult['message'];
            }
            return redirect()->route('client.view-cart')->with('error', $errorMessage);
        }
    }

    /**
     * Xử lý kết quả trả về từ MoMo (redirectUrl).
     */
    public function return(Request $request)
    {
        $inputData = $request->all();
        $orderId = $inputData['orderId'] ?? null;
        $resultCode = $inputData['resultCode'] ?? null;
        $message = $inputData['message'] ?? '';
        $transId = $inputData['transId'] ?? null;

        $order = Order::with('items.product', 'items.productVariant')->where('order_code', $orderId)->first();

        // 1. Kiểm tra đơn hàng
        if (!$order) {
            Log::error('MoMo Return: Order not found.', ['order_code' => $orderId]);
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng của bạn.');
        }

        // 2. Kiểm tra trạng thái thanh toán (tránh xử lý lại)
        if ($order->payment_status !== 'pending') {
            if ($order->payment_status === 'paid') {
                return redirect()->route('client.checkout.success', ['order' => $order->id]);
            }
            return redirect()->route('client.view-cart')->with('error', 'Đơn hàng này đã được xử lý trước đó.');
        }

        // 3. Lưu lại toàn bộ dữ liệu MoMo trả về để đối soát
        $order->payment_details = $inputData;

        // 4. Xử lý kết quả từ MoMo
        if ($resultCode == 0) {
            // Giao dịch THÀNH CÔNG
            DB::beginTransaction();
            try {
                $order->payment_status = 'paid';
                $order->order_status = 'processing';
                $order->save();

                // Xóa giỏ hàng và dữ liệu checkout trong session
                $cart = \App\Models\Cart::where('user_id', $order->user_id)->with('items')->first();
                if ($cart) {
                    foreach ($order->items as $orderItem) {
                        $cart->items()
                            ->where(function ($query) use ($orderItem) {
                                if ($orderItem->product_variant_id) {
                                    $query->where('product_variant_id', $orderItem->product_variant_id);
                                } else {
                                    $query->where('product_id', $orderItem->product_id);
                                }
                            })
                            ->delete();
                    }
                }
                Session::forget(['cart', 'checkout_data', 'order_data']);

                DB::commit();

                return redirect()->route('client.checkout.success', ['order' => $order->id])
                    ->with('success', 'Thanh toán và đặt hàng thành công!');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('MoMo Return Success - DB Error: ' . $e->getMessage(), ['order_code' => $orderId]);
                return redirect()->route('home')->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng. Vui lòng liên hệ bộ phận hỗ trợ.');
            }
        } else {
            // Giao dịch THẤT BẠI
            DB::beginTransaction();
            try {
                $order->payment_status = 'failed';
                $order->order_status = 'cancelled';
                $order->cancellation_reason = 'Thanh toán MoMo thất bại. Mã lỗi: ' . ($resultCode ?? 'N/A');
                $order->cancelled_at = now();
                $order->save();

                // Hoàn lại số lượng sản phẩm vào kho
                foreach ($order->items as $item) {
                    if ($item->product_variant_id) {
                        ProductVariant::where('id', $item->product_variant_id)->increment('stock_quantity', $item->quantity);
                    } elseif ($item->product_id) {
                        Product::where('id', $item->product_id)->increment('stock_quantity', $item->quantity);
                    }
                }

                DB::commit();

                return redirect()->route('client.view-cart')->with('error', 'Thanh toán thất bại: ' . $message);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('MoMo Return Failed - DB Error: ' . $e->getMessage(), ['order_code' => $orderId]);
                return redirect()->route('client.view-cart')->with('error', 'Có lỗi xảy ra khi hủy đơn hàng sau thanh toán thất bại. Vui lòng liên hệ hỗ trợ.');
            }
        }
    }

    /**
     * Xử lý IPN từ MoMo (ipnUrl).
     */
    public function notify(Request $request)
    {
        Log::info('MoMo IPN: ', $request->all());
        return response()->json(['status' => 'success']);
    }

    /**
     * Hàm gửi POST request tới MoMo.
     */
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            Log::error('CURL Error: ' . curl_error($ch));
        }

        curl_close($ch);
        return $result;
    }
}
