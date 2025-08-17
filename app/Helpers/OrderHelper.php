<?php

namespace App\Helpers;

class OrderHelper
{
    /**
     * Lấy tên hiển thị của trạng thái đơn hàng
     */
    public static function getStatusDisplayName($status)
    {
        $statusMap = [
            'pending_confirmation' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'assigned' => 'Đã phân công',
            'received' => 'Đã nhận hàng',
            'in_delivery' => 'Đang giao hàng',
            'shipped' => 'Đang giao hàng',
            'delivered' => 'Đã giao hàng',
            'failed' => 'Giao hàng thất bại',
            'cancelled' => 'Đã hủy',
            'returned' => 'Đã trả hàng',
            'pending_cancellation' => 'Chờ hủy',
        ];

        return $statusMap[$status] ?? ucfirst(str_replace('_', ' ', $status));
    }

    /**
     * Lấy class CSS cho trạng thái đơn hàng
     */
    public static function getStatusClass($status)
    {
        $classMap = [
            'pending_confirmation' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-purple-100 text-purple-800',
            'assigned' => 'bg-blue-100 text-blue-800',
            'received' => 'bg-blue-100 text-blue-800',
            'in_delivery' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-blue-100 text-blue-800',
            'delivered' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'returned' => 'bg-orange-100 text-orange-800',
            'pending_cancellation' => 'bg-gray-100 text-gray-800',
        ];

        return $classMap[$status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Lấy màu Bootstrap cho trạng thái đơn hàng
     */
    public static function getStatusBootstrapClass($status)
    {
        $classMap = [
            'pending_confirmation' => 'warning',
            'confirmed' => 'info',
            'pending' => 'warning',
            'processing' => 'info',
            'assigned' => 'primary',
            'received' => 'info',
            'in_delivery' => 'warning',
            'shipped' => 'info',
            'delivered' => 'success',
            'failed' => 'danger',
            'cancelled' => 'danger',
            'returned' => 'warning',
            'pending_cancellation' => 'secondary',
        ];

        return $classMap[$status] ?? 'secondary';
    }
}
