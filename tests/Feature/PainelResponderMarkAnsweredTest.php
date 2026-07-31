<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Livewire\Livewire;
use Tests\TestCase;

class PainelResponderMarkAnsweredTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_mark_as_answered_sets_flag_and_date(): void
    {
        $request = PrayerRequest::create([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ]);

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->call('markAsAnswered');

        $this->assertDatabaseHas('prayer_requests', [
            'id' => $request->id,
            'has_answered' => true,
        ]);

        $this->assertNotNull($request->fresh()->date_answered);
        $this->assertSame(
            now()->toDateString(),
            $request->fresh()->date_answered->toDateString(),
        );
    }

    public function test_mark_as_answered_is_idempotent(): void
    {
        $request = PrayerRequest::create([
            'name' => 'João',
            'message' => Crypt::encryptString('Pray for health'),
            'delivery' => 'instant',
            'prayer_type' => 'instant',
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);

        Livewire::test('painel::painel-responder', ['prayerRequest' => $request])
            ->call('markAsAnswered');

        $this->assertSame(
            $request->date_answered->toDateString(),
            $request->fresh()->date_answered->toDateString(),
        );
    }
}
