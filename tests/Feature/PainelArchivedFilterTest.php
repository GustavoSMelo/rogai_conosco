<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Livewire\Livewire;
use Tests\TestCase;

class PainelArchivedFilterTest extends TestCase
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

    private function archiveRequest(PrayerRequest $request, string $reason = 'Sem contato', ?string $deletedAt = null): PrayerRequest
    {
        $request->update(['delete_reason' => $reason]);
        $request->delete();

        if ($deletedAt) {
            $request->forceFill(['deleted_at' => $deletedAt])->save();
        }

        return $request;
    }

    public function test_archived_tab_shown_with_count(): void
    {
        $archived = $this->archiveRequest($this->createRequest());
        $this->createRequest();

        Livewire::test('painel::painel')
            ->assertSee('Arquivados')
            ->assertSet('archivedCount', 1);
    }

    public function test_archived_filter_lists_only_soft_deleted_ordered_by_deleted_at_desc(): void
    {
        $older = $this->archiveRequest($this->createRequest(['name' => 'Antiga']), 'Motivo A', '2026-08-01 10:00:00');
        $newer = $this->archiveRequest($this->createRequest(['name' => 'Nova']), 'Motivo B', '2026-08-05 10:00:00');
        $this->createRequest(['name' => 'Pedro']);
        $this->createRequest(['name' => 'Paula', 'has_answered' => true, 'date_answered' => now()]);

        $component = Livewire::test('painel::painel')
            ->call('setFilter', 'archived');

        $component->assertSet('filter', 'archived')
            ->assertCount('requests', 2)
            ->assertSet('requests.0.id', $newer->id)
            ->assertSet('requests.1.id', $older->id)
            ->assertDontSee('Pedro')
            ->assertDontSee('Paula');
    }

    public function test_archived_card_shows_deletion_details_and_hides_action_buttons(): void
    {
        $archived = $this->archiveRequest($this->createRequest(), 'Sem contato válido');

        Livewire::test('painel::painel')
            ->call('setFilter', 'archived')
            ->assertSee('Arquivado em')
            ->assertSee('Sem contato válido')
            ->assertSee('Desarquivar')
            ->assertDontSee('painel-btn-respond')
            ->assertDontSee('painel-btn-trash');
    }

    public function test_unarchive_clears_deleted_at_and_delete_reason_and_reloads_list(): void
    {
        $archived = $this->archiveRequest($this->createRequest());

        Livewire::test('painel::painel')
            ->call('setFilter', 'archived')
            ->call('unarchiveRequest', $archived->id)
            ->assertCount('requests', 0)
            ->assertSet('archivedCount', 0);

        $archived->refresh();

        $this->assertNull($archived->deleted_at);
        $this->assertNull($archived->delete_reason);
    }

    public function test_unarchived_request_returns_to_pending_or_answered_list(): void
    {
        $pending = $this->archiveRequest($this->createRequest(['name' => 'Volta pendente']));
        $answered = $this->archiveRequest(
            $this->createRequest(['name' => 'Volta respondida', 'has_answered' => true, 'date_answered' => now()->subDay()])
        );

        $component = Livewire::test('painel::painel')
            ->call('setFilter', 'archived')
            ->call('unarchiveRequest', $pending->id)
            ->call('unarchiveRequest', $answered->id)
            ->call('setFilter', 'pending');

        $component->assertCount('requests', 1)
            ->assertSee('Volta pendente');

        $component->call('setFilter', 'answered')
            ->assertCount('requests', 1)
            ->assertSee('Volta respondida');
    }

    public function test_pending_answered_and_total_counts_exclude_archived_requests(): void
    {
        $this->createRequest(['name' => 'Pendente 1']);
        $this->createRequest(['name' => 'Pendente 2']);
        $this->createRequest(['name' => 'Respondida', 'has_answered' => true, 'date_answered' => now()]);
        $this->archiveRequest($this->createRequest(['name' => 'Arquivada 1']));
        $this->archiveRequest($this->createRequest(['name' => 'Arquivada 2']));

        Livewire::test('painel::painel')
            ->assertSet('pendingCount', 2)
            ->assertSet('answeredCount', 1)
            ->assertSet('archivedCount', 2)
            ->assertSet('prayerRequestCount', 3);
    }
}
