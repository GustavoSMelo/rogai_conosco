<?php

use App\Models\PrayerRequest;
use App\Services\SendPrayerResponseEmailService;
use App\Services\WhatsAppDeepLinkService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Responder Pedido')] class extends Component
{
    use WithFileUploads;

    public PrayerRequest $request;

    public string $decryptedMessage = '';

    public ?string $decryptedEmail = null;

    public ?string $decryptedWhatsapp = null;

    public string $mediaUrl = '';

    public ?string $mediaLink = null;

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

    public bool $markedAnswered = false;

    public ?string $whatsappUrl = null;

    public function mount(PrayerRequest $prayerRequest): void
    {
        $this->request = $prayerRequest;

        try {
            $this->decryptedMessage = Crypt::decryptString($prayerRequest->message);
        } catch (Exception) {
            $this->decryptedMessage = $prayerRequest->message;
        }

        if ($prayerRequest->email) {
            try {
                $this->decryptedEmail = Crypt::decryptString($prayerRequest->email);
            } catch (Exception) {
                $this->decryptedEmail = $prayerRequest->email;
            }
        }

        if ($prayerRequest->whatsapp) {
            try {
                $this->decryptedWhatsapp = Crypt::decryptString($prayerRequest->whatsapp);
            } catch (Exception) {
                $this->decryptedWhatsapp = $prayerRequest->whatsapp;
            }
        }

        $this->markedAnswered = $prayerRequest->has_answered;
    }

    public function updatedMediaFile(): void
    {
        $this->validate([
            'mediaFile' => 'file|mimes:mp3,mp4|max:51200',
        ]);

        $this->mediaFileName = $this->mediaFile->getClientOriginalName();
        $this->mediaFileType = $this->mediaFile->getClientMimeType();
        $sizeKB = round($this->mediaFile->getSize() / 1024, 1);
        $this->mediaFileSize = $sizeKB >= 1024 ? round($sizeKB / 1024, 1).' MB' : $sizeKB.' KB';
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

    public function markWhatsappOpened(): void
    {
        $this->whatsappSent = true;

        Log::info('WhatsApp aberto', [
            'request_id' => $this->request->id,
            'phone' => $this->decryptedWhatsapp,
        ]);
    }

    public function markAsAnswered(): void
    {
        if ($this->markedAnswered) {
            return;
        }

        $this->request->update([
            'has_answered' => true,
            'date_answered' => now(),
        ]);

        $this->markedAnswered = true;

        Log::info('Pedido marcado como respondido', [
            'request_id' => $this->request->id,
        ]);
    }

    public function sendEmail(): void
    {
        $this->emailError = null;

        if (! $this->decryptedEmail) {
            $this->emailError = 'Email do solicitante não disponível';
            Log::warning('Email não disponível', ['request_id' => $this->request->id]);

            return;
        }

        $this->emailSending = true;

        try {
            [$mediaFilePath, $mediaFileName] = $this->resolveMediaForSend();

            app(SendPrayerResponseEmailService::class)->send(
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
        } catch (Exception $e) {
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
        if ($this->mediaFile && (! $this->mediaFilePath || ! file_exists($this->mediaFilePath))) {
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
        $this->whatsappUrl = $this->isValidMediaLink($this->mediaLink)
            ? app(WhatsAppDeepLinkService::class)->build(
                phone: $this->decryptedWhatsapp,
                name: $this->request->name ?? '',
                prayerMessage: $this->decryptedMessage,
                mediaUrl: $this->mediaLink,
            )
            : null;

        return $this->view();
    }

    private function isValidMediaLink(?string $url): bool
    {
        if ($url === null || ! str_starts_with($url, 'https://')) {
            return false;
        }

        return (bool) preg_match(
            '~^https://[^/\s?#]+\.(com\.br|com|dev\.br|dev|app\.br|app)([/?#]|$)~i',
            $url,
        );
    }
};

?>

<div class="painel-page-body">
    <div class="painel-container-narrow">

        {{-- Header --}}
        <div class="painel-header-narrow">
            <div class="painel-header-inner">
                <a href="{{ route('welcome') }}" class="painel-brand-link">
                    <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="painel-brand-logo">
                    <span class="painel-brand-text">Rogai Conosco</span>
                </a>
                <span class="painel-crumb-sep">/</span>
                <a href="{{ route('painel.dashboard') }}" class="painel-crumb-link">Painel</a>
                <span class="painel-crumb-sep">/</span>
                <span class="painel-crumb-current">Responder</span>
            </div>
        </div>

        {{-- Prayer request details --}}
        <div class="painel-responder-card">
            <h1 class="painel-heading">Responder Pedido de Oração</h1>

            <div class="painel-details">
                <div>
                    <span class="painel-field-label">Nome</span>
                    <span class="painel-field-value">{{ $request->name ?? 'Anônimo' }}</span>
                </div>

                <div>
                    <span class="painel-field-label">Pedido</span>
                    <p class="painel-message-text">
                        {{ $decryptedMessage }}
                    </p>
                </div>

                <div class="painel-details-row">
                    <div>
                        <span class="painel-field-label">Tipo de Oração</span>
                        <span class="painel-field-value-sm">{{ $this->prayerTypeLabel($request->prayer_type) }}</span>
                    </div>
                    @if ($request->religion)
                        <div>
                            <span class="painel-field-label">Religião</span>
                            <span class="painel-field-value-sm">{{ $this->religionLabel($request->religion) }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="painel-field-label">Recebido em</span>
                        <span class="painel-field-value-sm">{{ $request->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- Contact info --}}
            <div class="painel-section">
                <h2 class="painel-section-title">Contato</h2>
                <div class="painel-contact-list">
                    @if ($decryptedWhatsapp)
                        <div class="painel-contact-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-contact-icon">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <span class="painel-field-value-sm">{{ $decryptedWhatsapp }}</span>
                        </div>
                    @endif
                    @if ($decryptedEmail)
                        <div class="painel-contact-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="painel-contact-icon">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <span class="painel-field-value-sm">{{ $decryptedEmail }}</span>
                        </div>
                    @endif
                    @if (!$decryptedWhatsapp && !$decryptedEmail)
                        <p class="painel-contact-none">Nenhum contato informado.</p>
                    @endif
                </div>
            </div>

            {{-- Media upload --}}
            <div class="painel-section">
                <h2 class="painel-section-title">Mídia da Resposta</h2>

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
                    class="painel-dropzone"
                    :class="dragging ? 'painel-dropzone-active' : 'painel-dropzone-idle'"
                >
                    <input type="file" accept=".mp3,.mp4" x-ref="fileInput" class="hidden"
                           x-on:change="handleUpload($event.target.files[0]); $event.target.value = ''">

                    @if ($mediaFileUrl)
                        <div class="painel-upload-card">
                            <div class="painel-file-card">
                                <p class="painel-file-name">{{ $mediaFileName ?? 'Arquivo' }}</p>
                                <p class="painel-file-meta">{{ $mediaFileType ?? '' }}@if($mediaFileSize) — {{ $mediaFileSize }}@endif</p>
                            </div>
                            <div class="painel-media-preview">
                                @if (str_ends_with($mediaFileUrl, '.mp4'))
                                    <video controls class="painel-video" src="{{ $mediaFileUrl }}"></video>
                                @else
                                    <div class="painel-audio-wrap">
                                        <audio controls class="painel-audio" src="{{ $mediaFileUrl }}"></audio>
                                    </div>
                                @endif
                            </div>
                            <button type="button" wire:click="removeMedia" class="painel-remove-link">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                                Remover arquivo
                            </button>
                        </div>
                    @else
                        <template x-if="sending">
                            <div class="painel-upload-progress">
                                <div class="painel-upload-progress-row">
                                    <div class="painel-upload-progress-icon">
                                        <svg class="painel-upload-progress-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                    </div>
                                    <div class="painel-upload-progress-text">
                                        <p class="painel-upload-name" x-text="fileName || 'Enviando…'"></p>
                                        <p class="painel-upload-sub"><span x-text="fileSize ? fileSize + ' — ' : ''"></span><span x-text="prog < 100 ? prog + '%' : 'Concluído'"></span></p>
                                    </div>
                                </div>
                                <div class="painel-upload-track">
                                    <div class="painel-upload-bar" :style="'width: ' + prog + '%'"></div>
                                </div>
                            </div>
                        </template>

                        <template x-if="!sending">
                            <div>
                                <template x-if="uploadError">
                                    <div class="painel-alert-error painel-alert-error-upload">
                                        <p class="painel-alert-error-text" x-text="uploadErrorMessage || 'Erro ao enviar. Tente novamente.'"></p>
                                    </div>
                                </template>
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="painel-upload-icon" aria-hidden="true">
                                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                                    <line x1="7" y1="2" x2="7" y2="22"/>
                                    <line x1="17" y1="2" x2="17" y2="22"/>
                                    <line x1="2" y1="12" x2="22" y2="12"/>
                                    <line x1="2" y1="7" x2="7" y2="7"/>
                                    <line x1="2" y1="17" x2="7" y2="17"/>
                                    <line x1="17" y1="7" x2="22" y2="7"/>
                                    <line x1="17" y1="17" x2="22" y2="17"/>
                                </svg>
                                <p class="painel-upload-hint">Arraste o arquivo de áudio ou vídeo aqui</p>
                                <p class="painel-upload-or">ou</p>
                                <label x-on:click.prevent="$refs.fileInput.click()" class="painel-upload-btn">
                                    Selecionar arquivo
                                </label>
                            </div>
                        </template>
                    @endif
                </div>

                <div class="painel-url-row" x-data="{
                    url: $wire.mediaLink || '',
                    isValidUrl(val) {
                        if (!val) return null;
                        return /^https:\/\/[^\/\s?#]+\.(com\.br|com|dev\.br|dev|app\.br|app)([\/?#]|$)/i.test(val);
                    }
                }" x-init="$watch('url', val => {
                    $wire.set('mediaLink', val);
                })">
                    <label for="media-url" class="painel-url-label">Ou cole um link</label>
                    <div class="painel-url-field">
                        <input
                            type="text"
                            id="media-url"
                            x-model="url"
                            x-on:blur="if (url && !url.startsWith('http') && !url.startsWith('/')) { url = 'https://' + url }"
                            placeholder="https://exemplo.com/minha-oracao.mp3"
                            class="painel-url-input"
                            :class="isValidUrl(url) === false
                                ? 'painel-url-invalid'
                                : isValidUrl(url) === true
                                    ? 'painel-url-valid'
                                    : 'painel-url-idle'"
                        >
                        <template x-if="url && isValidUrl(url)">
                            <span class="painel-url-icon painel-url-icon-valid">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </span>
                        </template>
                        <template x-if="url && isValidUrl(url) === false">
                            <span class="painel-url-icon painel-url-icon-invalid">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                                </svg>
                            </span>
                        </template>
                    </div>
                    <p class="painel-url-hint">
                        <template x-if="!url">Cole o link público do arquivo .mp3 ou .mp4</template>
                        <template x-if="url && isValidUrl(url) === false">Use <span class="painel-url-hint-mono">https://</span> com domínio <span class="painel-url-hint-mono">.com</span>, <span class="painel-url-hint-mono">.com.br</span>, <span class="painel-url-hint-mono">.dev</span>, <span class="painel-url-hint-mono">.dev.br</span>, <span class="painel-url-hint-mono">.app</span> ou <span class="painel-url-hint-mono">.app.br</span></template>
                        <template x-if="url && isValidUrl(url)">Link válido</template>
                    </p>
                </div>
            </div>

            {{-- Notify actions --}}
            <div class="painel-section-last">
                <h2 class="painel-section-title">Notificar</h2>
                <div class="painel-notify-row">
                    @if ($whatsappUrl && !$whatsappSent)
                        <a
                            href="{{ $whatsappUrl }}"
                            target="_blank"
                            rel="noopener"
                            wire:click="markWhatsappOpened"
                            class="painel-btn-notify painel-btn-whatsapp-active"
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            Enviar WhatsApp
                        </a>
                    @else
                        <button
                            type="button"
                            class="painel-btn-notify painel-btn-disabled"
                            disabled
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            {{ $whatsappSent ? 'WhatsApp Enviado' : 'Enviar WhatsApp' }}
                        </button>
                    @endif
                    <button
                        type="button"
                        wire:click="sendEmail"
                        wire:loading.attr="disabled"
                        class="painel-btn-notify {{ $emailSent ? 'painel-btn-disabled' : 'painel-btn-email-active' }}"
                        @if ($emailSent || $emailSending) disabled @endif
                    >
                        @if ($emailSending)
                            <svg class="painel-spinner" viewBox="0 0 24 24" fill="none" aria-hidden="true">
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
                @if (!$decryptedWhatsapp)
                    <p class="painel-contact-none">Solicitante não informou número de WhatsApp.</p>
                @elseif (!$mediaLink)
                    <p class="painel-contact-none">Informe um link de mídia para enviar por WhatsApp.</p>
                @elseif (!$this->isValidMediaLink($mediaLink))
                    <p class="painel-contact-none">Link de mídia inválido. Use https:// com domínio .com, .com.br, .dev, .dev.br, .app ou .app.br.</p>
                @endif
                @if ($emailError)
                    <div class="painel-alert-error painel-alert-error-notify">
                        <p class="painel-alert-error-text-sm">{{ $emailError }}</p>
                    </div>
                @endif
                @if ($whatsappSent && !$emailSent)
                    <div class="painel-alert-success">
                        <p class="painel-alert-success-text">Notificação enviada por WhatsApp.</p>
                    </div>
                @endif
                @if ($emailSent)
                    <div class="painel-alert-success">
                        <p class="painel-alert-success-text">Email enviado com sucesso.</p>
                    </div>
                @endif
            </div>

            {{-- Mark as answered --}}
            <div class="painel-section-last">
                <h2 class="painel-section-title">Status</h2>
                <button
                    type="button"
                    wire:click="markAsAnswered"
                    class="painel-btn-status {{ $markedAnswered ? 'painel-btn-status-done' : 'painel-btn-status-idle' }}"
                    @if ($markedAnswered) disabled @endif
                >
                    @if ($markedAnswered)
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Respondido em {{ $request->date_answered?->format('d/m/Y') ?? now()->format('d/m/Y') }}
                    @else
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
                        </svg>
                        Marcar como respondido
                    @endif
                </button>
            </div>
        </div>

        {{-- Back --}}
        <div class="painel-back">
            <a href="{{ route('painel.dashboard') }}" class="painel-footer-link">
                ← Voltar ao painel
            </a>
        </div>
    </div>

    @vite('resources/css/painel.css')
</div>
