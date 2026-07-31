<?php

namespace Tests\Unit;

use App\Services\WhatsAppDeepLinkService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class WhatsAppDeepLinkServiceTest extends TestCase
{
    private WhatsAppDeepLinkService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new WhatsAppDeepLinkService;
    }

    protected function tearDown(): void
    {
        Date::setTestNow(null);

        parent::tearDown();
    }

    private function messageFrom(string $url): string
    {
        $text = urldecode(parse_url($url, PHP_URL_QUERY) ?: '');

        return str_replace('text=', '', $text);
    }

    public function test_returns_null_when_phone_is_null(): void
    {
        $this->assertNull(
            $this->service->build(null, 'Maria', 'Pray for my family', null),
        );
    }

    public function test_returns_null_when_phone_has_no_digits(): void
    {
        $this->assertNull(
            $this->service->build('(sem número)', 'Maria', 'Pray', null),
        );
    }

    public function test_strips_non_digit_characters_from_phone(): void
    {
        $url = $this->service->build(
            '+55 (11) 91234-5678',
            'Maria',
            'Pray for my family',
            null,
        );

        $this->assertStringStartsWith('https://wa.me/5511912345678?', $url);
    }

    public function test_builds_url_with_urlencoded_message_and_media_link(): void
    {
        Date::setTestNow(Carbon::parse('2026-07-31 08:00:00'));

        $url = $this->service->build(
            '5511912345678',
            'Maria',
            'Pray for my family',
            'https://example.com/audio.mp3',
        );

        $this->assertStringStartsWith('https://wa.me/5511912345678?text=', $url);

        $text = $this->messageFrom($url);

        $this->assertStringContainsString('Bom dia, Maria.', $text);
        $this->assertStringContainsString('"Pray for my family"', $text);
        $this->assertStringContainsString(
            'Ouvir mensagem: https://example.com/audio.mp3',
            $text,
        );
    }

    public function test_message_has_no_media_line_without_media_url(): void
    {
        Date::setTestNow(Carbon::parse('2026-07-31 14:00:00'));

        $url = $this->service->build(
            '5511912345678',
            'João',
            'Pray for health',
            null,
        );

        $text = $this->messageFrom($url);

        $this->assertStringNotContainsString('Ouvir mensagem', $text);
        $this->assertStringContainsString('Boa tarde, João.', $text);
        $this->assertStringContainsString('"Pray for health"', $text);
    }

    public function test_makes_relative_storage_url_absolute(): void
    {
        Date::setTestNow(Carbon::parse('2026-07-31 08:00:00'));

        $url = $this->service->build(
            '5511912345678',
            'Maria',
            'Pray',
            '/storage/response-media/oracao.mp3',
        );

        $text = $this->messageFrom($url);

        $this->assertStringContainsString('Ouvir mensagem: '.url('/storage/response-media/oracao.mp3'), $text);
        $this->assertStringNotContainsString('Ouvir mensagem: /storage/', $text);
    }

    public function test_uses_anonymous_name_when_name_is_empty(): void
    {
        Date::setTestNow(Carbon::parse('2026-07-31 20:00:00'));

        $url = $this->service->build(
            '5511912345678',
            '',
            'Pray',
            null,
        );

        $text = $this->messageFrom($url);

        $this->assertStringContainsString('Boa noite, Anônimo.', $text);
    }

    public function test_greeting_depends_on_time_of_day(): void
    {
        $cases = [
            ['2026-07-31 04:59:00', 'Boa noite'],
            ['2026-07-31 05:00:00', 'Bom dia'],
            ['2026-07-31 11:59:00', 'Bom dia'],
            ['2026-07-31 12:00:00', 'Boa tarde'],
            ['2026-07-31 17:59:00', 'Boa tarde'],
            ['2026-07-31 18:00:00', 'Boa noite'],
            ['2026-07-31 23:59:00', 'Boa noite'],
        ];

        foreach ($cases as [$now, $greeting]) {
            Date::setTestNow(Carbon::parse($now));

            $url = $this->service->build(
                '5511912345678',
                'Maria',
                'Pray',
                null,
            );

            $this->assertStringContainsString($greeting.', Maria.', $this->messageFrom($url), "Failed for {$now}");
        }
    }
}
