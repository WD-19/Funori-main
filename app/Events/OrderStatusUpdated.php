<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class OrderStatusUpdated implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, InteractsWithQueue;

    public $order;
    public $previousStatus;
    public $newStatus;
    public $updatedBy;
    public $timestamp;
    public $tries = 3; // Số lần retry
    public $timeout = 30; // Timeout cho mỗi job (giây)
    public $backoff = [10, 30, 60]; // Delay giữa các lần retry (giây)

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order, $previousStatus, $newStatus, $updatedBy = null)
    {
        $this->order = $order;
        $this->previousStatus = $previousStatus;
        $this->newStatus = $newStatus;
        $this->updatedBy = $updatedBy;
        $this->timestamp = now();
        
        // Log event creation
        Log::info('OrderStatusUpdated event created', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'previous_status' => $previousStatus,
            'new_status' => $newStatus,
            'updated_by' => $updatedBy,
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // Channel cho admin - tracking đơn hàng
            new PrivateChannel('admin.orders'),
            
            // Channel cho client - timeline vận chuyển
            new PrivateChannel('client.orders.' . $this->order->user_id),
            
            // Channel cho shipper - danh sách và cập nhật đơn hàng
            new Channel('shipper.orders'),
            
            // Channel public cho order cụ thể (nếu cần)
            new Channel('orders.' . $this->order->id),
        ];
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'order_id' => $this->order->id,
            'order_code' => $this->order->order_code,
            'previous_status' => $this->previousStatus,
            'new_status' => $this->newStatus,
            'updated_by' => $this->updatedBy,
            'timestamp' => $this->timestamp->toISOString(),
            'order' => [
                'id' => $this->order->id,
                'order_code' => $this->order->order_code,
                'order_status' => $this->order->order_status,
                'shipping_address' => $this->order->shipping_address,
                'shipping_phone' => $this->order->shipping_phone,
                'total_amount' => $this->order->total_amount,
                'updated_at' => $this->order->updated_at->toISOString(),
                'user' => [
                    'id' => $this->order->user->id ?? null,
                    'name' => $this->order->user->name ?? $this->order->customer_name,
                    'phone' => $this->order->user->phone ?? $this->order->customer_phone,
                ],
                'shipper' => $this->order->shipper ? [
                    'id' => $this->order->shipper->id,
                    'name' => $this->order->shipper->name,
                    'phone' => $this->order->shipper->phone,
                ] : null,
            ],
        ];
    }

    /**
     * Get the broadcast event name.
     */
    public function broadcastAs(): string
    {
        return 'order.status.updated';
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('OrderStatusUpdated event failed', [
            'order_id' => $this->order->id,
            'order_code' => $this->order->order_code,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }

    /**
     * Determine the time at which the job should timeout.
     */
    public function retryAfter(): int
    {
        return 10; // Retry sau 10 giây
    }
}
