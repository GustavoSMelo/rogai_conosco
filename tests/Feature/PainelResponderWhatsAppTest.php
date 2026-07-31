<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Tests\TestCase;

class PainelResponderWhatsAppTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function makeRequest(?string $whatsapp, array $overrides = []): PrayerRequest
    {
        return PrayerRequest::create(array_merge([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'whatsapp' => $whatsapp ? Crypt::encryptString($whatsapp) : null,
            'has_answered' => false,
            'date_answered' => null,
        ], $overrides));
    }

    public function test_renders_wa_me_link_with_digits_and_media_url(): void
    {
        $request = $this->makeRequest('+55 (11) 91234-5678');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaLink', 'https://example.com/audio.mp3')
            ->assertSeeHtml('href="https://wa.me/5511912345678?text=')
            ->assertSee('_blank')
            ->assertSee('noopener')
            ->assertSee('Enviar WhatsApp');
    }

    public function test_prefilled_message_contains_media_link(): void
    {
        $request = $this->makeRequest('5511912345678');

        $component = Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaLink', 'https://example.com/audio.mp3');

        $html = $component->html();
        preg_match('/href="(https:\/\/wa\.me\/[^"]+)"/', $html, $matches);
        $this->assertNotEmpty($matches);
        $decoded = urldecode($matches[1]);
        $this->assertStringContainsString('Ouvir mensagem: https://example.com/audio.mp3', $decoded);
    }

    public function test_uploaded_file_without_link_does_not_send_whatsapp(): void
    {
        $request = $this->makeRequest('5511912345678');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaUrl', '/storage/response-media/oracao.mp3')
            ->assertDontSee('wa.me')
            ->assertSee('painel-btn-disabled')
            ->assertSee('Informe um link de mídia para enviar por WhatsApp.');
    }

    public function test_link_is_used_over_uploaded_file(): void
    {
        $request = $this->makeRequest('5511912345678');

        $component = Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaUrl', '/storage/response-media/oracao.mp3')
            ->set('mediaLink', 'https://example.com/audio.mp3');

        $html = $component->html();
        preg_match('/href="(https:\/\/wa\.me\/[^"]+)"/', $html, $matches);
        $this->assertNotEmpty($matches);
        $decoded = urldecode($matches[1]);
        $this->assertStringContainsString('Ouvir mensagem: https://example.com/audio.mp3', $decoded);
        $this->assertStringNotContainsString('response-media', $decoded);
    }

    public function test_accepts_valid_https_links_with_allowed_tlds(): void
    {
        $request = $this->makeRequest('5511912345678');

        foreach ([
            'https://example.com/audio.mp3',
            'https://example.com.br/oracao.mp4',
            'https://example.dev.br',
            'https://example.app.br/prayer',
            'https://sub.example.dev',
            'https://example.app/prayer?ref=1',
        ] as $link) {
            Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
                ->set('mediaLink', $link)
                ->assertSeeHtml('href="https://wa.me/5511912345678?text=');
        }
    }

    public function test_rejects_link_without_https(): void
    {
        $request = $this->makeRequest('5511912345678');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaLink', 'http://example.com/audio.mp3')
            ->assertDontSee('wa.me')
            ->assertSee('painel-btn-disabled');
    }

    public function test_rejects_broken_urls(): void
    {
        $request = $this->makeRequest('5511912345678');

        foreach ([
            'https://example.org/audio.mp3',
            'https://example.io',
            'https://example',
            'not a url',
            'https://',
        ] as $link) {
            Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
                ->set('mediaLink', $link)
                ->assertDontSee('wa.me')
                ->assertSee('painel-btn-disabled');
        }
    }

    public function test_rejects_relative_link(): void
    {
        $request = $this->makeRequest('5511912345678');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaLink', '/storage/response-media/oracao.mp3')
            ->assertDontSee('wa.me')
            ->assertSee('painel-btn-disabled')
            ->assertSee('Link de mídia inválido');
    }

    public function test_missing_whatsapp_renders_disabled_button_and_hint(): void
    {
        $request = $this->makeRequest(null);

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->assertDontSee('wa.me')
            ->assertSee('painel-btn-disabled')
            ->assertSee('Solicitante não informou número de WhatsApp.');
    }

    public function test_click_sets_whatsapp_sent_and_logs_info(): void
    {
        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return $message === 'WhatsApp aberto'
                    && $context['request_id'] === 1
                    && $context['phone'] === '5511912345678';
            });

        $request = $this->makeRequest('5511912345678');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->call('markWhatsappOpened')
            ->assertSet('whatsappSent', true);
    }

    public function test_after_open_button_is_disabled_with_sent_label(): void
    {
        $request = $this->makeRequest('5511912345678');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->call('markWhatsappOpened')
            ->assertSee('WhatsApp Enviado')
            ->assertSee('painel-btn-disabled')
            ->assertDontSee('Enviar WhatsApp"');
    }
}
