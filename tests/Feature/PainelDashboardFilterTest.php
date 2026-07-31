<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Livewire\Livewire;
use Tests\TestCase;

class PainelDashboardFilterTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function createRequest(array $overrides = []): PrayerRequest
    {
        return PrayerRequest::create(array_merge([
            'name' => 'Maria',
            'message' => Crypt::encryptString('Pray for my family'),
            'delivery' => 'person',
            'prayer_type' => 'person-prayer-audio',
            'email' => Crypt::encryptString('maria@example.com'),
            'has_answered' => false,
            'date_answered' => null,
        ], $overrides));
    }

    public function test_defaults_to_pending_filter(): void
    {
        $this->createRequest();

        $component = Livewire::test('painel::painel');

        $component->assertSet('filter', 'pending')
            ->assertCount('requests', 1);
    }

    public function test_pending_filter_excludes_answered_requests(): void
    {
        $this->createRequest();
        $this->createRequest([
            'name' => 'João',
            'message' => Crypt::encryptString('Pray for health'),
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);

        $component = Livewire::test('painel::painel');

        $component->assertCount('requests', 1)
            ->assertSee('Maria')
            ->assertDontSee('João');
    }

    public function test_answered_filter_shows_only_answered_requests(): void
    {
        $this->createRequest();
        $answered = $this->createRequest([
            'name' => 'João',
            'message' => Crypt::encryptString('Pray for health'),
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);

        $component = Livewire::test('painel::painel')
            ->call('setFilter', 'answered');

        $component->assertSet('filter', 'answered')
            ->assertCount('requests', 1)
            ->assertSee('João')
            ->assertDontSee('Maria')
            ->assertSee('Respondido em');
    }

    public function test_answered_filter_shows_date_answered(): void
    {
        $answered = $this->createRequest([
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);

        Livewire::test('painel::painel')
            ->call('setFilter', 'answered')
            ->assertSet('requests.0.id', $answered->id)
            ->assertSet('requests.0.date_answered', $answered->date_answered);
    }

    public function test_answered_requests_are_ordered_by_date_answered_desc(): void
    {
        $older = $this->createRequest([
            'name' => 'Old',
            'message' => Crypt::encryptString('Older prayer'),
            'has_answered' => true,
            'date_answered' => now()->subDays(10),
        ]);
        $newer = $this->createRequest([
            'name' => 'New',
            'message' => Crypt::encryptString('Newer prayer'),
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);

        $component = Livewire::test('painel::painel')
            ->call('setFilter', 'answered');

        $component->assertSet('requests.0.id', $newer->id)
            ->assertSet('requests.1.id', $older->id);
    }

    public function test_switching_back_to_pending_restores_pending_list(): void
    {
        $pending = $this->createRequest();
        $this->createRequest([
            'has_answered' => true,
            'date_answered' => now(),
        ]);

        $component = Livewire::test('painel::painel')
            ->call('setFilter', 'answered')
            ->call('setFilter', 'pending');

        $component->assertSet('filter', 'pending')
            ->assertCount('requests', 1)
            ->assertSet('requests.0.id', $pending->id);
    }

    public function test_answered_empty_state(): void
    {
        $this->createRequest();

        Livewire::test('painel::painel')
            ->call('setFilter', 'answered')
            ->assertSet('isEmpty', true)
            ->assertSee('Nenhum pedido respondido');
    }

    public function test_refresh_keeps_current_filter(): void
    {
        $this->createRequest([
            'has_answered' => true,
            'date_answered' => now(),
        ]);

        $component = Livewire::test('painel::painel')
            ->call('setFilter', 'answered')
            ->call('refresh');

        $component->assertSet('filter', 'answered')
            ->assertCount('requests', 1);
    }
}
