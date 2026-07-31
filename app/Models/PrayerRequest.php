<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    protected $fillable = [
        'name',
        'message',
        'delivery',
        'email',
        'whatsapp',
        'religion',
        'prayer_type',
        'has_answered',
        'date_answered',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'date_answered' => 'date',
            'whatsapp' => \App\Casts\EncryptedString::class,
            'email' => \App\Casts\EncryptedString::class,
        ];
    }
}
