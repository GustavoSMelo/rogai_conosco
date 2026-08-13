<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use App\Services\SendPrayerResponseEmailService;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PainelResponderMediaToEmailTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_uploaded_file_is_attached_to_email_in_full_browser_flow(): void
    {
        $file = UploadedFile::fake()->createWithContent('oracao.mp3', str_repeat('ID3', 500));

        $request = PrayerRequest::create([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        $captured = null;

        $this->mock(SendPrayerResponseEmailService::class)
            ->shouldReceive('send')
            ->once()
            ->withArgs(function (
                string $to,
                string $name,
                string $prayerMessage,
                ?string $mediaUrl,
                ?string $mediaFilePath,
                ?string $mediaFileName,
            ) use (&$captured) {
                $captured = func_get_args();

                return true;
            });

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaFile', $file)
            ->call('sendEmail')
            ->assertSet('emailSent', true);

        $this->assertNotNull($captured, 'send() was not invoked');
        [, , , $mediaUrl, $mediaFilePath, $mediaFileName] = $captured;

        $this->assertNotNull($mediaUrl);
        $this->assertNotNull($mediaFilePath);
        $this->assertSame('oracao.mp3', $mediaFileName);
        $this->assertTrue(file_exists($mediaFilePath), "Attached file missing at {$mediaFilePath}");

        $realAction = new SendPrayerResponseEmailService;
        $email = $realAction->buildEmail(
            'maria@example.com',
            'Maria',
            'Pray for my family',
            $mediaUrl,
            $mediaFilePath,
            $mediaFileName,
        );

        $this->assertNotEmpty($email->getAttachments(), 'buildEmail produced no attachments');
        $this->assertCount(1, $email->getAttachments());
        $this->assertSame('oracao.mp3', $email->getAttachments()[0]->getFilename());

        Storage::disk('public')->deleteDirectory('response-media');
    }

    public function test_stale_media_path_is_re_stored_before_send(): void
    {
        $file = UploadedFile::fake()->createWithContent('oracao.mp3', str_repeat('ID3', 500));

        $request = PrayerRequest::create([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        $captured = null;

        $this->mock(SendPrayerResponseEmailService::class)
            ->shouldReceive('send')
            ->once()
            ->withArgs(function (
                string $to,
                string $name,
                string $prayerMessage,
                ?string $mediaUrl,
                ?string $mediaFilePath,
                ?string $mediaFileName,
            ) use (&$captured) {
                $captured = func_get_args();

                return true;
            });

        $component = Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->upload('mediaFile', [$file]);

        $storedPath = $component->get('mediaFilePath');
        $this->assertNotNull($storedPath);
        $this->assertTrue(file_exists($storedPath));

        unlink($storedPath);
        $this->assertFalse(file_exists($storedPath), 'stored file should be gone before send');

        $component->call('sendEmail')->assertSet('emailSent', true);

        [, , , $mediaUrl, $mediaFilePath, $mediaFileName] = $captured;

        $this->assertNotNull($mediaUrl);
        $this->assertNotNull($mediaFilePath);
        $this->assertTrue(file_exists($mediaFilePath), "File should be re-stored before send, missing at {$mediaFilePath}");
        $this->assertSame('oracao.mp3', $mediaFileName);

        Storage::disk('public')->deleteDirectory('response-media');
    }

    public function test_email_send_is_blocked_when_attachment_exceeds_7mb(): void
    {
        $file = UploadedFile::fake()->createWithContent('video.mp4', str_repeat('x', 7340033));

        $request = PrayerRequest::create([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-video',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        $this->mock(SendPrayerResponseEmailService::class)
            ->shouldNotReceive('send');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->set('mediaFile', $file)
            ->call('sendEmail')
            ->assertSet('emailSent', false)
            ->assertSet('emailError', 'Arquivo muito grande para envio por e-mail (máximo 7 MB). Use WhatsApp ou um link de mídia.');

        Storage::disk('public')->deleteDirectory('response-media');
    }
}
