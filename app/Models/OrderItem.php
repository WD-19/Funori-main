<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'product_name',
    'variant_attributes',
    'variant',
    'price',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
    'variant_attributes' => 'array',
    'variant' => 'array',
    'subtotal' => 'decimal:2',
    'price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    /**
     * Get the price per unit
     */
    public function getPriceAttribute()
    {
        // If a price column was stored at purchase time, return it.
        if (array_key_exists('price', $this->attributes) && $this->attributes['price'] !== null) {
            return (float) $this->attributes['price'];
        }

        // Fallback: derive from subtotal/quantity when price was not persisted.
        if ($this->quantity && $this->quantity > 0) {
            return (float) ($this->subtotal / $this->quantity);
        }

        return 0.0;
    }
}