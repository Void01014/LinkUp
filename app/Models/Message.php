<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    protected $fillable = ['sender_id', 'receiver_id', 'content'];

    public function attachmentable(): MorphTo
    {
        return $this->morphTo();
    }
}
