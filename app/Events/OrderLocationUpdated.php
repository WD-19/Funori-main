<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class OrderLocationUpdated implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, InteractsWithQueue;

    public $order;
    public $latitude;
    public $longitude;
    public $address;
    public $updatedBy;
    public $timestamp;
    public $tries = 2; // Ít retry hơn cho location updates
    public $timeout = 20; // Timeout ngắn hơn
    public $backoff = [5, 15]; // Delay ngắn hơn

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order, $latitude, $longitude, $address = null, $updatedBy = null)
    {
        $this->order = $order;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address;
        $this->updatedBy = $updatedBy;
        $this->timestamp = now();
        
        // Log event creation
        Log::info('OrderLocationUpdated event created', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'latitude' => $latitude,
            'longitude' => $longitude,
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
            // Channel cho admin - tracking vị trí đơn hàng
            new PrivateChannel('admin.orders'),
            
            // Channel cho client - theo dõi vị trí giao hàng
            new PrivateChannel('client.orders.' . $this->order->user_id),
            
            // Channel cho shipper - cập nhật vị trí
            new Channel('shipper.orders'),
            
            // Channel public cho order cụ thể
            new Channel('orders.' . $this->order->id . '.location'),
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'updated_by' => $this->updatedBy,
            'timestamp' => $this->timestamp->toISOString(),
            'order' => [
                'id' => $this->order->id,
                'order_code' => $this->order->order_code,
                'order_status' => $this->order->order_status,
                'shipping_address' => $this->order->shipping_address,
            ],
        ];
    }

    /**
     * Get the broadcast event name.
     */
    public function broadcastAs(): string
    {
        return 'order.location.updated';
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('OrderLocationUpdated event failed', [
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
        return 5; // Retry sau 5 giây
    }
}
