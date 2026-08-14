<?php

namespace App\Services;

use App\Models\PanelAccessToken;
use Illuminate\Support\Str;

/**
 * Issues, validates and revokes painel access tokens.
 *
 * The raw token is returned to the caller (stored in the session); only its
 * SHA-256 hash is persisted, so a database leak does not expose usable tokens.
 * Tokens expire after `app.dashboard_token_ttl` minutes (default: 24h).
 */
class PanelAccessTokenService
{
    /**
     * Generate a new token, persist its hash and return the raw value.
     */
    public function issue(): string
    {
        $raw = Str::random(64);

        PanelAccessToken::create([
            'token_hash' => hash('sha256', $raw),
            'expires_at' => now()->addMinutes((int) config('app.dashboard_token_ttl', 1440)),
        ]);

        return $raw;
    }

    /**
     * Check whether a raw token exists and has not expired yet.
     */
    public function validate(?string $token): bool
    {
        if (blank($token)) {
            return false;
        }

        $stored = PanelAccessToken::query()
            ->where('token_hash', hash('sha256', $token))
            ->first();

        return $stored !== null && ! $stored->expires_at->isPast();
    }

    /**
     * Revoke a raw token by deleting its stored hash.
     */
    public function revoke(?string $token): void
    {
        if (blank($token)) {
            return;
        }

        PanelAccessToken::query()
            ->where('token_hash', hash('sha256', $token))
            ->delete();
    }
}
