<?php

use App\Models\PrayerRequest;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Painel')] class extends Component {
    public array $requests = [];
    public bool $isEmpty = true;

    public function mount(): void
    {
        $this->loadRequests();
    }

    public function refresh(): void
    {
        $this->loadRequests();
    }

    public function logout(): void
    {
        session()->forget('dashboard_authenticated');
        $this->redirect(route('painel.login'));
    }

    private function loadRequests(): void
    {
        $pending = PrayerRequest::where('has_answered', false)
            ->where('delivery', 'person')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->requests = $pending->map(function (PrayerRequest $req) {
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

            $isOverdue = $req->created_at->diffInHours(now()) > 48;

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
                'elapsed' => $req->created_at->diffForHumans(parts: 2),
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
    <div class="mx-auto max-w-5xl px-6 py-10 sm:px-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-10">
        <div class="flex items-center gap-3">
            <a href="{{ route('welcome') }}" class="flex items-center gap-2 no-underline transition-opacity duration-150 hover:opacity-70">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="h-8 w-8 object-contain opacity-85">
                <span class="font-serif text-lg text-brand-primary font-bold">Rogai Conosco</span>
            </a>
            <span class="text-brand-muted/40 text-sm">/</span>
            <span class="font-serif text-lg text-brand-ink">Painel</span>
        </div>
        <div class="flex items-center gap-3">
            <button
                type="button"
                wire:click="refresh"
                class="rounded-[5px] border border-brand-primary/30 bg-white px-4 py-2 text-sm font-medium text-brand-muted transition-all duration-150 hover:bg-brand-primary-light"
            >
                Atualizar
            </button>
            <button
                type="button"
                wire:click="logout"
                class="rounded-[5px] border border-brand-accent/30 bg-white px-4 py-2 text-sm font-medium text-brand-accent transition-all duration-150 hover:bg-brand-accent-light"
            >
                Sair
            </button>
        </div>
    </div>

    {{-- Empty state --}}
    @if ($isEmpty)
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-brand-primary/30 mb-6" aria-hidden="true">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
            </svg>
            <h2 class="font-serif text-xl text-brand-ink mb-2">Nenhum pedido pendente</h2>
            <p class="text-sm text-brand-muted max-w-sm">
                Todos os pedidos de oração foram respondidos. Volte mais tarde para verificar novamente.
            </p>
        </div>
    @endif

    {{-- Request cards --}}
    @if (!$isEmpty)
        <div class="space-y-4">
            @foreach ($requests as $req)
                <div class="painel-card rounded-sm bg-white p-6 shadow-sm transition-all duration-150 hover:shadow-md">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-2 flex-wrap">
                                @if ($req['is_overdue'])
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c0392b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                @endif
                                <h3 class="font-serif text-lg text-brand-ink truncate">
                                    @if ($req['name'] === 'Anônimo')
                                        <span class="text-brand-muted">{{ $req['name'] }}</span>
                                    @else
                                        {{ $req['name'] }}
                                    @endif
                                </h3>
                                <span class="inline-block rounded-full px-3 py-0.5 text-xs {{ $req['is_overdue'] ? 'bg-red-100 text-red-700 font-medium' : 'bg-brand-primary-light text-brand-primary' }}">
                                    {{ $req['elapsed'] }}
                                </span>
                            </div>
                            <p class="text-sm leading-relaxed text-brand-ink/85 line-clamp-3">
                                {{ $req['message'] }}
                            </p>
                        </div>
                        <div class="shrink-0">
                            <div class="flex flex-col items-end gap-2">
                                <span class="inline-block rounded-sm border border-brand-primary/20 px-3 py-1 text-xs text-brand-muted">
                                    {{ $this->prayerTypeLabel($req['prayer_type']) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Contact details --}}
                    <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs text-brand-muted/70">
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

                    <div class="mt-3 flex items-center justify-between">
                        <div class="text-xs {{ $req['is_overdue'] ? 'text-red-600 font-medium' : 'text-brand-muted/50' }}">
                            {{ $req['created_at']->format('d/m/Y H:i') }}
                        </div>
                        <a href="{{ route('painel.responder', $req['id']) }}"
                           class="rounded-[5px] bg-brand-primary px-4 py-1.5 text-xs font-medium text-white no-underline transition-all duration-150 hover:shadow-md">
                            Responder
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="text-center text-xs text-brand-muted/50 mt-8">
            {{ count($requests) }} pedido(s) pendente(s)
        </p>
    @endif

    @vite('resources/css/painel.css')
    </div>
</div>
