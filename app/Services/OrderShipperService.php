<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Support\Facades\Log;

class OrderShipperService
{
    /**
     * Tự động gán shipper cho đơn hàng mới
     */
    public static function autoAssignShipper(Order $order)
    {
        try {
            // Chỉ gán shipper cho đơn hàng đã được xác nhận
            if (!in_array($order->order_status, ['confirmed', 'pending'])) {
                return false;
            }

            // Nếu đã có shipper thì bỏ qua
            if ($order->shipper_id) {
                return false;
            }

            // Lấy shipper có ít đơn hàng đang xử lý nhất
            $availableShipper = self::getAvailableShipper();

            if (!$availableShipper) {
                Log::warning("Không có shipper nào khả dụng cho đơn hàng {$order->order_code}");
                return false;
            }

            // Gán shipper và cập nhật trạng thái
            $order->update([
                'shipper_id' => $availableShipper->id,
                'order_status' => 'processing'
            ]);

            Log::info("Đã gán đơn hàng {$order->order_code} cho shipper {$availableShipper->name}");
            
            return true;

        } catch (\Exception $e) {
            Log::error("Lỗi khi gán shipper cho đơn hàng {$order->order_code}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy shipper có ít đơn hàng đang xử lý nhất
     */
    public static function getAvailableShipper()
    {
        return Shipper::where('status', 'active')
            ->withCount(['orders' => function($query) {
                $query->whereIn('order_status', ['processing', 'shipped']);
            }])
            ->orderBy('orders_count', 'asc')
            ->first();
    }

    /**
     * Phân chia lại đơn hàng khi shipper không khả dụng
     */
    public static function reassignOrders($unavailableShipperId)
    {
        try {
            // Lấy các đơn hàng đang xử lý của shipper không khả dụng
            $orders = Order::where('shipper_id', $unavailableShipperId)
                ->whereIn('order_status', ['processing', 'shipped'])
                ->get();

            if ($orders->isEmpty()) {
                return 0;
            }

            $reassignedCount = 0;

            foreach ($orders as $order) {
                $newShipper = self::getAvailableShipper();
                
                if ($newShipper && $newShipper->id != $unavailableShipperId) {
                    $order->update(['shipper_id' => $newShipper->id]);
                    $reassignedCount++;
                    
                    Log::info("Đã chuyển đơn hàng {$order->order_code} từ shipper {$unavailableShipperId} sang shipper {$newShipper->name}");
                }
            }

            return $reassignedCount;

        } catch (\Exception $e) {
            Log::error("Lỗi khi phân chia lại đơn hàng: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Lấy thống kê phân chia đơn hàng
     */
    public static function getAssignmentStats()
    {
        return [
            'total_shippers' => Shipper::where('status', 'active')->count(),
            'total_unassigned_orders' => Order::whereNull('shipper_id')
                ->whereIn('order_status', ['confirmed', 'pending'])
                ->count(),
            'total_processing_orders' => Order::whereNotNull('shipper_id')
                ->whereIn('order_status', ['processing', 'shipped'])
                ->count(),
            'shipper_workload' => Shipper::where('status', 'active')
                ->withCount(['orders' => function($query) {
                    $query->whereIn('order_status', ['processing', 'shipped']);
                }])
                ->get()
                ->map(function($shipper) {
                    return [
                        'name' => $shipper->name,
                        'email' => $shipper->email,
                        'active_orders' => $shipper->orders_count,
                        'status' => $shipper->orders_count >= 5 ? 'busy' : 'available'
                    ];
                })
        ];
    }

    /**
     * Kiểm tra và gán shipper cho tất cả đơn hàng chưa được gán
     */
    public static function assignAllUnassignedOrders()
    {
        $unassignedOrders = Order::whereNull('shipper_id')
            ->whereIn('order_status', ['confirmed', 'pending'])
            ->get();

        $assignedCount = 0;

        foreach ($unassignedOrders as $order) {
            if (self::autoAssignShipper($order)) {
                $assignedCount++;
            }
        }

        return $assignedCount;
    }
}