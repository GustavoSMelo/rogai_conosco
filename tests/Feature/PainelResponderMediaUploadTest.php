<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PainelResponderMediaUploadTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function createRequest(): PrayerRequest
    {
        return PrayerRequest::create([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);
    }

    public function test_uploaded_file_is_stored_and_path_available(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->createWithContent('oracao.mp3', 'fake-mp3-content');

        $component = Livewire::test('painel::painel-responder', ['prayerRequest' => $this->createRequest()])
            ->set('mediaFile', $file)
            ->assertSet('mediaFileName', 'oracao.mp3')
            ->assertHasNoErrors();

        $path = $component->get('mediaFilePath');
        $this->assertNotNull($path);

        $url = $component->get('mediaFileUrl');
        $this->assertNotNull($url);
        $this->assertStringContainsString('/response-media/', $url);

        Storage::disk('public')->assertExists($this->relativePathFromUrl($url));
    }

    public function test_remove_media_clears_file_references(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->createWithContent('oracao.mp3', 'fake-mp3-content');

        Livewire::test('painel::painel-responder', ['prayerRequest' => $this->createRequest()])
            ->set('mediaFile', $file)
            ->call('removeMedia')
            ->assertSet('mediaFilePath', null)
            ->assertSet('mediaFileUrl', null)
            ->assertSet('mediaFileName', null)
            ->assertSet('mediaUrl', '');
    }

    public function test_rejects_file_larger_than_50mb(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('large.mp3', 61440);

        Livewire::test('painel::painel-responder', ['prayerRequest' => $this->createRequest()])
            ->set('mediaFile', $file)
            ->assertHasErrors(['mediaFile' => 'The mediaFile field must not be greater than 51200 kilobytes.']);
    }

    public function test_accepts_file_up_to_50mb(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('oracao.mp3', 46080);

        Livewire::test('painel::painel-responder', ['prayerRequest' => $this->createRequest()])
            ->set('mediaFile', $file)
            ->assertHasNoErrors();
    }

    public function test_rejects_non_mp3_mp4_file(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('oracao.txt', 100);

        Livewire::test('painel::painel-responder', ['prayerRequest' => $this->createRequest()])
            ->set('mediaFile', $file)
            ->assertHasErrors(['mediaFile' => 'mimes']);
    }

    private function relativePathFromUrl(string $url): string
    {
        return 'response-media/' . basename(parse_url($url, PHP_URL_PATH));
    }
}
