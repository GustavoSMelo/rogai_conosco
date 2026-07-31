<?php

use App\Models\PrayerRequest;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Painel')] class extends Component {
    public array $requests = [];
    public int $prayerRequestCount = 0;
    public int $pendingCount = 0;
    public int $answeredCount = 0;
    public string $filter = 'pending';
    public bool $isEmpty = true;

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
        $this->filter = $filter === 'answered' ? 'answered' : 'pending';
        $this->loadRequests();
    }

    public function logout(): void
    {
        session()->forget('dashboard_authenticated');
        $this->redirect(route('painel.login'));
    }

    private function loadRequests(): void
    {
        $this->pendingCount = PrayerRequest::where('has_answered', false)
            ->where('delivery', 'person')
            ->count();

        $this->answeredCount = PrayerRequest::where('has_answered', true)
            ->where('delivery', 'person')
            ->count();

        $isAnsweredFilter = $this->filter === 'answered';

        $query = PrayerRequest::where('has_answered', $isAnsweredFilter)
            ->where('delivery', 'person');

        if ($isAnsweredFilter) {
            $query->orderBy('date_answered', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        $requests = $query->get();

        $this->prayerRequestCount = PrayerRequest::query()->count();

        $this->requests = $requests->map(function (PrayerRequest $req) use ($isAnsweredFilter) {
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

            $isOverdue = !$isAnsweredFilter && $req->created_at->diffInHours(now()) > 48;

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
            >
                Atualizar
            </button>
            <button
                type="button"
                wire:click="logout"
                class="painel-btn-logout"
            >
                Sair
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
                <div class="painel-card">
                    <div class="painel-card-top">
                        <div class="painel-card-main">
                            <div class="painel-card-title-row">
                                @if ($req['is_overdue'])
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c0392b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-overdue-icon" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                @endif
                                <h3 class="painel-card-title">
                                    @if ($req['name'] === 'Anônimo')
                                        <span class="painel-card-title-muted">{{ $req['name'] }}</span>
                                    @else
                                        {{ $req['name'] }}
                                    @endif
                                </h3>
                                <span class="painel-badge {{ $req['is_overdue'] ? 'painel-badge-overdue' : ($req['date_answered'] ? 'painel-badge-answered' : 'painel-badge-pending') }}">
                                    {{ $req['elapsed'] }}
                                </span>
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

                    <div class="painel-card-footer">
                        <div class="painel-date {{ $req['is_overdue'] ? 'painel-date-overdue' : '' }}">
                            {{ $req['created_at']->format('d/m/Y H:i') }}
                        </div>
                        @if ($req['date_answered'])
                            <span class="painel-date-answered">
                                Respondido em {{ $req['date_answered']->format('d/m/Y') }}
                            </span>
                        @else
                            <a href="{{ route('painel.responder', $req['id']) }}"
                               class="painel-btn-respond">
                                Responder
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <p class="painel-footer-count">
            {{ count($requests) }} pedido(s) {{ $filter === 'answered' ? 'respondido(s)' : 'pendente(s)' }}
        </p>
        <p class="painel-footer-count-alt">
            {{ $prayerRequestCount }} oracoes realizadas no total
        </p>
    @endif

    @vite('resources/css/painel.css')
    </div>
</div>
