<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPromotion extends Model
{
    use HasFactory;

    protected $table = 'order_promotion'; // Tên bảng nếu không theo quy ước

    public $timestamps = false; // Bảng này chỉ có created_at, không có updated_at

    protected $fillable = [
        'order_id',
        'promotion_id',
        'discount_applied',
    ];

    protected $casts = [
        'discount_applied' => 'decimal:2',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}