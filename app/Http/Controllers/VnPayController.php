                                    <?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
 
class VnPayController 
{
    /**
     * Xử lý thanh toán VNPAY (redirect sang VNPAY).
     */
    public function pay(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(1000, 9999);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // Route trả về sau thanh toán
        $vnp_TmnCode = "I7RJJOXP"; // Mã website tại VNPAY (bỏ dấu cách thừa)
        $vnp_HashSecret = "XWLM4D1JIH7YPSP3UC2V1261SUG95CI2"; // Chuỗi bí mật

        // Lấy đúng mã đơn hàng từ request để truyền sang VNPAY
        $vnp_TxnRef = $data['order_code']; // lấy đúng order_code đã tạo
        $vnp_OrderInfo = 'Thanh toán đơn hàng Funori';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)str_replace([',', '.'], '', $data['total_vnpay']) * 100;
        $vnp_Locale = 'vi';
        $vnp_IpAddr = $request->ip() ?: '127.0.0.1';

        // Kiểm tra các trường bắt buộc
        $required = [
            'vnp_Url' => $vnp_Url,
            'vnp_Returnurl' => $vnp_Returnurl,
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_HashSecret' => $vnp_HashSecret,
            'vnp_TxnRef' => $vnp_TxnRef,
            'vnp_Amount' => $vnp_Amount,
            'vnp_IpAddr' => $vnp_IpAddr,
        ];
        foreach ($required as $k => $v) {
            if (empty($v)) {
                \Log::error('VNPAY thiếu trường bắt buộc: ' . $k);
                return response('Thiếu trường bắt buộc: ' . $k, 400);
            }
        }

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            if (substr($vnp_Url, -1) !== '&') {
                $vnp_Url .= '&';
            }
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if ($request->has('redirect')) {
            return redirect($vnp_Url);
        } else {
            return response()->json($returnData);
        }
    }

    public function vnpayReturn(Request $request)
    {
        // TODO: Nên đưa các cấu hình này vào file .env và config/services.php
        $vnp_HashSecret = "XWLM4D1JIH7YPSP3UC2V1261SUG95CI2";

        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        
        // Loại bỏ vnp_SecureHash và vnp_SecureHashType ra khỏi dữ liệu để kiểm tra chữ ký
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        // Sắp xếp dữ liệu theo thứ tự alphabet
        ksort($inputData);
        
        // Tạo chuỗi hash
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        // 1. Xác thực chữ ký
        if (!hash_equals($secureHash, $vnp_SecureHash)) {
            Log::error('VNPAY Return: Invalid signature.', ['request' => $request->all()]);
            return redirect()->route('client.view-cart')->with('error', 'Chữ ký không hợp lệ. Giao dịch bị từ chối.');
        }

        $orderCode = $inputData['vnp_TxnRef'];
        $order = Order::with('items.product', 'items.productVariant')->where('order_code', $orderCode)->first();

        // 2. Kiểm tra đơn hàng
        if (!$order) {
            Log::error('VNPAY Return: Order not found.', ['order_code' => $orderCode]);
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng của bạn.');
        }

        // 3. Kiểm tra trạng thái thanh toán (tránh xử lý lại)
        if ($order->payment_status !== 'pending') {
            // Nếu đã thành công, chuyển hướng đến trang thành công
            if ($order->payment_status === 'paid') {
                return redirect()->route('client.checkout.success', ['order' => $order->id]);
            }
            // Nếu đã thất bại, chuyển về giỏ hàng
            return redirect()->route('client.view-cart')->with('error', 'Đơn hàng này đã được xử lý trước đó.');
        }

        // Lưu lại toàn bộ dữ liệu VNPAY trả về để đối soát
        $order->payment_details = $inputData;

        // 4. Xử lý kết quả từ VNPAY
        if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
            // Giao dịch THÀNH CÔNG
            DB::beginTransaction();
            try {
                $order->payment_status = 'paid';
                $order->order_status = 'processing'; // Chuyển sang trạng thái đang xử lý
                $order->save();

                // Gửi email xác nhận (nếu có)
                // Mail::to($order->customer_email)->send(new OrderSuccessEmail($order));

                // Xóa giỏ hàng và dữ liệu checkout trong session
                Session::forget(['cart', 'checkout_data']);

                DB::commit();

                // Chuyển hướng đến trang đặt hàng thành công
                return redirect()->route('client.checkout.success', ['order' => $order->id])
                               ->with('success', 'Thanh toán và đặt hàng thành công!');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('VNPAY Return Success - DB Error: ' . $e->getMessage(), ['order_code' => $orderCode]);
                // Có lỗi phía server, nhưng giao dịch VNPAY đã thành công, cần xử lý thủ công
                return redirect()->route('home')->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng. Vui lòng liên hệ bộ phận hỗ trợ.');
            }
        } else {
            // Giao dịch THẤT BẠI
            DB::beginTransaction();
            try {
                $order->payment_status = 'failed';
                $order->order_status = 'cancelled'; // Hủy đơn hàng
                $order->cancellation_reason = 'Thanh toán VNPAY thất bại. Mã lỗi: ' . ($inputData['vnp_ResponseCode'] ?? 'N/A');
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

                // Lấy thông báo lỗi từ VNPAY
                $errorMessage = $this->getVnPayErrorMessage($inputData['vnp_ResponseCode'] ?? '99');

                // Chuyển hướng về giỏ hàng với thông báo lỗi
                return redirect()->route('client.view-cart')->with('error', 'Thanh toán thất bại: ' . $errorMessage);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('VNPAY Return Failed - DB Error: ' . $e->getMessage(), ['order_code' => $orderCode]);
                return redirect()->route('client.view-cart')->with('error', 'Có lỗi xảy ra khi hủy đơn hàng sau thanh toán thất bại. Vui lòng liên hệ hỗ trợ.');
            }
        }
    }

    /**
     * Lấy thông báo lỗi từ mã response của VNPAY.
     * @param string $responseCode
     * @return string
     */
    private function getVnPayErrorMessage(string $responseCode): string
    {
        $errorMessages = [
            '07' => 'Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).',
            '09' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.',
            '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần.',
            '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin vui lòng thực hiện lại giao dịch.',
            '12' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.',
            '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin vui lòng thực hiện lại giao dịch.',
            '24' => 'Giao dịch không thành công do: Khách hàng hủy giao dịch.',
            '51' => 'Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.',
            '65' => 'Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.',
            '75' => 'Ngân hàng thanh toán đang bảo trì.',
            '79' => 'Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin vui lòng thực hiện lại giao dịch',
            '99' => 'Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê).',
        ];

        return $errorMessages[$responseCode] ?? 'Lỗi không xác định. Vui lòng thử lại.';
    }
}
