<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'transaction_id',        // ✅ Thêm vào
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
        'processing_at',
        'shipped_at',
        'returned_at',
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
        'processing_at' => 'datetime',    // ✅ Thêm vào
        'shipped_at' => 'datetime',       // ✅ Thêm vào
        'returned_at' => 'datetime',      // ✅ Thêm vào
        'payment_details' => 'array',
        'received_at' => 'datetime',
        'in_delivery_at' => 'datetime',
        'delivered_at' => 'datetime',
        'failed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'delivery_images' => 'array',
        'payment_status' => 'string',
        'order_status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'order_promotion')->withPivot('discount_applied');
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    public function latestRefund()
    {
        return $this->hasOne(Refund::class)->latest();
    }
      public function status_histories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
     public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the shipper assigned to this order
     */
    public function shipper()
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
}