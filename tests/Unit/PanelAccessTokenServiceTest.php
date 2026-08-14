<?php

namespace Tests\Unit;

use App\Models\PanelAccessToken;
use App\Services\PanelAccessTokenService;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class PanelAccessTokenServiceTest extends TestCase
{
    use LazilyRefreshDatabase;

    private PanelAccessTokenService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PanelAccessTokenService;
    }

    public function test_issue_creates_hashed_token_and_returns_raw_token(): void
    {
        $raw = $this->service->issue();

        $this->assertIsString($raw);
        $this->assertSame(64, strlen($raw));
        $this->assertDatabaseHas('panel_access_tokens', [
            'token_hash' => hash('sha256', $raw),
        ]);
        $this->assertDatabaseMissing('panel_access_tokens', [
            'token_hash' => $raw,
        ]);
    }

    public function test_validate_returns_true_for_active_token(): void
    {
        $raw = $this->service->issue();

        $this->assertTrue($this->service->validate($raw));
    }

    public function test_validate_returns_false_for_unknown_token(): void
    {
        $this->assertFalse($this->service->validate('unknown-token'));
    }

    public function test_validate_returns_false_for_null_or_blank_token(): void
    {
        $this->assertFalse($this->service->validate(null));
        $this->assertFalse($this->service->validate(''));
    }

    public function test_validate_returns_false_for_expired_token(): void
    {
        $raw = $this->service->issue();

        PanelAccessToken::query()
            ->where('token_hash', hash('sha256', $raw))
            ->update(['expires_at' => now()->subMinute()]);

        $this->assertFalse($this->service->validate($raw));
    }

    public function test_issue_respects_configured_ttl(): void
    {
        config()->set('app.dashboard_token_ttl', 30);

        $raw = $this->service->issue();

        $stored = PanelAccessToken::query()
            ->where('token_hash', hash('sha256', $raw))
            ->firstOrFail();

        $this->assertEqualsWithDelta(
            now()->addMinutes(30)->getTimestamp(),
            $stored->expires_at->getTimestamp(),
            2,
        );
    }

    public function test_revoke_deletes_token(): void
    {
        $raw = $this->service->issue();

        $this->service->revoke($raw);

        $this->assertDatabaseMissing('panel_access_tokens', [
            'token_hash' => hash('sha256', $raw),
        ]);
        $this->assertFalse($this->service->validate($raw));
    }

    public function test_revoke_with_blank_token_does_nothing(): void
    {
        $raw = $this->service->issue();

        $this->service->revoke(null);
        $this->service->revoke('');

        $this->assertTrue($this->service->validate($raw));
    }
}
