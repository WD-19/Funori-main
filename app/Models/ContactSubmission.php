<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_reply',
        'replied_by',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
