<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
