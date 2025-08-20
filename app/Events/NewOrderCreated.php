<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // Channel cho admin - thông báo đơn hàng mới
            new PrivateChannel('admin.orders'),
            
            // Channel cho shipper - thông báo đơn hàng mới cần xử lý
            new Channel('shipper.orders'),
            
            // Channel public cho thông báo chung
            new Channel('orders.new'),
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
            'order_status' => $this->order->order_status,
            'total_amount' => $this->order->total_amount,
            'shipping_address' => $this->order->shipping_address,
            'shipping_phone' => $this->order->shipping_phone,
            'created_at' => $this->order->created_at->toISOString(),
            'user' => [
                'id' => $this->order->user->id ?? null,
                'name' => $this->order->user->name ?? $this->order->customer_name,
                'phone' => $this->order->user->phone ?? $this->order->customer_phone,
            ],
        ];
    }

    /**
     * Get the broadcast event name.
     */
    public function broadcastAs(): string
    {
        return 'order.created';
    }
}
