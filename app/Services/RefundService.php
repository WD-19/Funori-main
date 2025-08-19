<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RefundService
{
    /**
     * Xử lý hoàn tiền cho đơn hàng
     */
    public function processRefund(Order $order, $reason = null)
    {
        try {
            // Debug log
            Log::info('Processing refund request', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'payment_status' => $order->payment_status,
                'order_status' => $order->order_status,
                'reason' => $reason
            ]);

            // Kiểm tra đơn hàng có thể hoàn tiền không
            if (!$this->canRefund($order)) {
                Log::warning('Order cannot be refunded', [
                    'order_id' => $order->id,
                    'payment_status' => $order->payment_status,
                    'order_status' => $order->order_status
                ]);
                throw new \Exception('Đơn hàng không thể hoàn tiền');
            }

            // Xử lý hoàn tiền cho đơn hàng đã thanh toán
            if ($order->payment_status === 'paid') {
                return $this->processPaymentRefund($order, $reason);
            }

            // Xử lý hủy đơn hàng đang xử lý (không cần hoàn tiền)
            if (in_array($order->order_status, ['processing', 'confirmed', 'pending_confirmation'])) {
                return $this->processOrderCancellation($order, $reason);
            }

            return [
                'success' => false,
                'message' => 'Trạng thái đơn hàng không hợp lệ'
            ];
        } catch (\Exception $e) {
            Log::error('Refund process error', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Xử lý hủy đơn hàng đang xử lý
     */
    private function processOrderCancellation(Order $order, $reason = null)
    {
        try {
            // Tạo record refund với status cancelled
            $refund = Refund::create([
                'order_id' => $order->id,
                'gateway' => 'manual', // Không có gateway vì không hoàn tiền
                'amount' => 0, // Không có tiền để hoàn
                'status' => 'cancelled',
                'transaction_id' => null,
                'gateway_response' => ['reason' => $reason, 'type' => 'order_cancellation']
            ]);

            // Cập nhật trạng thái đơn hàng ngay lập tức cho đơn hàng chưa thanh toán
            $order->update([
                'order_status' => 'cancelled',
                'cancelled_at' => now(),
                'cancellation_reason' => $reason
            ]);

            Log::info('Order cancelled successfully', [
                'order_id' => $order->id,
                'refund_id' => $refund->id,
                'reason' => $reason
            ]);

            return [
                'success' => true,
                'message' => 'Hủy đơn hàng thành công',
                'refund_id' => $refund->id,
                'type' => 'cancellation'
            ];
        } catch (\Exception $e) {
            Log::error('Order cancellation failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Hủy đơn hàng thất bại: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Xử lý hoàn tiền cho đơn hàng đã thanh toán
     */
    private function processPaymentRefund(Order $order, $reason = null)
    {
        // Debug: Log thông tin đơn hàng trước khi xử lý
        Log::info('Processing payment refund', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status,
            'transaction_id' => $order->transaction_id ?? 'null',
            'total_amount' => $order->total_amount
        ]);

        // Xác định gateway thanh toán
        $gateway = $this->determineGateway($order);

        // Kiểm tra transaction_id trước khi tạo refund
        $transactionId = $order->transaction_id;
        if (empty($transactionId) && !empty($order->payment_details)) {
            $paymentDetails = is_array($order->payment_details) ? $order->payment_details : json_decode($order->payment_details, true);
            $transactionId = $paymentDetails['vnp_TransactionNo'] ?? $paymentDetails['vnp_TxnRef'] ?? null;
        }

        // Nếu không có transaction_id, tạo refund thủ công
        if (empty($transactionId)) {
            Log::warning('No transaction_id found, creating manual refund', [
                'order_id' => $order->id,
                'gateway' => $gateway
            ]);

            $refund = Refund::create([
                'order_id' => $order->id,
                'gateway' => 'manual',
                'amount' => $order->total_amount,
                'status' => 'pending',
                'transaction_id' => null,
                'gateway_response' => [
                    'reason' => $reason,
                    'type' => 'manual_refund',
                    'note' => 'Không có transaction_id, cần xử lý thủ công'
                ]
            ]);

            // ✅ Cập nhật trạng thái đơn hàng ngay lập tức
            $order->update([
                'order_status' => 'cancelled',
                'cancelled_at' => now(),
                'cancellation_reason' => $reason
            ]);

            return [
                'success' => true,
                'message' => 'Đơn hàng đã được hủy. Hoàn tiền cần xử lý thủ công.',
                'refund_id' => $refund->id,
                'type' => 'manual_refund'
            ];
        }

        // Tạo record refund
        $refund = Refund::create([
            'order_id' => $order->id,
            'gateway' => $gateway,
            'amount' => $order->total_amount,
            'status' => 'pending',
            'transaction_id' => $transactionId,
            'gateway_response' => ['reason' => $reason]
        ]);

        // Kiểm tra cấu hình gateway
        if ($gateway === 'vnpay') {
            $tmnCode = config('payment.vnpay.tmn_code');
            $hashSecret = config('payment.vnpay.hash_secret');

            if (empty($tmnCode) || empty($hashSecret)) {
                Log::warning('VNPay configuration missing, marking refund as failed', [
                    'order_id' => $order->id,
                    'refund_id' => $refund->id
                ]);

                $refund->markAsFailed('Cấu hình VNPay không đầy đủ');

                // ✅ Cập nhật trạng thái đơn hàng
                $order->update([
                    'order_status' => 'cancelled',
                    'cancelled_at' => now(),
                    'cancellation_reason' => $reason
                ]);

                return [
                    'success' => false,
                    'message' => 'Cấu hình VNPay không đầy đủ',
                    'refund_id' => $refund->id
                ];
            }

            // Test connection trước khi gọi API
            // if (!$this->testVNPayConnection()) {
            //     Log::warning('VNPay connection failed, creating pending refund', [
            //         'order_id' => $order->id,
            //         'refund_id' => $refund->id
            //     ]);

            //     $refund->update([
            //         'status' => 'pending',
            //         'gateway_response' => array_merge($refund->gateway_response ?? [], [
            //             'connection_error' => true,
            //             'note' => 'Không thể kết nối đến VNPay, cần xử lý thủ công'
            //         ])
            //     ]);

            //     // ✅ Cập nhật trạng thái đơn hàng
            //     $order->update([
            //         'order_status' => 'cancelled',
            //         'cancelled_at' => now(),
            //         'cancellation_reason' => $reason
            //     ]);

            //     return [
            //         'success' => true,
            //         'message' => 'Đơn hàng đã được hủy. Hoàn tiền đang chờ xử lý do không thể kết nối VNPay.',
            //         'refund_id' => $refund->id,
            //         'type' => 'pending_refund'
            //     ];
            // }
        }

        // Gọi API hoàn tiền theo gateway
        $result = $this->callRefundAPI($refund, $order);

        if ($result['success']) {
            $refund->markAsSuccess($result['refund_transaction_id'] ?? null);

            // ✅ Cập nhật trạng thái đơn hàng sau khi hoàn tiền thành công
            $order->update([
                'order_status' => 'cancelled',
                'cancelled_at' => now(),
                'cancellation_reason' => $reason
            ]);

            Log::info('Refund successful', [
                'order_id' => $order->id,
                'refund_id' => $refund->id,
                'amount' => $order->total_amount,
                'gateway' => $gateway
            ]);

            return [
                'success' => true,
                'message' => 'Hoàn tiền thành công',
                'refund_id' => $refund->id,
                'refund_transaction_id' => $result['refund_transaction_id'] ?? null,
                'type' => 'refund'
            ];
        } else {
            $refund->markAsFailed($result['error'] ?? 'Hoàn tiền thất bại');

            // ✅ Cập nhật trạng thái đơn hàng ngay cả khi hoàn tiền thất bại
            $order->update([
                'order_status' => 'cancelled',
                'cancelled_at' => now(),
                'cancellation_reason' => $reason
            ]);

            Log::error('Refund failed', [
                'order_id' => $order->id,
                'refund_id' => $refund->id,
                'error' => $result['error'] ?? 'Unknown error'
            ]);

            return [
                'success' => false,
                'message' => $result['error'] ?? 'Hoàn tiền thất bại',
                'refund_id' => $refund->id
            ];
        }
    }

    /**
     * Kiểm tra đơn hàng có thể hoàn tiền không
     */
    private function canRefund(Order $order)
    {
        Log::info('Checking if order can be refunded', [
            'order_id' => $order->id,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status
        ]);

        // Cho phép hoàn tiền cho đơn hàng đã thanh toán thành công
        if ($order->payment_status === 'paid') {
            // Kiểm tra đã có refund thành công chưa
            $existingRefund = $order->refunds()->where('status', 'success')->first();
            if ($existingRefund) {
                Log::warning('Order already has successful refund', [
                    'order_id' => $order->id,
                    'existing_refund_id' => $existingRefund->id
                ]);
                return false;
            }
            return true;
        }

        // Cho phép hủy đơn hàng đang xử lý (không hoàn tiền)
        $allowedStatuses = ['pending_confirmation', 'processing', 'confirmed', 'pending_cancellation'];
        if (in_array($order->order_status, $allowedStatuses)) {
            // Kiểm tra đã có refund cancelled chưa
            $existingRefund = $order->refunds()->where('status', 'cancelled')->first();
            if ($existingRefund) {
                Log::warning('Order already has cancelled refund', [
                    'order_id' => $order->id,
                    'existing_refund_id' => $existingRefund->id
                ]);
                return false;
            }
            return true;
        }

        Log::warning('Order cannot be refunded - invalid status', [
            'order_id' => $order->id,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status
        ]);

        return false;
    }

    /**
     * Xác định gateway thanh toán
     */
    private function determineGateway(Order $order)
    {
        // Debug: Log thông tin để kiểm tra
        Log::info('Determining gateway for order', [
            'order_id' => $order->id,
            'payment_method_id' => $order->payment_method_id,
            'payment_method_name' => $order->paymentMethod->name ?? 'null',
            'transaction_id' => $order->transaction_id ?? 'null',
            'payment_status' => $order->payment_status ?? 'null'
        ]);

        // Dựa vào payment method name để xác định gateway
        $paymentMethodName = $order->paymentMethod->name ?? '';

        if (str_contains(strtolower($paymentMethodName), 'vnpay')) {
            return 'vnpay';
        }

        if (str_contains(strtolower($paymentMethodName), 'momo')) {
            return 'momo';
        }

        // Fallback: kiểm tra transaction_id
        if (str_contains($order->transaction_id ?? '', 'VNPAY')) {
            return 'vnpay';
        }

        if (str_contains($order->transaction_id ?? '', 'MOMO')) {
            return 'momo';
        }

        // Default
        return 'vnpay';
    }

    /**
     * Gọi API hoàn tiền
     */
    private function callRefundAPI(Refund $refund, Order $order)
    {
        switch ($refund->gateway) {
            case 'vnpay':
                return $this->refundVNPay($refund, $order);
            case 'momo':
                return $this->refundMoMo($refund, $order);
            default:
                throw new \Exception('Gateway không được hỗ trợ');
        }
    }

    /**
     * Hoàn tiền qua VNPay
     */
    private function refundVNPay(Refund $refund, Order $order)
    {
        try {
            Log::info('Starting VNPay refund process', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'transaction_id' => $order->transaction_id,
                'payment_details' => $order->payment_details,
                'total_amount' => $order->total_amount
            ]);

            $tmnCode = config('payment.vnpay.tmn_code');
            $hashSecret = config('payment.vnpay.hash_secret');

            if (empty($tmnCode) || empty($hashSecret)) {
                return [
                    'success' => false,
                    'error' => 'Cấu hình VNPay không đầy đủ'
                ];
            }

            $transactionId = $order->transaction_id;
            if (empty($transactionId) && !empty($order->payment_details)) {
                $paymentDetails = is_array($order->payment_details) ? $order->payment_details : json_decode($order->payment_details, true);
                $transactionId = $paymentDetails['vnp_TransactionNo'] ?? $paymentDetails['vnp_TxnRef'] ?? null;
            }

            if (empty($transactionId)) {
                return [
                    'success' => false,
                    'error' => 'Không tìm thấy mã giao dịch VNPay'
                ];
            }

            $vnpayUrl = config('payment.vnpay.refund_url', 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction');

            $now = now()->format('YmdHis');

            // ✅ Tạo data đúng format doc
            $data = [
                'vnp_RequestId'       => 'REFUND_' . time() . '_' . $refund->id,
                'vnp_Version'         => '2.1.0',
                'vnp_Command'         => 'refund',
                'vnp_TmnCode'         => $tmnCode,
                'vnp_TransactionType' => '02', // refund toàn phần
                'vnp_TxnRef'          => $order->order_code,
                'vnp_Amount'          => (int)($order->total_amount * 100),
                'vnp_OrderInfo'       => 'Hoàn tiền đơn hàng ' . $order->order_code,
                'vnp_TransactionNo'   => $transactionId,
                'vnp_TransactionDate' => $order->vnp_transaction_date, // phải lấy từ lúc tạo đơn
                'vnp_CreateBy'        => auth()->user()->name ?? 'system',
                'vnp_CreateDate'      => $now,
                'vnp_IpAddr'          => request()->ip() ?? '127.0.0.1',
            ];

            // ✅ Tạo chuỗi theo đúng thứ tự doc
            $rawData = implode('|', [
                $data['vnp_RequestId'],
                $data['vnp_Version'],
                $data['vnp_Command'],
                $data['vnp_TmnCode'],
                $data['vnp_TransactionType'],
                $data['vnp_TxnRef'],
                $data['vnp_Amount'],
                $data['vnp_TransactionNo'],
                $data['vnp_TransactionDate'],
                $data['vnp_CreateBy'],
                $data['vnp_CreateDate'],
                $data['vnp_IpAddr'],
                $data['vnp_OrderInfo']
            ]);

            $data['vnp_SecureHash'] = hash_hmac('sha512', $rawData, $hashSecret);

            Log::info('VNPay refund request data', [
                'data' => $data,
                'rawData' => $rawData,
                'secureHash' => $data['vnp_SecureHash']
            ]);

            // ✅ Gọi API với JSON đúng chuẩn
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($vnpayUrl, $data);

            Log::info('VNPay refund response', [
                'status' => $response->status(),
                'body'   => $response->body()
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                if (isset($responseData['vnp_ResponseCode']) && $responseData['vnp_ResponseCode'] === '00') {
                    $refund->update([
                        'status' => 'success',
                        'gateway_response' => $responseData
                    ]);
                    $order->update([
                        'order_status' => 'cancelled',
                        'cancelled_at' => now(),
                        'cancellation_reason' => 'Customer cancelled - Refund processed'
                    ]);

                    return ['success' => true, 'message' => 'Hoàn tiền thành công'];
                }

                return [
                    'success' => false,
                    'error' => $responseData['vnp_Message'] ?? 'Refund thất bại'
                ];
            }

            return [
                'success' => false,
                'error' => "HTTP {$response->status()}: {$response->body()}"
            ];
        } catch (\Exception $e) {
            Log::error('VNPay refund exception', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }


    /**
     * Hoàn tiền qua MoMo
     */
    private function refundMoMo(Refund $refund, Order $order)
    {
        try {
            $momoUrl = config('payment.momo.refund_url', 'https://test-payment.momo.vn/v2/gateway/api/refund');

            $data = [
                'partnerCode' => config('payment.momo.partner_code'),
                'accessKey'   => config('payment.momo.access_key'),
                'requestId'   => Str::uuid()->toString(),
                'orderId'     => $order->order_code,
                'amount'      => (int) $order->total_amount,
                'transId'     => $order->transaction_id,
                'lang'        => 'vi',
                'description' => 'Hoan tien don hang #' . $order->order_code, // Sửa encoding
            ];

            // Tạo chữ ký
            $data['signature'] = $this->createMoMoSignature($data);

            Log::info('MoMo refund request data', [
                'data' => $data,
                'url' => $momoUrl
            ]);

            // Gọi API
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'Laravel/10.0'
                ])
                ->post($momoUrl, $data);

            Log::info('MoMo refund response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            $refund->update(['gateway_response' => $response->json()]);

            if ($response->successful()) {
                $responseData = $response->json();

                if ($responseData['resultCode'] === 0) {
                    return [
                        'success' => true,
                        'refund_transaction_id' => $responseData['transId'] ?? null
                    ];
                } else {
                    return [
                        'success' => false,
                        'error' => 'MoMo: ' . ($responseData['message'] ?? 'Lỗi không xác định')
                    ];
                }
            }

            return [
                'success' => false,
                'error' => 'Không thể kết nối đến MoMo'
            ];
        } catch (\Exception $e) {
            Log::error('MoMo refund error', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => 'Lỗi MoMo: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Tạo chữ ký VNPay
     */
    private function createVNPaySignature($data)
    {
        // Loại bỏ vnp_SecureHash khỏi dữ liệu trước khi tạo chữ ký
        unset($data['vnp_SecureHash']);

        // Sắp xếp theo thứ tự alphabet
        ksort($data);

        // Tạo chuỗi query string
        $queryString = '';
        foreach ($data as $key => $value) {
            if ($value !== null && $value !== '') {
                $queryString .= $key . '=' . $value . '&';
            }
        }
        $queryString = rtrim($queryString, '&');

        Log::info('VNPay signature data', [
            'query_string' => $queryString,
            'hash_secret' => config('payment.vnpay.hash_secret') ? '***' : 'empty'
        ]);

        // Tạo chữ ký SHA512
        return hash_hmac('sha512', $queryString, config('payment.vnpay.hash_secret'));
    }

    /**
     * Tạo chữ ký MoMo
     */
    private function createMoMoSignature($data)
    {
        // Loại bỏ signature khỏi dữ liệu trước khi tạo chữ ký
        unset($data['signature']);

        ksort($data);
        $queryString = '';
        foreach ($data as $key => $value) {
            if ($value !== null && $value !== '') {
                $queryString .= $key . '=' . $value . '&';
            }
        }
        $queryString = rtrim($queryString, '&');

        Log::info('MoMo signature data', [
            'query_string' => $queryString,
            'secret_key' => config('payment.momo.secret_key') ? '***' : 'empty'
        ]);

        return hash_hmac('sha256', $queryString, config('payment.momo.secret_key'));
    }

    /**
     * Kiểm tra trạng thái hoàn tiền
     */
    public function checkRefundStatus(Refund $refund)
    {
        try {
            switch ($refund->gateway) {
                case 'vnpay':
                    return $this->checkVNPayRefundStatus($refund);
                case 'momo':
                    return $this->checkMoMoRefundStatus($refund);
                default:
                    return false;
            }
        } catch (\Exception $e) {
            Log::error('Check refund status error', [
                'refund_id' => $refund->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Kiểm tra trạng thái hoàn tiền VNPay
     */
    private function checkVNPayRefundStatus(Refund $refund)
    {
        // Implement API kiểm tra trạng thái VNPay
        // Có thể gọi API query transaction để kiểm tra
        return true;
    }

    /**
     * Kiểm tra trạng thái hoàn tiền MoMo
     */
    private function checkMoMoRefundStatus(Refund $refund)
    {
        // Implement API kiểm tra trạng thái MoMo
        return true;
    }

    /**
     * Test kết nối đến VNPay
     */
    public function testVNPayConnection()
    {
        try {
            $vnpayUrl = config('payment.vnpay.refund_url', 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction');
            $tmnCode = config('payment.vnpay.tmn_code');
            $hashSecret = config('payment.vnpay.hash_secret');

            if (empty($tmnCode) || empty($hashSecret)) {
                return [
                    'status' => 'error',
                    'message' => 'Cấu hình VNPay không đầy đủ'
                ];
            }

            // Test data đơn giản
            $testData = [
                'vnp_Version' => '2.1.0',
                'vnp_Command' => 'refund',
                'vnp_TmnCode' => $tmnCode,
                'vnp_RequestId' => 'TEST_' . time(),
                'vnp_TransactionType' => '02',
                'vnp_TxnRef' => 'TEST_ORDER',
                'vnp_TransactionNo' => '123456789',
                'vnp_Amount' => 1000000, // 10,000 VND
                'vnp_OrderInfo' => 'Test connection',
                'vnp_CreateDate' => now()->format('YmdHis'),
                'vnp_IpAddr' => '127.0.0.1',
            ];

            // Tạo chữ ký
            ksort($testData);
            $queryString = http_build_query($testData);
            $testData['vnp_SecureHash'] = hash_hmac('sha512', $queryString, $hashSecret);

            $response = Http::timeout(10)
                ->withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'User-Agent' => 'Laravel/10.0',
                ])
                ->asForm()
                ->post($vnpayUrl, $testData);

            return [
                'status' => $response->successful() ? 'success' : 'error',
                'http_status' => $response->status(),
                'response' => $response->body(),
                'url' => $vnpayUrl
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Xử lý refund thủ công (khi không thể kết nối gateway)
     */
    public function processManualRefund(Refund $refund, $adminNote = null)
    {
        try {
            $refund->update([
                'status' => 'success',
                'refunded_at' => now(),
                'gateway_response' => array_merge($refund->gateway_response ?? [], [
                    'manual_processed' => true,
                    'processed_by' => auth()->id(),
                    'processed_at' => now()->toISOString(),
                    'admin_note' => $adminNote
                ])
            ]);

            // Cập nhật trạng thái đơn hàng
            $refund->order->update(['order_status' => 'cancelled']);

            Log::info('Manual refund processed successfully', [
                'refund_id' => $refund->id,
                'order_id' => $refund->order_id,
                'processed_by' => auth()->id()
            ]);

            return [
                'success' => true,
                'message' => 'Xử lý hoàn tiền thủ công thành công'
            ];
        } catch (\Exception $e) {
            Log::error('Manual refund processing failed', [
                'refund_id' => $refund->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Xử lý hoàn tiền thủ công thất bại: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Lấy danh sách refund cần xử lý thủ công
     */
    public function getPendingRefunds()
    {
        return Refund::where('status', 'pending')
            ->with(['order.user', 'order.paymentMethod'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Lấy danh sách refund có lỗi kết nối
     */
    public function getConnectionErrorRefunds()
    {
        return Refund::where('status', 'pending')
            ->whereJsonContains('gateway_response->connection_error', true)
            ->with(['order.user', 'order.paymentMethod'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Thử hoàn tiền lại cho refund pending
     */
    public function retryRefund(Refund $refund)
    {
        try {
            Log::info('Retrying refund', [
                'refund_id' => $refund->id,
                'order_id' => $refund->order_id,
                'gateway' => $refund->gateway
            ]);

            // Kiểm tra số lần thử
            $attempts = $refund->gateway_response['attempts'] ?? 0;
            if ($attempts >= 3) {
                Log::warning('Refund max attempts reached', [
                    'refund_id' => $refund->id,
                    'attempts' => $attempts
                ]);

                // Chuyển sang trạng thái failed
                $refund->update([
                    'status' => 'failed',
                    'gateway_response' => array_merge($refund->gateway_response ?? [], [
                        'final_error' => 'Max attempts reached - VNPay API unavailable'
                    ])
                ]);

                return false;
            }

            // Tăng số lần thử
            $refund->update([
                'gateway_response' => array_merge($refund->gateway_response ?? [], [
                    'attempts' => $attempts + 1,
                    'last_attempt' => now()->toISOString()
                ])
            ]);

            // Thử hoàn tiền
            if ($refund->gateway === 'vnpay') {
                return $this->refundVNPay($refund, $refund->order);
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Retry refund failed', [
                'refund_id' => $refund->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
