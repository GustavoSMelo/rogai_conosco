<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
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

        $this->withSession(['dashboard_authenticated' => true])
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

        $this->withSession(['dashboard_authenticated' => true])
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

        $this->withSession(['dashboard_authenticated' => true])
            ->get('/painel')
            ->assertStatus(200)
            ->assertSee('Nenhum pedido pendente');
    }

    public function test_logout_clears_session_and_redirects(): void
    {
        $this->withSession(['dashboard_authenticated' => true])
            ->post('/painel/logout')
            ->assertRedirect('/painel/login');

        $this->get('/painel')
            ->assertRedirect('/painel/login');
    }
}
