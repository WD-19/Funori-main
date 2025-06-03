<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PromotionProduct extends Pivot
{
    use HasFactory;

    // Tên bảng nếu không theo quy ước của Laravel
    protected $table = 'promotion_product';

    // Laravel tự động quản lý timestamps cho pivot tables,
    // nhưng nếu bạn không có created_at/updated_at trong bảng pivot,
    // bạn có thể tắt nó:
    public $timestamps = false;

    // Nếu bạn cần các thuộc tính fillable cho bảng pivot
    protected $fillable = [
        'promotion_id',
        'product_id',
    ];

    // Relationships
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}