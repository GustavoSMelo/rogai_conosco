<?php

use App\Models\PrayerRequest;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Painel')] class extends Component {
    public array $requests = [];
    public int $prayerRequestCount = 0;
    public int $pendingCount = 0;
    public int $answeredCount = 0;
    public int $archivedCount = 0;
    public string $filter = 'pending';
    public bool $isEmpty = true;
    public bool $showDeleteModal = false;
    public int $deleteRequestId = 0;
    public string $deleteReason = '';

    public function mount(): void
    {
        $this->loadRequests();
    }

    public function refresh(): void
    {
        $this->loadRequests();
    }

    public function setFilter(string $filter): void
    {
        $this->filter = match ($filter) {
            'answered' => 'answered',
            'archived' => 'archived',
            default => 'pending',
        };
        $this->loadRequests();
    }

    public function logout(): void
    {
        session()->forget('dashboard_authenticated');
        $this->redirect(route('painel.login'));
    }

    public function openDeleteModal(int $id): void
    {
        $request = PrayerRequest::where('id', $id)
            ->where('has_answered', false)
            ->where('delivery', 'person')
            ->first();

        if (!$request) {
            return;
        }

        $this->deleteRequestId = $id;
        $this->deleteReason = '';
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deleteRequestId = 0;
        $this->deleteReason = '';
    }

    public function deleteRequest(): void
    {
        $this->validate([
            'deleteReason' => ['required', 'string', 'max:2000'],
        ]);

        $request = PrayerRequest::where('id', $this->deleteRequestId)
            ->where('has_answered', false)
            ->where('delivery', 'person')
            ->first();

        if (!$request) {
            $this->cancelDelete();

            return;
        }

        $request->update(['delete_reason' => $this->deleteReason]);
        $request->delete();

        $this->cancelDelete();
        $this->loadRequests();
    }

    public function unarchiveRequest(int $id): void
    {
        $request = PrayerRequest::onlyTrashed()
            ->where('id', $id)
            ->where('delivery', 'person')
            ->first();

        if (!$request) {
            return;
        }

        $request->update(['delete_reason' => null]);
        $request->restore();

        $this->loadRequests();
    }

    private function loadRequests(): void
    {
        $this->pendingCount = PrayerRequest::where('has_answered', false)
            ->where('delivery', 'person')
            ->count();

        $this->answeredCount = PrayerRequest::where('has_answered', true)
            ->where('delivery', 'person')
            ->count();

        $this->archivedCount = PrayerRequest::onlyTrashed()
            ->where('delivery', 'person')
            ->count();

        $isAnsweredFilter = $this->filter === 'answered';
        $isArchivedFilter = $this->filter === 'archived';

        if ($isArchivedFilter) {
            $query = PrayerRequest::onlyTrashed()
                ->where('delivery', 'person')
                ->orderBy('deleted_at', 'desc');
        } else {
            $query = PrayerRequest::where('has_answered', $isAnsweredFilter)
                ->where('delivery', 'person');

            if ($isAnsweredFilter) {
                $query->orderBy('date_answered', 'desc');
            } else {
                $query->orderBy('created_at', 'asc');
            }
        }

        $requests = $query->get();

        $this->prayerRequestCount = PrayerRequest::query()->count();

        $this->requests = $requests->map(function (PrayerRequest $req) use ($isAnsweredFilter, $isArchivedFilter) {
            $message = $req->message;
            try {
                $message = Crypt::decryptString($req->message);
            } catch (\Exception) {
            }

            $email = $req->email;
            if ($email) {
                try {
                    $email = Crypt::decryptString($email);
                } catch (\Exception) {
                }
            }

            $whatsapp = $req->whatsapp;
            if ($whatsapp) {
                try {
                    $whatsapp = Crypt::decryptString($whatsapp);
                } catch (\Exception) {
                }
            }

            $isOverdue = !$isArchivedFilter && !$isAnsweredFilter && $req->created_at->diffInHours(now()) > 48;

            return [
                'id' => $req->id,
                'name' => $req->name ?? 'Anônimo',
                'message' => $message,
                'email' => $email,
                'whatsapp' => $whatsapp,
                'delivery' => $req->delivery,
                'prayer_type' => $req->prayer_type,
                'religion' => $req->religion,
                'created_at' => $req->created_at,
                'date_answered' => $req->date_answered,
                'deleted_at' => $req->deleted_at,
                'delete_reason' => $req->delete_reason,
                'elapsed' => $isAnsweredFilter && $req->date_answered
                    ? 'Respondido em ' . $req->date_answered->format('d/m/Y')
                    : $req->created_at->diffForHumans(parts: 2),
                'is_overdue' => $isOverdue,
            ];
        })->toArray();

        $this->isEmpty = empty($this->requests);
    }

    public function render()
    {
        return $this->view();
    }

    public function deliveryLabel(string $type): string
    {
        return match ($type) {
            'ai' => 'IA',
            'instant' => 'Instantânea',
            'person' => 'Pessoa',
            default => $type,
        };
    }

    public function prayerTypeLabel(string $type): string
    {
        return match ($type) {
            'ai' => 'Por IA',
            'instant' => 'Instantânea',
            'person-prayer-audio' => 'Oração (áudio)',
            'person-prayer-video' => 'Oração (vídeo)',
            'person-bible-audio' => 'Palavra (áudio)',
            'person-bible-video' => 'Palavra (vídeo)',
            'person-bible-prayer-audio' => 'Oração + Palavra (áudio)',
            'person-bible-prayer-video' => 'Oração + Palavra (vídeo)',
            default => $type,
        };
    }

    public function religionLabel(?string $religion): string
    {
        return match ($religion) {
            'catholic' => 'Católica',
            'orthodox' => 'Ortodoxa',
            'protestant' => 'Protestante',
            'other' => 'Outra',
            default => $religion ?? '—',
        };
    }
};

