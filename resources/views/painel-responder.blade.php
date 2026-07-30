<?php

use App\Models\PrayerRequest;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Responder Pedido')] class extends Component {
    public PrayerRequest $request;
    public string $decryptedMessage = '';
    public ?string $decryptedEmail = null;
    public ?string $decryptedWhatsapp = null;
    public string $mediaUrl = '';
    public bool $whatsappSent = false;
    public bool $emailSent = false;

    public function mount(PrayerRequest $prayerRequest): void
    {
        $this->request = $prayerRequest;

        try {
            $this->decryptedMessage = Crypt::decryptString($prayerRequest->message);
        } catch (\Exception) {
            $this->decryptedMessage = $prayerRequest->message;
        }

        if ($prayerRequest->email) {
            try {
                $this->decryptedEmail = Crypt::decryptString($prayerRequest->email);
            } catch (\Exception) {
                $this->decryptedEmail = $prayerRequest->email;
            }
        }

        if ($prayerRequest->whatsapp) {
            try {
                $this->decryptedWhatsapp = Crypt::decryptString($prayerRequest->whatsapp);
            } catch (\Exception) {
                $this->decryptedWhatsapp = $prayerRequest->whatsapp;
            }
        }
    }

    public function simulateWhatsApp(): void
    {
        $this->whatsappSent = true;
    }

    public function simulateEmail(): void
    {
        $this->emailSent = true;
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

    public function render()
    {
        return $this->view();
    }
};

?>

