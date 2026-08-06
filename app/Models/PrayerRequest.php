<?php

namespace App\Models;

use App\Casts\EncryptedString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrayerRequest extends Model
{
    use SoftDeletes;

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
        'delete_reason',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'date_answered' => 'date',
            'deleted_at' => 'datetime',
            'whatsapp' => EncryptedString::class,
            'email' => EncryptedString::class,
        ];
    }
}
