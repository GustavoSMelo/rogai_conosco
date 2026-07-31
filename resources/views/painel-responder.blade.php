<?php

use App\Actions\SendPrayerResponseEmail;
use App\Models\PrayerRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Responder Pedido')] class extends Component {
    use WithFileUploads;

    public PrayerRequest $request;
    public string $decryptedMessage = '';
    public ?string $decryptedEmail = null;
    public ?string $decryptedWhatsapp = null;
    public string $mediaUrl = '';
    public $mediaFile = null;
    public ?string $mediaFileUrl = null;
    public ?string $mediaFilePath = null;
    public ?string $mediaFileName = null;
    public ?string $mediaFileType = null;
    public ?string $mediaFileSize = null;
    public bool $uploadError = false;
    public ?string $uploadErrorMessage = null;
    public bool $whatsappSent = false;
    public bool $emailSent = false;
    public bool $emailSending = false;
    public ?string $emailError = null;

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

    public function updatedMediaFile(): void
    {
        $this->validate([
            'mediaFile' => 'file|mimes:mp3,mp4|max:51200',
        ]);

        $this->mediaFileName = $this->mediaFile->getClientOriginalName();
        $this->mediaFileType = $this->mediaFile->getClientMimeType();
        $sizeKB = round($this->mediaFile->getSize() / 1024, 1);
        $this->mediaFileSize = $sizeKB >= 1024 ? round($sizeKB / 1024, 1) . ' MB' : $sizeKB . ' KB';
        $this->uploadError = false;
        $this->uploadErrorMessage = null;

        $path = $this->mediaFile->store('response-media', 'public');
        $this->mediaFilePath = Storage::disk('public')->path($path);
        $this->mediaFileUrl = Storage::disk('public')->url($path);
        $this->mediaUrl = $this->mediaFileUrl;
    }

    public function removeMedia(): void
    {
        $this->mediaFile = null;
        $this->mediaFileUrl = null;
        $this->mediaFilePath = null;
        $this->mediaFileName = null;
        $this->mediaFileType = null;
        $this->mediaFileSize = null;
        $this->mediaUrl = '';
    }

    public function simulateWhatsApp(): void
    {
        $this->whatsappSent = true;
    }

    public function sendEmail(): void
    {
        $this->emailError = null;

        if (!$this->decryptedEmail) {
            $this->emailError = 'Email do solicitante não disponível';
            Log::warning('Email não disponível', ['request_id' => $this->request->id]);
            return;
        }

        $this->emailSending = true;

        try {
            [$mediaFilePath, $mediaFileName] = $this->resolveMediaForSend();

            app(\App\Actions\SendPrayerResponseEmail::class)->send(
                to: $this->decryptedEmail,
                name: $this->request->name ?? 'Anônimo',
                prayerMessage: $this->decryptedMessage,
                mediaUrl: $this->mediaUrl ?: null,
                mediaFilePath: $mediaFilePath,
                mediaFileName: $mediaFileName,
            );

            $this->emailSent = true;

            Log::info('Email enviado', [
                'request_id' => $this->request->id,
                'email' => $this->decryptedEmail,
            ]);
        } catch (\Exception $e) {
            $this->emailError = 'Falha ao enviar email. Tente novamente.';
            Log::error('Falha ao enviar email', [
                'request_id' => $this->request->id,
                'error' => $e->getMessage(),
            ]);
        } finally {
            $this->emailSending = false;
        }
    }

    private function resolveMediaForSend(): array
    {
        // Se temos arquivo temporário válido E (path inexistente OU arquivo sumiu), re-store
        if ($this->mediaFile && (!$this->mediaFilePath || !file_exists($this->mediaFilePath))) {
            $path = $this->mediaFile->store('response-media', 'public');
            $this->mediaFilePath = Storage::disk('public')->path($path);
            $this->mediaFileName ??= $this->mediaFile->getClientOriginalName();
            $this->mediaFileUrl = Storage::disk('public')->url($path);
            $this->mediaUrl = $this->mediaFileUrl;
            return [$this->mediaFilePath, $this->mediaFileName];
        }

        // Sem temp file: usa path salvo SE existir, senão retorna nulls
        if ($this->mediaFilePath && file_exists($this->mediaFilePath)) {
            return [$this->mediaFilePath, $this->mediaFileName];
        }

        return [null, $this->mediaFileName];
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

                <div
                    x-data="{
                        dragging: false,
                        prog: 0,
                        sending: false,
                        fileName: '',
                        fileSize: '',
                        uploadError: false,
                        uploadErrorMessage: '',
                        maxBytes: 52428800,
                        watchdog: null,
                        handleUpload(f) {
                            if (!f) return;
                            if (f.size > this.maxBytes) {
                                this.uploadError = true;
                                this.uploadErrorMessage = 'Arquivo excede o limite de 50 MB.';
                                return;
                            }
                            this.fileName = f.name;
                            this.fileSize = (f.size / 1024 / 1024).toFixed(1) + ' MB';
                            this.sending = true;
                            this.prog = 0;
                            this.uploadError = false;
                            this.uploadErrorMessage = '';
                            clearTimeout(this.watchdog);
                            this.watchdog = setTimeout(() => {
                                if (this.sending) {
                                    this.sending = false;
                                    this.uploadError = true;
                                    this.uploadErrorMessage = 'O upload demorou demais. Tente novamente.';
                                }
                            }, 120000);
                            $wire.upload('mediaFile', f,
                                () => { clearTimeout(this.watchdog); this.sending = false; },
                                () => { clearTimeout(this.watchdog); this.sending = false; this.uploadError = true; this.uploadErrorMessage = 'Erro no envio. O arquivo pode ser grande demais (limite de 50 MB).'; },
                                p => { this.prog = p; });
                        }
                    }"
                    x-on:dragenter.prevent="dragging = true"
                    x-on:dragover.prevent="dragging = true"
                    x-on:dragleave.prevent="dragging = false"
                    x-on:drop.prevent="dragging = false; handleUpload($event.dataTransfer.files[0])"
                    class="rounded-sm border-2 border-dashed p-8 text-center transition-all duration-300"
                    :class="dragging ? 'border-brand-primary bg-brand-primary-light/60 scale-[1.02]' : 'border-brand-primary/30'"
                >
                    <input type="file" accept=".mp3,.mp4" x-ref="fileInput" class="hidden"
                           x-on:change="handleUpload($event.target.files[0]); $event.target.value = ''">

                    @if ($mediaFileUrl)
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-full max-w-xs rounded-sm bg-brand-primary-light/30 p-3 text-left">
                                <p class="text-sm text-brand-ink font-medium truncate">{{ $mediaFileName ?? 'Arquivo' }}</p>
                                <p class="text-xs text-brand-muted/70">{{ $mediaFileType ?? '' }}@if($mediaFileSize) — {{ $mediaFileSize }}@endif</p>
                            </div>
                            <div class="w-full max-w-xs">
                                @if (str_ends_with($mediaFileUrl, '.mp4'))
                                    <video controls class="w-full rounded-sm shadow-sm" src="{{ $mediaFileUrl }}"></video>
                                @else
                                    <div class="flex items-center justify-center rounded-sm bg-brand-primary-light/60 p-4">
                                        <audio controls class="w-full" src="{{ $mediaFileUrl }}"></audio>
                                    </div>
                                @endif
                            </div>
                            <button type="button" wire:click="removeMedia" class="flex items-center gap-1.5 text-xs text-brand-accent hover:text-brand-accent/80 transition-colors">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                                Remover arquivo
                            </button>
                        </div>
                    @else
                        <template x-if="sending">
                            <div class="flex flex-col items-center gap-4">
                                <div class="flex items-center gap-3 w-full max-w-xs">
                                    <div class="shrink-0 w-10 h-10 rounded-sm bg-brand-primary-light flex items-center justify-center">
                                        <svg class="w-5 h-5 text-brand-primary animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 text-left">
                                        <p class="text-sm text-brand-ink font-medium truncate" x-text="fileName || 'Enviando…'"></p>
                                        <p class="text-xs text-brand-muted/60"><span x-text="fileSize ? fileSize + ' — ' : ''"></span><span x-text="prog < 100 ? prog + '%' : 'Concluído'"></span></p>
                                    </div>
                                </div>
                                <div class="w-full max-w-xs h-1.5 rounded-full bg-brand-primary-light overflow-hidden">
                                    <div class="h-full rounded-full bg-brand-primary transition-all duration-300 ease-out" :style="'width: ' + prog + '%'"></div>
                                </div>
                            </div>
                        </template>

                        <template x-if="!sending">
                            <div>
                                <template x-if="uploadError">
                                    <div class="mb-4 rounded-sm bg-red-50 border border-red-200 p-4">
                                        <p class="text-xs text-red-700" x-text="uploadErrorMessage || 'Erro ao enviar. Tente novamente.'"></p>
                                    </div>
                                </template>
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
                                <label x-on:click.prevent="$refs.fileInput.click()" class="inline-block cursor-pointer rounded-[5px] border border-brand-primary/30 bg-white px-5 py-2 text-sm font-medium text-brand-muted transition-all duration-150 hover:bg-brand-primary-light hover:border-brand-primary/60">
                                    Selecionar arquivo
                                </label>
                            </div>
                        </template>
                    @endif
                </div>

                <div class="mt-4" x-data="{
                    url: $wire.mediaUrl || '',
                    isValidUrl(val) {
                        if (!val) return null;
                        return val.startsWith('http://') || val.startsWith('https://') || val.startsWith('/');
                    }
                }" x-init="$watch('url', val => {
                    $wire.set('mediaUrl', val);
                })">
                    <label for="media-url" class="block text-xs text-brand-muted/60 uppercase tracking-wider mb-2">Ou cole um link</label>
                    <div class="relative">
                        <input
                            type="text"
                            id="media-url"
                            x-model="url"
                            x-on:blur="if (url && !url.startsWith('http') && !url.startsWith('/')) { url = 'https://' + url }"
                            placeholder="https://exemplo.com/minha-oracao.mp3"
                            class="block w-full rounded-sm border px-4 py-3 pr-10 text-sm text-brand-ink placeholder:text-brand-muted/60 focus:ring-1 transition-all duration-150"
                            :class="isValidUrl(url) === false
                                ? 'border-red-400 focus:border-red-400 focus:ring-red-400/30'
                                : isValidUrl(url) === true
                                    ? 'border-green-500 focus:border-green-500 focus:ring-green-500/30'
                                    : 'border-brand-primary/30 focus:border-brand-primary focus:ring-brand-primary'"
                        >
                        <template x-if="url && isValidUrl(url)">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-green-600">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </span>
                        </template>
                        <template x-if="url && isValidUrl(url) === false">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-red-500">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                                </svg>
                            </span>
                        </template>
                    </div>
                    <p class="mt-1.5 text-xs text-brand-muted/50">
                        <template x-if="!url">Cole o link público do arquivo .mp3 ou .mp4</template>
                        <template x-if="url && isValidUrl(url) === false">O link precisa começar com <span class="font-mono">https://</span></template>
                        <template x-if="url && isValidUrl(url)">Link válido</template>
                    </p>
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
                        wire:click="sendEmail"
                        wire:loading.attr="disabled"
                        class="flex-1 flex items-center justify-center gap-2 rounded-[5px] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:shadow-md {{ $emailSent ? 'bg-brand-muted cursor-not-allowed' : 'bg-brand-accent hover:bg-brand-accent/90' }}"
                        @if ($emailSent || $emailSending) disabled @endif
                    >
                        @if ($emailSending)
                            <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Enviando...
                        @else
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            {{ $emailSent ? 'Email Enviado' : 'Enviar Email' }}
                        @endif
                    </button>
                </div>
                @if ($emailError)
                    <div class="mt-4 rounded-sm bg-red-50 border border-red-200 p-4 text-center">
                        <p class="text-sm text-red-700 font-medium">{{ $emailError }}</p>
                    </div>
                @endif
                @if ($whatsappSent && !$emailSent)
                    <div class="mt-4 rounded-sm bg-green-50 border border-green-200 p-4 text-center">
                        <p class="text-sm text-green-700 font-medium">Notificação enviada por WhatsApp.</p>
                    </div>
                @endif
                @if ($emailSent)
                    <div class="mt-4 rounded-sm bg-green-50 border border-green-200 p-4 text-center">
                        <p class="text-sm text-green-700 font-medium">Email enviado com sucesso.</p>
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
