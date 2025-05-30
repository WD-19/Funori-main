<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PromotionCategory extends Pivot
{
    use HasFactory;

    protected $table = 'promotion_category';

    public $timestamps = false; // Tương tự PromotionProduct

    protected $fillable = [
        'promotion_id',
        'category_id',
    ];

    // Relationships
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}