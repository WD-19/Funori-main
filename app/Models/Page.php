<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id',
        'page_type',
        'status',
        'meta_title',
        'meta_description',
        'featured_image_url',
        'published_at',
    ];

    protected $casts = [
        'page_type' => 'string', 
        'status' => 'string', 
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}