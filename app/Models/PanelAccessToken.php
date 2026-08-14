<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A single-use, time-limited access token for the painel (dashboard).
 *
 * Only the SHA-256 hash of the raw token is stored; the raw value lives
 * exclusively in the session of the authenticated panelist.
 */
class PanelAccessToken extends Model
{
    protected $table = 'panel_access_tokens';

    protected $fillable = ['token_hash', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