<div class="painel-page-body">
    <div class="mx-auto max-w-3xl px-6 py-10 sm:px-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2 no-underline transition-opacity duration-150 hover:opacity-70">
                    <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="h-8 w-8 object-contain opacity-85">
                    <span class="font-serif text-lg text-brand-primary font-bold">Rogai Conosco</span>
                </a>
                <span class="text-brand-muted/40 text-sm">/</span>
                <a href="{{ route('painel.dashboard') }}" class="font-serif text-lg text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">Painel</a>
                <span class="text-brand-muted/40 text-sm">/</span>
                <span class="font-serif text-lg text-brand-muted">Responder</span>
            </div>
        </div>

        {{-- Prayer request details --}}
        <div class="rounded-sm bg-white p-8 shadow-sm mb-6">
            <h1 class="font-serif text-xl text-brand-ink mb-6">Responder Pedido de Oração</h1>

            <div class="space-y-4 mb-8">
                <div>
                    <span class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-1">Nome</span>
                    <span class="font-serif text-lg text-brand-ink">{{ $request->name ?? 'Anônimo' }}</span>
                </div>

                <div>
                    <span class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-1">Pedido</span>
                    <p class="text-sm leading-relaxed text-brand-ink/85 bg-brand-primary-light/40 rounded-sm p-4">
                        {{ $decryptedMessage }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-6">
                    <div>
                        <span class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-1">Tipo de Oração</span>
                        <span class="text-sm text-brand-ink">{{ $this->prayerTypeLabel($request->prayer_type) }}</span>
                    </div>
                    @if ($request->religion)
                        <div>
                            <span class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-1">Religião</span>
                            <span class="text-sm text-brand-ink">{{ $this->religionLabel($request->religion) }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-1">Recebido em</span>
                        <span class="text-sm text-brand-ink">{{ $request->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- Contact info --}}
            <div class="border-t border-brand-primary/10 pt-6 mb-8">
                <h2 class="font-serif text-base text-brand-ink mb-4">Contato</h2>
                <div class="space-y-3">
                    @if ($decryptedWhatsapp)
                        <div class="flex items-center gap-3">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-muted/60 shrink-0">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <span class="text-sm text-brand-ink">{{ $decryptedWhatsapp }}</span>
                        </div>
                    @endif
                    @if ($decryptedEmail)
                        <div class="flex items-center gap-3">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-muted/60 shrink-0">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <span class="text-sm text-brand-ink">{{ $decryptedEmail }}</span>
                        </div>
                    @endif
                    @if (!$decryptedWhatsapp && !$decryptedEmail)
                        <p class="text-sm text-brand-muted italic">Nenhum contato informado.</p>
                    @endif
                </div>
            </div>

            {{-- Media upload --}}
            <div class="border-t border-brand-primary/10 pt-6 mb-8">
                <h2 class="font-serif text-base text-brand-ink mb-4">Mídia da Resposta</h2>
                <div class="rounded-sm border-2 border-dashed border-brand-primary/30 p-8 text-center transition-colors duration-150 hover:border-brand-primary/60">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 text-brand-muted/40" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                        <line x1="7" y1="2" x2="7" y2="22"/>
                        <line x1="17" y1="2" x2="17" y2="22"/>
                        <line x1="2" y1="12" x2="22" y2="12"/>
                        <line x1="2" y1="7" x2="7" y2="7"/>
                        <line x1="2" y1="17" x2="7" y2="17"/>
                        <line x1="17" y1="7" x2="22" y2="7"/>
                        <line x1="17" y1="17" x2="22" y2="17"/>
                    </svg>
                    <p class="text-sm text-brand-muted mb-2">Arraste o arquivo de áudio ou vídeo aqui</p>
                    <p class="text-xs text-brand-muted/50 mb-4">ou</p>
                    <label class="inline-block cursor-pointer rounded-[5px] border border-brand-primary/30 bg-white px-5 py-2 text-sm font-medium text-brand-muted transition-all duration-150 hover:bg-brand-primary-light">
                        Selecionar arquivo
                        <input type="file" accept="audio/*,video/*" class="hidden">
                    </label>
                </div>

                <div class="mt-4">
                    <label for="media-url" class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-2">Ou insira uma URL</label>
                    <input
                        type="url"
                        id="media-url"
                        wire:model="mediaUrl"
                        placeholder="https://example.com/video-oracao.mp4"
                        class="block w-full rounded-sm border border-brand-primary/30 bg-white px-4 py-3 text-sm text-brand-ink placeholder:text-brand-muted/60 focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                    >
                </div>
            </div>

            {{-- Notify actions --}}
            <div class="border-t border-brand-primary/10 pt-6">
                <h2 class="font-serif text-base text-brand-ink mb-4">Notificar</h2>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        type="button"
                        wire:click="simulateWhatsApp"
                        class="flex-1 flex items-center justify-center gap-2 rounded-[5px] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:shadow-md {{ $whatsappSent ? 'bg-brand-muted cursor-not-allowed' : 'bg-green-700 hover:bg-green-800' }}"
                        @if ($whatsappSent) disabled @endif
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        {{ $whatsappSent ? 'WhatsApp Enviado' : 'Enviar WhatsApp' }}
                    </button>
                    <button
                        type="button"
                        wire:click="simulateEmail"
                        class="flex-1 flex items-center justify-center gap-2 rounded-[5px] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:shadow-md {{ $emailSent ? 'bg-brand-muted cursor-not-allowed' : 'bg-brand-accent hover:bg-brand-accent/90' }}"
                        @if ($emailSent) disabled @endif
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        {{ $emailSent ? 'Email Enviado' : 'Enviar Email' }}
                    </button>
                </div>
                @if ($whatsappSent || $emailSent)
                    <div class="mt-4 rounded-sm bg-green-50 border border-green-200 p-4 text-center">
                        <p class="text-sm text-green-700 font-medium">
                            @if ($whatsappSent && $emailSent)
                                Notificações enviadas por WhatsApp e Email.
                            @elseif ($whatsappSent)
                                Notificação enviada por WhatsApp.
                            @else
                                Notificação enviada por Email.
                            @endif
                        </p>
                        <p class="text-xs text-green-600/70 mt-1">Funcionalidade simulada — integração real será implementada.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Back --}}
        <div class="text-center">
            <a href="{{ route('painel.dashboard') }}" class="text-sm text-brand-primary no-underline transition-colors duration-150 hover:text-brand-accent">
                ← Voltar ao painel
            </a>
        </div>
    </div>

    @vite('resources/css/painel.css')
</div>
