<?php

namespace App\Models;

use App\Events\NewOrderCreated;
use App\Events\OrderStatusUpdated;
use App\Events\OrderLocationUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'buyer_address',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'subtotal_amount',
        'shipping_fee',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'payment_method_id',
        'payment_details',
        'payment_status',
        'shipping_method_id',
        'order_status',
        'customer_note',
        'admin_note',
        'ordered_at',
        'received_at',
        'in_delivery_at',
        'delivered_at',
        'failed_at',
        'cancelled_at',
        'cancellation_reason',
        'discount_code',
        'shipper_id',
        'delivery_notes',
        'failure_reason',
        'delivery_images',
        'shipping_lat',
        'shipping_lng',
        'delivery_lat',
        'delivery_lng',
        'delivery_started_at',
        'delivery_completed_at',
        'delivery_address',
    ];

    protected $casts = [
        'subtotal_amount' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'ordered_at' => 'datetime',
        'payment_details' => 'array',
        'received_at' => 'datetime',
        'in_delivery_at' => 'datetime',
        'delivered_at' => 'datetime',
        'failed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'delivery_images' => 'array',
        'payment_status' => 'string', // Enum
        'order_status' => 'string', // Enum
    ];

    protected $dispatchesEvents = [
        'created' => NewOrderCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class, 'order_promotion')->withPivot('discount_applied');
    }

    public function status_histories(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the shipper assigned to this order
     */
    public function shipper(): BelongsTo
    {
        return $this->belongsTo(Shipper::class);
    }

    public static function getAllowedStatusTransitions(): array
    {
        return [
            'pending_confirmation' => ['processing', 'cancelled'],
            'processing'           => ['shipped', 'cancelled'],
            'shipped'              => ['delivered', 'returned'],
            'delivered'            => ['returned'],
            'returned'             => [],
            'cancelled'            => [],
        ];
    }

    /**
     * Update order status and dispatch event
     */
    public function updateStatus($newStatus, $updatedBy = null)
    {
        $previousStatus = $this->order_status;
        
        $this->update(['order_status' => $newStatus]);
        
        // Dispatch event for realtime updates
        event(new OrderStatusUpdated($this, $previousStatus, $newStatus, $updatedBy));
        
        return $this;
    }

    /**
     * Update order location and dispatch event
     */
    public function updateLocation($latitude, $longitude, $address = null, $updatedBy = null)
    {
        $this->update([
            'delivery_lat' => $latitude,
            'delivery_lng' => $longitude,
            'delivery_address' => $address,
        ]);
        
        // Dispatch event for realtime updates
        event(new OrderLocationUpdated($this, $latitude, $longitude, $address, $updatedBy));
        
        return $this;
    }
}