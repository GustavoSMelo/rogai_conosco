<?php

namespace Tests\Feature;

use App\Models\PrayerRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Livewire\Livewire;
use Tests\TestCase;

class PainelRequestDeleteTest extends TestCase
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

    public function test_trash_button_shown_on_pending_card(): void
    {
        $request = $this->createRequest();

        Livewire::test('painel::painel')
            ->assertSee('painel-btn-trash')
            ->assertSee('Responder');
    }

    public function test_trash_button_hidden_on_answered_card(): void
    {
        $this->createRequest([
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);

        Livewire::test('painel::painel')
            ->call('setFilter', 'answered')
            ->assertSee('Respondido em')
            ->assertDontSee('painel-btn-trash');
    }

    public function test_open_delete_modal_shows_reason_input(): void
    {
        $request = $this->createRequest();

        Livewire::test('painel::painel')
            ->call('openDeleteModal', $request->id)
            ->assertSet('showDeleteModal', true)
            ->assertSet('deleteRequestId', $request->id);
    }

    public function test_confirm_delete_with_reason_soft_deletes_request(): void
    {
        $request = $this->createRequest();

        Livewire::test('painel::painel')
            ->call('openDeleteModal', $request->id)
            ->set('deleteReason', 'Sem contato para envio')
            ->call('deleteRequest')
            ->assertSet('showDeleteModal', false)
            ->assertSet('isEmpty', true);

        $request->refresh();

        $this->assertNotNull($request->deleted_at);
        $this->assertEquals('Sem contato para envio', $request->delete_reason);
    }

    public function test_confirm_delete_without_reason_shows_error_and_keeps_request(): void
    {
        $request = $this->createRequest();

        Livewire::test('painel::painel')
            ->call('openDeleteModal', $request->id)
            ->set('deleteReason', '')
            ->call('deleteRequest')
            ->assertHasErrors(['deleteReason' => 'required'])
            ->assertSet('showDeleteModal', true);

        $this->assertNull($request->fresh()->deleted_at);
    }

    public function test_cancel_delete_closes_dialog_without_modifying(): void
    {
        $request = $this->createRequest();

        Livewire::test('painel::painel')
            ->call('openDeleteModal', $request->id)
            ->set('deleteReason', 'Motivo digitado')
            ->call('cancelDelete')
            ->assertSet('showDeleteModal', false)
            ->assertSet('deleteRequestId', 0);

        $this->assertNull($request->fresh()->deleted_at);
    }

    public function test_painel_excludes_soft_deleted_requests_from_lists_and_counts(): void
    {
        $kept = $this->createRequest();
        $deleted = $this->createRequest(['name' => 'Ana']);
        $deleted->delete();

        $answered = $this->createRequest([
            'name' => 'João',
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);
        $answeredDeleted = $this->createRequest([
            'name' => 'Pedro',
            'has_answered' => true,
            'date_answered' => now()->subDay(),
        ]);
        $answeredDeleted->delete();

        $component = Livewire::test('painel::painel');

        $component->assertSet('pendingCount', 1)
            ->assertSet('answeredCount', 1)
            ->assertSet('prayerRequestCount', 2)
            ->assertSet('requests.0.id', $kept->id)
            ->assertDontSee('Ana');

        $component->call('setFilter', 'answered')
            ->assertCount('requests', 1)
            ->assertSet('requests.0.id', $answered->id)
            ->assertDontSee('Pedro');
    }
}
