<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    protected $signature = 'app:update-order-status';
    protected $description = 'Update order statuses based on elapsed time';

    public function handle()
    {
        $now = now();

        // Chuyển từ pending → processing (sau 20 giây)
        $pendingOrders = Order::where('order_status', 'pending_confirmation')
            ->where('created_at', '<=', $now->copy()->subSeconds(20))
            ->get();

        foreach ($pendingOrders as $order) {
            $order->order_status = 'processing';
            $order->processing_at = $now;
            $order->save();

            // Lưu lịch sử
            $order->status_histories()->create([
                'status' => 'processing',
                'note' => 'Tự động chuyển trạng thái: pending_confirmation → processing',
                'created_at' => $now,
            ]);
        }

        // Chuyển từ processing → shipped (sau 30 giây)
        $processingOrders = Order::where('order_status', 'processing')
            ->where('processing_at', '<=', $now->copy()->subSeconds(30))
            ->get();

        foreach ($processingOrders as $order) {
            $order->order_status = 'shipped';
            $order->shipped_at = $now;
            $order->save();

            $order->status_histories()->create([
                'status' => 'shipped',
                'note' => 'Tự động chuyển trạng thái: processing → shipped',
                'created_at' => $now,
            ]);
        }

        // Chuyển từ shipped → delivered (sau 60 giây)
        $shippedOrders = Order::where('order_status', 'shipped')
            ->where('shipped_at', '<=', $now->copy()->subSeconds(60))
            ->get();

        foreach ($shippedOrders as $order) {
            $order->order_status = 'delivered';
            $order->delivered_at = $now;
            $order->save();

            $order->status_histories()->create([
                'status' => 'delivered',
                'note' => 'Tự động chuyển trạng thái: shipped → delivered',
                'created_at' => $now,
            ]);
        }

        $this->info('Order statuses updated and histories saved.');
    }
}
