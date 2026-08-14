<?php

namespace Tests\Feature;

use App\Models\PanelAccessToken;
use App\Models\PrayerRequest;
use App\Services\PanelAccessTokenService;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardAuthTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $plaintext = 'secret123';
        $encrypted = Crypt::encryptString($plaintext);
        config()->set('app.dashboard_password', $encrypted);
    }

    private function authenticate(): static
    {
        $token = app(PanelAccessTokenService::class)->issue();

        $this->withSession(['rcapp-token' => $token]);

        return $this;
    }

    public function test_redirects_to_login_when_not_authenticated(): void
    {
        $this->get('/painel')
            ->assertRedirect('/painel/login');
    }

    public function test_login_page_renders(): void
    {
        $this->get('/painel/login')
            ->assertStatus(200)
            ->assertSee('Acesso Restrito');
    }

    public function test_login_page_html_is_balanced(): void
    {
        $response = $this->get('/painel/login');

        $html = $response->getContent();

        preg_match_all('/<div[\s>]/', $html, $opens);
        preg_match_all('/<\/div>/', $html, $closes);

        $this->assertCount(count($closes[0]), $opens[0]);
    }

    public function test_login_with_correct_password_redirects_to_dashboard(): void
    {
        Livewire::test('painel::painel-login')
            ->set('password', 'secret123')
            ->call('login')
            ->assertRedirect('/painel');
    }

    public function test_login_with_incorrect_password_shows_error(): void
    {
        Livewire::test('painel::painel-login')
            ->set('password', 'wrong-password')
            ->call('login')
            ->assertNoRedirect()
            ->assertSee('Senha incorreta');
    }

    public function test_login_with_empty_password_shows_error(): void
    {
        Livewire::test('painel::painel-login')
            ->set('password', '')
            ->call('login')
            ->assertNoRedirect()
            ->assertSee('Digite a senha');
    }

    public function test_dashboard_lists_unanswered_requests(): void
    {
        PrayerRequest::create([
            'name' => 'Answered person',
            'message' => Crypt::encryptString('Answered person prayer'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-video',
            'has_answered' => true,
            'date_answered' => now(),
        ]);

        PrayerRequest::create([
            'name' => 'AI not person',
            'message' => Crypt::encryptString('AI request'),
            'delivery' => 'ai',
            'prayer_type' => 'ai',
            'has_answered' => false,
            'date_answered' => null,
        ]);

        PrayerRequest::create([
            'name' => 'Waiting',
            'message' => Crypt::encryptString('Still waiting for prayer'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('wait@b.com'),
            'whatsapp' => Crypt::encryptString('+5522222222222'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        $this->authenticate()
            ->get('/painel')
            ->assertStatus(200)
            ->assertSee('Still waiting for prayer')
            ->assertDontSee('Answered person prayer')
            ->assertDontSee('AI request');
    }

    public function test_dashboard_shows_anonymous_for_null_name(): void
    {
        PrayerRequest::create([
            'name' => null,
            'message' => Crypt::encryptString('Anonymous request'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'has_answered' => false,
            'date_answered' => null,
        ]);

        $this->authenticate()
            ->get('/painel')
            ->assertStatus(200)
            ->assertSee('Anônimo');
    }

    public function test_dashboard_shows_empty_state_when_none_unanswered(): void
    {
        PrayerRequest::create([
            'name' => 'AI only',
            'message' => Crypt::encryptString('AI request not shown'),
            'delivery' => 'ai',
            'prayer_type' => 'ai',
            'has_answered' => false,
            'date_answered' => null,
        ]);

        $this->authenticate()
            ->get('/painel')
            ->assertStatus(200)
            ->assertSee('Nenhum pedido pendente');
    }

    public function test_logout_clears_session_and_redirects(): void
    {
        $this->authenticate()
            ->post('/painel/logout')
            ->assertRedirect('/painel/login');

        $this->get('/painel')
            ->assertRedirect('/painel/login');
    }

    public function test_login_issues_token_and_stores_it_in_session(): void
    {
        Livewire::test('painel::painel-login')
            ->set('password', 'secret123')
            ->call('login')
            ->assertRedirect('/painel');

        $this->assertTrue(session()->has('rcapp-token'));
        $this->assertDatabaseHas('panel_access_tokens', [
            'token_hash' => hash('sha256', session('rcapp-token')),
        ]);
    }

    public function test_login_with_incorrect_password_does_not_issue_token(): void
    {
        Livewire::test('painel::painel-login')
            ->set('password', 'wrong-password')
            ->call('login')
            ->assertNoRedirect();

        $this->assertFalse(session()->has('rcapp-token'));
        $this->assertSame(0, PanelAccessToken::query()->count());
    }

    public function test_dashboard_redirects_to_login_when_token_is_invalid(): void
    {
        $this->withSession(['rcapp-token' => 'invalid-token'])
            ->get('/painel')
            ->assertRedirect('/painel/login');
    }

    public function test_dashboard_redirects_to_login_when_token_is_expired(): void
    {
        $raw = app(PanelAccessTokenService::class)->issue();

        PanelAccessToken::query()
            ->where('token_hash', hash('sha256', $raw))
            ->update(['expires_at' => now()->subMinute()]);

        $this->withSession(['rcapp-token' => $raw])
            ->get('/painel')
            ->assertRedirect('/painel/login');
    }

    public function test_dashboard_forwards_requests_with_valid_token(): void
    {
        $this->authenticate()
            ->get('/painel')
            ->assertStatus(200);
    }

    public function test_logout_revokes_token_in_database(): void
    {
        $this->authenticate();

        $raw = session('rcapp-token');

        $this->post('/painel/logout')
            ->assertRedirect('/painel/login');

        $this->assertDatabaseMissing('panel_access_tokens', [
            'token_hash' => hash('sha256', $raw),
        ]);
    }

    public function test_expired_token_is_forgotten_from_session(): void
    {
        $raw = app(PanelAccessTokenService::class)->issue();

        PanelAccessToken::query()
            ->where('token_hash', hash('sha256', $raw))
            ->update(['expires_at' => now()->subMinute()]);

        $this->withSession(['rcapp-token' => $raw])
            ->get('/painel');

        $this->assertFalse(session()->has('rcapp-token'));
    }
}
