<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PromotionBrand extends Pivot
{
    use HasFactory;

    protected $table = 'promotion_brand';
    public $timestamps = false;

    protected $fillable = [
        'promotion_id',
        'brand_id',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}