<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RefundController extends Controller
{
    /**
     * Hiển thị danh sách refund
     */
    public function index()
    {
        $refunds = Refund::with(['order.user', 'order.paymentMethod'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.refunds.index', compact('refunds'));
    }

    /**
     * Hiển thị chi tiết refund
     */
    public function show($id)
    {
        $refund = Refund::with(['order.user', 'order.paymentMethod', 'order.orderItems.product'])
            ->findOrFail($id);

        return view('admin.refunds.show', compact('refund'));
    }

    /**
     * Mark refund thành công thủ công
     */
    public function markAsSuccess(Request $request, $id)
    {
        $refund = Refund::findOrFail($id);
        
        try {
            $refund->update([
                'status' => 'success',
                'refunded_at' => now(),
                'gateway_response' => array_merge($refund->gateway_response ?? [], [
                    'manual_approved' => true,
                    'approved_by' => auth()->id(),
                    'approved_at' => now()->toISOString()
                ])
            ]);

            // Cập nhật trạng thái đơn hàng
            $refund->order->update(['order_status' => 'cancelled']);

            Log::info('Refund marked as success manually', [
                'refund_id' => $refund->id,
                'order_id' => $refund->order_id,
                'approved_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đã đánh dấu hoàn tiền thành công'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to mark refund as success', [
                'refund_id' => $refund->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark refund thất bại
     */
    public function markAsFailed(Request $request, $id)
    {
        $refund = Refund::findOrFail($id);
        
        try {
            $refund->update([
                'status' => 'failed',
                'gateway_response' => array_merge($refund->gateway_response ?? [], [
                    'manual_failed' => true,
                    'failed_reason' => $request->input('reason', 'Admin marked as failed'),
                    'failed_by' => auth()->id(),
                    'failed_at' => now()->toISOString()
                ])
            ]);

            Log::info('Refund marked as failed manually', [
                'refund_id' => $refund->id,
                'order_id' => $refund->order_id,
                'failed_by' => auth()->id(),
                'reason' => $request->input('reason')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đã đánh dấu hoàn tiền thất bại'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to mark refund as failed', [
                'refund_id' => $refund->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