?>

<div class="painel-page-body">
    <div class="painel-container">

    {{-- Header --}}
    <div class="painel-header">
        <div class="painel-header-inner">
            <a href="{{ route('welcome') }}" class="painel-brand-link">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="painel-brand-logo">
                <span class="painel-brand-text">Rogai Conosco</span>
            </a>
            <span class="painel-crumb-sep">/</span>
            <span class="painel-crumb-current">Painel</span>
        </div>
        <div class="painel-header-actions">
            <button
                type="button"
                wire:click="refresh"
                class="painel-btn-ghost"
                aria-label="Atualizar pedidos"
            >
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="sm:hidden" aria-hidden="true">
                    <path d="M21 12a9 9 0 1 1-2.64-6.36"/>
                    <path d="M21 3v6h-6"/>
                </svg>
                <span class="hidden sm:inline">Atualizar</span>
            </button>
            <button
                type="button"
                wire:click="logout"
                class="painel-btn-logout"
                aria-label="Sair do painel"
            >
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="sm:hidden" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <span class="hidden sm:inline">Sair</span>
            </button>
        </div>
    </div>

    {{-- Filter --}}
    <div class="painel-filter-row">
        <button
            type="button"
            wire:click="setFilter('pending')"
            class="painel-filter-btn {{ $filter === 'pending' ? 'painel-filter-btn-active' : 'painel-filter-btn-idle' }}"
        >
            Pendentes ({{ $pendingCount }})
        </button>
        <button
            type="button"
            wire:click="setFilter('answered')"
            class="painel-filter-btn {{ $filter === 'answered' ? 'painel-filter-btn-active' : 'painel-filter-btn-idle' }}"
        >
            Respondidos ({{ $answeredCount }})
        </button>
        <button
            type="button"
            wire:click="setFilter('archived')"
            class="painel-filter-btn {{ $filter === 'archived' ? 'painel-filter-btn-active' : 'painel-filter-btn-idle' }}"
        >
            Arquivados ({{ $archivedCount }})
        </button>
    </div>

    {{-- Empty state --}}
    @if ($isEmpty)
        <div class="painel-empty-state">
            <div class="painel-empty-card">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="painel-empty-icon" aria-hidden="true">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
                @if ($filter === 'answered')
                    <h2 class="painel-empty-title">Nenhum pedido respondido</h2>
                    <p class="painel-empty-text">
                        Nenhum pedido de oração foi respondido até agora.
                    </p>
                @elseif ($filter === 'archived')
                    <h2 class="painel-empty-title">Nenhum pedido arquivado</h2>
                    <p class="painel-empty-text">
                        Nenhum pedido de oração foi arquivado até agora.
                    </p>
                @else
                    <h2 class="painel-empty-title">Nenhum pedido pendente</h2>
                    <p class="painel-empty-text">
                        Todos os pedidos de oração foram respondidos. Volte mais tarde para verificar novamente.
                    </p>
                @endif
            </div>
        </div>
    @endif

    {{-- Request cards --}}
    @if (!$isEmpty)
        <div class="painel-list">
            @foreach ($requests as $req)
                <div class="painel-card {{ $filter === 'archived' ? 'painel-card-archived' : '' }}">
                    <div class="painel-card-top">
                        <div class="painel-card-main">
                            <div class="painel-card-title-row">
                                @if ($filter === 'archived')
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-archive-icon" aria-hidden="true">
                                        <rect x="2" y="3" width="20" height="5" rx="1"/>
                                        <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/>
                                        <path d="M10 12h4"/>
                                    </svg>
                                @elseif ($req['date_answered'])
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-check-icon" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="m8.5 12.5 2.5 2.5 4.5-5.5"/>
                                    </svg>
                                @elseif ($req['is_overdue'])
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c0392b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-overdue-icon" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                @else
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-clock-icon" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 6v6l4 2"/>
                                    </svg>
                                @endif
                                <h3 class="painel-card-title">
                                    @if ($req['name'] === 'Anônimo')
                                        <span class="painel-card-title-muted">{{ $req['name'] }}</span>
                                    @else
                                        {{ $req['name'] }}
                                    @endif
                                </h3>
                                @if ($filter === 'archived')
                                    <span class="painel-badge painel-badge-archived">Arquivado</span>
                                @else
                                    <span class="painel-badge {{ $req['is_overdue'] ? 'painel-badge-overdue' : ($req['date_answered'] ? 'painel-badge-answered' : 'painel-badge-pending') }}">
                                        {{ $req['elapsed'] }}
                                    </span>
                                @endif
                            </div>
                            <p class="painel-message">
                                {{ $req['message'] }}
                            </p>
                        </div>
                        <div class="painel-card-side">
                            <div class="painel-card-side-inner">
                                <span class="painel-type-tag">
                                    {{ $this->prayerTypeLabel($req['prayer_type']) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Contact details --}}
                    <div class="painel-meta">
                        @if ($req['whatsapp'])
                            <span>WhatsApp: {{ $req['whatsapp'] }}</span>
                        @endif
                        @if ($req['email'])
                            <span>Email: {{ $req['email'] }}</span>
                        @endif
                        @if ($req['religion'])
                            <span>Religião: {{ $this->religionLabel($req['religion']) }}</span>
                        @endif
                        <span>Entrega: {{ $this->deliveryLabel($req['delivery']) }}</span>
                    </div>

                    @if ($filter === 'archived' && $req['delete_reason'])
                        <div class="painel-archived-reason-box">
                            <span class="painel-archived-reason-label">Motivo do arquivamento</span>
                            <p class="painel-archived-reason">{{ $req['delete_reason'] }}</p>
                        </div>
                    @endif

                    <div class="painel-card-footer">
                        <div class="painel-date {{ $req['is_overdue'] ? 'painel-date-overdue' : '' }}">
                            {{ $req['created_at']->format('d/m/Y H:i') }}
                        </div>
                        @if ($filter === 'archived')
                            <div class="painel-archived-footer">
                                <span class="painel-date-archived">
                                    Arquivado em {{ $req['deleted_at']?->format('d/m/Y H:i') }}
                                </span>
                                <button
                                    type="button"
                                    wire:click="unarchiveRequest({{ $req['id'] }})"
                                    class="painel-btn-unarchive"
                                >
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2z"/>
                                        <path d="M4 13h6"/>
                                        <path d="m9 9-3 3 3 3"/>
                                        <path d="M9 12h11"/>
                                    </svg>
                                    Desarquivar
                                </button>
                            </div>
                        @elseif ($req['date_answered'])
                            <span class="painel-date-answered">
                                Respondido em {{ $req['date_answered']->format('d/m/Y') }}
                            </span>
                        @else
                            <div class="painel-card-actions">
                                <a href="{{ route('painel.responder', $req['id']) }}"
                                   class="painel-btn-respond">
                                    Responder
                                </a>
                                <button
                                    type="button"
                                    wire:click="openDeleteModal({{ $req['id'] }})"
                                    class="painel-btn-trash"
                                    aria-label="Não responder este pedido"
                                    title="Não responder este pedido"
                                >
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <p class="painel-footer-count">
            {{ count($requests) }} pedido(s) {{ $filter === 'answered' ? 'respondido(s)' : ($filter === 'archived' ? 'arquivado(s)' : 'pendente(s)') }}
        </p>
        <p class="painel-footer-count-alt">
            {{ $prayerRequestCount }} oracoes realizadas no total
        </p>
    @endif

    {{-- Delete reason modal --}}
    @if ($showDeleteModal)
        <div class="painel-modal-overlay" wire:click.self="cancelDelete">
            <div class="painel-modal" role="dialog" aria-modal="true" aria-labelledby="painel-delete-modal-title">
                <button
                    type="button"
                    wire:click="cancelDelete"
                    class="painel-modal-close"
                    aria-label="Fechar"
                >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
                <h3 id="painel-delete-modal-title" class="painel-modal-title">
                    Não responder este pedido
                </h3>
                <p class="painel-modal-subtitle">
                    Informe o motivo pelo qual este pedido não será respondido. O pedido ficará registrado como excluído.
                </p>
                <form wire:submit="deleteRequest" class="painel-modal-form">
                    <label for="painel-delete-reason" class="painel-form-label">
                        Motivo
                    </label>
                    <textarea
                        id="painel-delete-reason"
                        wire:model="deleteReason"
                        class="painel-form-input"
                        rows="4"
                        placeholder="Ex.: sem meio de contato válido..."
                    ></textarea>
                    @error('deleteReason')
                        <p class="painel-form-error">{{ $message }}</p>
                    @enderror
                    <div class="painel-modal-buttons">
                        <button type="button" wire:click="cancelDelete" class="painel-modal-cancel">
                            Cancelar
                        </button>
                        <button type="submit" class="painel-modal-confirm">
                            Confirmar exclusão
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @vite('resources/css/painel.css')
    </div>
</div>
