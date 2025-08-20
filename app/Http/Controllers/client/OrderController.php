<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\RefundService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $refundService;

    public function __construct(RefundService $refundService)
    {
        $this->refundService = $refundService;
    }

    /**
     * Hủy đơn hàng và hoàn tiền
     */
    public function cancelOrder(Request $request, $orderId)
    {
        try {
            // Debug log request data
            Log::info('Cancel order request received', [
                'order_id' => $orderId,
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            $order = Order::with('paymentMethod')
                ->where('id', $orderId)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                Log::warning('Order not found or unauthorized', [
                    'order_id' => $orderId,
                    'user_id' => Auth::id()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }

            // Kiểm tra đơn hàng có thể hủy không
            if (!$this->canCancelOrder($order)) {
                Log::warning('Order cannot be cancelled', [
                    'order_id' => $order->id,
                    'order_status' => $order->order_status,
                    'payment_status' => $order->payment_status
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Đơn hàng không thể hủy'
                ], 400);
            }

            // Xử lý cả JSON và form data
            $reason = $request->input('cancellation_reason') ?? $request->json('cancellation_reason', 'Khách hàng yêu cầu hủy');
            
            // Nếu có lý do khác
            if ($reason === 'other') {
                $reason = $request->input('cancel_reason_other') ?? $request->json('cancel_reason_other', 'Lý do khác');
            }

            Log::info('Processing refund for order', [
                'order_id' => $order->id,
                'reason' => $reason
            ]);

            // Xử lý hoàn tiền
            $result = $this->refundService->processRefund($order, $reason);

            if ($result['success']) {
                $response = [
                    'success' => true,
                    'message' => 'Hủy đơn hàng thành công.',
                    'refund_id' => $result['refund_id'],
                    'refund_transaction_id' => $result['refund_transaction_id'] ?? null,
                    'redirect_url' => route('client.profile.order.cancellation-detail', $orderId) // ✅ Luôn chuyển hướng
                ];
                
                // Thêm thông tin về loại xử lý
                if (isset($result['type'])) {
                    switch ($result['type']) {
                        case 'refund':
                            $response['message'] .= ' Hoàn tiền đã được xử lý.';
                            break;
                        case 'pending_refund':
                            $response['message'] .= ' Hoàn tiền đang chờ xử lý.';
                            break;
                        case 'manual_refund':
                            $response['message'] .= ' Hoàn tiền cần xử lý thủ công.';
                            break;
                    }
                }
                
                return response()->json($response);
            } else {
                Log::error('Refund processing failed', [
                    'order_id' => $order->id,
                    'result' => $result
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Hủy đơn hàng thất bại: ' . $result['message']
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Cancel order error', [
                'order_id' => $orderId,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi hủy đơn hàng'
            ], 500);
        }
    }

    /**
     * Kiểm tra đơn hàng có thể hủy không
     */
    private function canCancelOrder(Order $order)
    {
        Log::info('Checking if order can be cancelled', [
            'order_id' => $order->id,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status
        ]);

        // Mở rộng danh sách trạng thái cho phép hủy
        $allowedStatuses = ['pending_confirmation', 'processing', 'confirmed', 'paid'];
        
        if (!in_array($order->order_status, $allowedStatuses)) {
            Log::warning('Order status not allowed for cancellation', [
                'order_id' => $order->id,
                'order_status' => $order->order_status,
                'allowed_statuses' => $allowedStatuses
            ]);
            return false;
        }

        // Kiểm tra đã có refund thành công chưa
        $existingRefund = $order->refunds()->where('status', 'success')->first();
        if ($existingRefund) {
            Log::warning('Order already has successful refund', [
                'order_id' => $order->id,
                'existing_refund_id' => $existingRefund->id
            ]);
            return false;
        }

        // Kiểm tra đã có refund cancelled chưa
        $existingCancelledRefund = $order->refunds()->where('status', 'cancelled')->first();
        if ($existingCancelledRefund) {
            Log::warning('Order already has cancelled refund', [
                'order_id' => $order->id,
                'existing_refund_id' => $existingCancelledRefund->id
            ]);
            return false;
        }

        return true;
    }

    /**
     * Lấy thông tin hoàn tiền của đơn hàng
     */
    public function getRefundInfo($orderId)
    {
        try {
            $order = Order::with(['refunds' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }

            $refunds = $order->refunds->map(function($refund) {
                return [
                    'id' => $refund->id,
                    'amount' => $refund->amount,
                    'status' => $refund->status,
                    'gateway' => $refund->gateway,
                    'transaction_id' => $refund->transaction_id,
                    'refund_transaction_id' => $refund->refund_transaction_id,
                    'created_at' => $refund->created_at->format('d/m/Y H:i:s'),
                    'refunded_at' => $refund->refunded_at ? $refund->refunded_at->format('d/m/Y H:i:s') : null,
                    'error_message' => $refund->error_message
                ];
            });

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'order_status' => $order->order_status,
                'refunds' => $refunds
            ]);

        } catch (\Exception $e) {
            Log::error('Get refund info error', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin hoàn tiền'
            ], 500);
        }
    }

    /**
     * Hiển thị trang chi tiết hủy đơn hàng
     */
    public function showCancellationDetail($orderId)
    {
        try {
            $order = Order::with(['items.product.thumbnail', 'items.productVariant.image', 'paymentMethod', 'refunds'])
                ->where('id', $orderId)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return redirect()->route('client.profile.my_account.order')
                    ->with('error', 'Không tìm thấy đơn hàng');
            }

            // Lấy refund mới nhất
            $refund = $order->refunds()->latest()->first();

            $statusMap = [
                'pending_confirmation' => 'Chờ xác nhận',
                'processing' => 'Đang xử lý',
                'shipped' => 'Đang giao hàng',
                'delivered' => 'Đã giao hàng',
                'cancelled' => 'Đã hủy',
                'returned' => 'Đã trả hàng',
            ];

            return view('client.profile.order-cancellation', [
                'order' => $order,
                'refund' => $refund,
                'statusMap' => $statusMap
            ]);

        } catch (\Exception $e) {
            Log::error('Show cancellation detail error', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('client.profile.my_account.order')
                ->with('error', 'Có lỗi xảy ra khi tải trang chi tiết');
        }
    }

    /**
     * Kiểm tra trạng thái hoàn tiền
     */
    public function checkRefundStatus($refundId)
    {
        try {
            $refund = \App\Models\Refund::with('order')
                ->whereHas('order', function($query) {
                    $query->where('user_id', Auth::id());
                })
                ->find($refundId);

            if (!$refund) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy thông tin hoàn tiền'
                ], 404);
            }

            // Kiểm tra trạng thái từ gateway
            $status = $this->refundService->checkRefundStatus($refund);

            if ($status) {
                return response()->json([
                    'success' => true,
                    'message' => 'Trạng thái hoàn tiền đã được cập nhật'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Chưa thể cập nhật trạng thái. Vui lòng thử lại sau.'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Check refund status error', [
                'refund_id' => $refundId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi kiểm tra trạng thái'
            ], 500);
        }
    }

    /**
     * Test refund cho đơn hàng
     */
    public function testRefund(Request $request, Order $order)
    {
        try {
            // Kiểm tra quyền
            if ($order->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Không có quyền truy cập'
                ], 403);
            }

            // Test refund
            $result = $this->refundService->processRefund($order, 'Test refund');
            
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test kết nối VNPay
     */
    public function testVNPayConnection(Request $request)
    {
        try {
            $result = $this->refundService->testVNPayConnection();
            
            return response()->json([
                'success' => true,
                'connection' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
