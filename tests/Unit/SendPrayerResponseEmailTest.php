<?php

namespace Tests\Unit;

use App\Services\SendPrayerResponseEmailService;
use Tests\TestCase;

class SendPrayerResponseEmailTest extends TestCase
{
    private SendPrayerResponseEmailService $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = new SendPrayerResponseEmailService();
    }

    public function test_builds_email_with_media_url(): void
    {
        $email = $this->action->buildEmail(
            to: 'maria@example.com',
            name: 'Maria',
            prayerMessage: 'Pray for my family',
            mediaUrl: 'https://example.com/audio.mp3',
        );

        $this->assertSame(['maria@example.com'], array_map(
            fn ($address) => $address->getAddress(),
            $email->getTo()
        ));
        $this->assertSame('Rogai Conosco — Sua Oração Foi Respondida', $email->getSubject());
        $this->assertStringContainsString('Olá, Maria', $email->getTextBody());
        $this->assertStringContainsString('Pray for my family', $email->getTextBody());
        $this->assertStringContainsString('https://example.com/audio.mp3', $email->getTextBody());
        $this->assertStringContainsString('https://example.com/audio.mp3', $email->getHtmlBody());
        $this->assertStringContainsString('<a href="https://example.com/audio.mp3"', $email->getHtmlBody());
    }

    public function test_builds_email_without_media_url(): void
    {
        $email = $this->action->buildEmail(
            to: 'joao@example.com',
            name: 'João',
            prayerMessage: 'Pray for health',
        );

        $this->assertSame('Rogai Conosco — Sua Oração Foi Respondida', $email->getSubject());
        $this->assertStringContainsString('Olá, João', $email->getTextBody());
        $this->assertStringNotContainsString('Ouvir mensagem', $email->getTextBody());
        $this->assertStringNotContainsString('Ouvir mensagem', $email->getHtmlBody());
    }

    public function test_escapes_special_characters(): void
    {
        $email = $this->action->buildEmail(
            to: 'anon@example.com',
            name: 'Anônimo',
            prayerMessage: 'Pray <script>alert("x")</script> for me',
        );

        $this->assertStringNotContainsString('<script>', $email->getHtmlBody());
        $this->assertStringContainsString('&lt;script&gt;', $email->getHtmlBody());
    }

    public function test_attaches_media_file_when_path_provided(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'oracao');
        file_put_contents($path, 'fake-audio-content');

        try {
            $email = $this->action->buildEmail(
                to: 'maria@example.com',
                name: 'Maria',
                prayerMessage: 'Pray for my family',
                mediaUrl: 'https://example.com/audio.mp3',
                mediaFilePath: $path,
                mediaFileName: 'oracao.mp3',
            );

            $attachments = $email->getAttachments();
            $this->assertCount(1, $attachments);
            $this->assertSame('oracao.mp3', $attachments[0]->getFilename());
            $this->assertSame('fake-audio-content', $attachments[0]->getBody());
        } finally {
            unlink($path);
        }
    }

    public function test_does_not_attach_when_path_missing(): void
    {
        $email = $this->action->buildEmail(
            to: 'maria@example.com',
            name: 'Maria',
            prayerMessage: 'Pray for my family',
        );

        $this->assertCount(0, $email->getAttachments());
    }

    public function test_throws_when_path_does_not_exist(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('not found');

        $this->action->buildEmail(
            to: 'maria@example.com',
            name: 'Maria',
            prayerMessage: 'Pray for my family',
            mediaFilePath: '/nonexistent/path/oracao.mp3',
            mediaFileName: 'oracao.mp3',
        );
    }

    public function test_relative_media_url_is_made_absolute(): void
    {
        $email = $this->action->buildEmail(
            to: 'maria@example.com',
            name: 'Maria',
            prayerMessage: 'Pray for my family',
            mediaUrl: '/storage/response-media/oracao.mp3',
        );

        $this->assertStringContainsString(url('/storage/response-media/oracao.mp3'), $email->getTextBody());
        $this->assertStringContainsString(url('/storage/response-media/oracao.mp3'), $email->getHtmlBody());
        $this->assertStringNotContainsString('href="/storage/', $email->getHtmlBody());
    }

    public function test_absolute_media_url_is_kept_as_is(): void
    {
        $email = $this->action->buildEmail(
            to: 'maria@example.com',
            name: 'Maria',
            prayerMessage: 'Pray for my family',
            mediaUrl: 'https://exemplo.com/diag.mp3',
        );

        $this->assertStringContainsString('https://exemplo.com/diag.mp3', $email->getTextBody());
        $this->assertStringContainsString('https://exemplo.com/diag.mp3', $email->getHtmlBody());
    }
}
