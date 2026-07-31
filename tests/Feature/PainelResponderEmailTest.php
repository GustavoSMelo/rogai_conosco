<?php

namespace Tests\Feature;

use App\Actions\SendPrayerResponseEmail;
use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Tests\TestCase;

class PainelResponderEmailTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_send_email_success(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'oracao');
        file_put_contents($path, 'fake-audio-content');

        try {
            $action = $this->mock(SendPrayerResponseEmail::class);
            $action->shouldReceive('send')
                ->once()
                ->withArgs(fn (string $to, string $name, string $prayerMessage, ?string $mediaUrl, ?string $mediaFilePath, ?string $mediaFileName) =>
                    $to === 'maria@example.com'
                    && $name === 'Maria'
                    && $prayerMessage === 'Pray for my family'
                    && $mediaUrl === 'https://example.com/audio.mp3'
                    && $mediaFilePath === $path
                    && $mediaFileName === 'oracao.mp3');

            $request = PrayerRequest::create([
                'name' => 'Maria',
                'message' => Crypt::encryptString('Pray for my family'),
                'delivery' => 'person',
                'prayer_type' => 'person-prayer-audio',
                'email' => Crypt::encryptString('maria@example.com'),
                'has_answered' => false,
                'date_answered' => null,
            ]);

            Livewire::test('app::painel-responder', ['prayerRequest' => $request])
                ->set('mediaUrl', 'https://example.com/audio.mp3')
                ->set('mediaFilePath', $path)
                ->set('mediaFileName', 'oracao.mp3')
                ->call('sendEmail')
                ->assertSet('emailSent', true)
                ->assertSet('emailSending', false)
                ->assertSet('emailError', null);
        } finally {
            unlink($path);
        }
    }

    public function test_send_email_without_media_url(): void
    {
        $action = $this->mock(SendPrayerResponseEmail::class);
        $action->shouldReceive('send')
            ->once()
            ->withArgs(fn (string $to, string $name, string $prayerMessage, ?string $mediaUrl) =>
                $to === 'joao@example.com'
                && $mediaUrl === null);

        $request = PrayerRequest::create([
            'name' => 'João',
            'message' => Crypt::encryptString('Pray for health'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('joao@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail')
            ->assertSet('emailSent', true);
    }

    public function test_send_email_missing_email_shows_error(): void
    {
        $this->mock(SendPrayerResponseEmail::class)
            ->shouldNotReceive('send');

        $request = PrayerRequest::create([
            'name' => 'No Email',
            'message' => Crypt::encryptString('Test'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => null,
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail')
            ->assertSet('emailSent', false)
            ->assertSet('emailError', 'Email do solicitante não disponível');
    }

    public function test_send_email_failure_shows_error(): void
    {
        $action = $this->mock(SendPrayerResponseEmail::class);
        $action->shouldReceive('send')
            ->once()
            ->andThrow(new \Exception('Connection timed out'));

        $request = PrayerRequest::create([
            'name' => 'Fail Test',
            'message' => Crypt::encryptString('Test failure'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('fail@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail')
            ->assertSet('emailSent', false)
            ->assertSet('emailSending', false)
            ->assertSet('emailError', 'Falha ao enviar email. Tente novamente.');
    }

    public function test_send_email_logs_info_on_success(): void
    {
        $this->mock(SendPrayerResponseEmail::class)
            ->shouldReceive('send')
            ->once();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(fn ($message) => $message === 'Email enviado');

        $request = PrayerRequest::create([
            'name' => 'Log Test',
            'message' => Crypt::encryptString('Log test'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('log@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail');
    }

    public function test_send_email_logs_warning_on_missing_email(): void
    {
        Log::shouldReceive('warning')
            ->once()
            ->withArgs(fn ($message) => $message === 'Email não disponível');

        $request = PrayerRequest::create([
            'name' => 'Missing',
            'message' => Crypt::encryptString('No email'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => null,
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail');
    }

    public function test_send_email_logs_error_on_failure(): void
    {
        $this->mock(SendPrayerResponseEmail::class)
            ->shouldReceive('send')
            ->once()
            ->andThrow(new \Exception('SMTP error'));

        Log::shouldReceive('error')
            ->once()
            ->withArgs(fn ($message) => $message === 'Falha ao enviar email');

        $request = PrayerRequest::create([
            'name' => 'Fail Log',
            'message' => Crypt::encryptString('Fail log'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('faillog@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail');
    }

    public function test_send_email_with_anonymous_name(): void
    {
        $action = $this->mock(SendPrayerResponseEmail::class);
        $action->shouldReceive('send')
            ->once()
            ->withArgs(fn (string $to, string $name) => $name === 'Anônimo');

        $request = PrayerRequest::create([
            'name' => null,
            'message' => Crypt::encryptString('Anonymous prayer'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('anon@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('app::painel-responder', ['prayerRequest' => $request])
            ->call('sendEmail')
            ->assertSet('emailSent', true);
    }
}
