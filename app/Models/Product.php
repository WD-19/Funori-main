<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'stock_quantity',
        'category_id',
        'brand_id',
        'status',
        'is_featured',
        'view_count',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'status' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class)->oldestOfMany();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product', 'product_id', 'promotion_id');
    }
    public function materialAttributeValues()
    {
        return $this->hasManyThrough(
            AttributeValue::class,
            ProductVariantAttributeValue::class,
            'product_id', // Foreign key on ProductVariantAttributeValue table
            'id',         // Foreign key on AttributeValue table
            'id',         // Local key on Product table
            'attribute_value_id' // Local key on ProductVariantAttributeValue table
        );
    }
}
