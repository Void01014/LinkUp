<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrScan extends Model

{

    protected $table = 'qr_code';

    protected $fillable = ['user_id', 'token', 'hits', 'expires_at'];

    protected $casts = [

        'expires_at' => 'datetime',

    ];

    public function user(): BelongsTo

    {

        return $this->belongsTo(User::class);

    }

    public function isExpired(): bool

    {

        return $this->expires_at->isPast();

    }

    public function isValid(): bool

    {

        return !$this->isExpired();

    }

}