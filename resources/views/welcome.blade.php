<?php

use App\Models\PrayerRequest;
use App\Services\SendPrayerResponseEmailService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Rogai Conosco Someone is praying for you')] class extends Component
{
    public ?string $name = null;

    public ?string $whatsapp = null;

    public ?string $email = null;

    public string $message = '';

    public string $religion = 'catholic';

    public string $prayerType = 'ai';

    public bool $showSuccess = false;

    protected function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:10000'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'religion' => ['nullable', 'string', 'max:100'],
            'prayerType' => ['required', 'string', 'in:ai,instant,person-prayer-audio,person-prayer-video,person-bible-audio,person-bible-video,person-bible-prayer-audio,person-bible-prayer-video'],
        ];
    }

    public function submit(): void
    {
        if (blank(trim($this->message))) {
            $this->addError('message', 'Por favor, descreva seu pedido de oração.');

            return;
        }

        if (blank(trim((string) $this->email)) && blank(trim((string) $this->whatsapp))) {
            $this->addError('contact', 'Informe pelo menos um meio de contato: WhatsApp ou e-mail.');

            return;
        }

        $this->validate();

        $delivery = match ($this->prayerType) {
            'ai' => 'ai',
            'instant' => 'instant',
            default => 'person',
        };

        PrayerRequest::create([
            'name' => $this->name,
            'message' => Crypt::encryptString($this->message),
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'religion' => $this->religion,
            'prayer_type' => $this->prayerType,
            'delivery' => $delivery,
            'has_answered' => $delivery === 'person' ? false : true,
            'date_answered' => $delivery === 'person' ? null : now(),
        ]);

        $this->sendConfirmationEmail($delivery);

        $this->showSuccess = true;

        $this->redirect(route('prayer.result', [
            'type' => $this->prayerType,
            'religion' => $this->religion,
            'description' => Crypt::encryptString($this->message),
        ]));
    }

    private function sendConfirmationEmail(string $delivery): void
    {
        if ($delivery !== 'person' || blank(trim((string) $this->email))) {
            Log::info('Email de confirmação ignorado', [
                'delivery' => $delivery,
                'email' => $this->email,
            ]);

            return;
        }

        Log::info('Enviando email de confirmação', [
            'delivery' => $delivery,
            'email' => $this->email,
            'name' => $this->name,
        ]);

        try {
            app(SendPrayerResponseEmailService::class)->send(
                to: $this->email,
                name: $this->name ?: 'Anônimo',
                prayerMessage: $this->message,
            );
        } catch (Throwable $e) {
            Log::error('Falha ao enviar email de confirmação', [
                'email' => $this->email,
                'error' => $e->getMessage(),
            ]);
        }
    }
};

?>

<div>
    {{-- Splash intro --}}
    <div id="splash" aria-hidden="true">
        <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="splash-logo">
        <span>
            <h1 class="splash-line">Rogai</h1>
            <h1 class="splash-line splash-line-2">Conosco</h1>
        </span>
    </div>

    <div id="page">

        {{-- Desktop sidebar --}}
        <aside class="sidebar" aria-label="Main navigation">
            <a href="/" class="welcome-brand-link">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="welcome-brand-logo">
                <span class="welcome-brand-text">Rogai <br />Conosco</span>
            </a>
            <nav class="welcome-nav-column">
                <a href="#hero" class="welcome-sidebar-link">Inicio</a>
                <a href="#about" class="welcome-sidebar-link">Sobre</a>
                <a href="#delivery" class="welcome-sidebar-link">Como funciona</a>
                <a href="#anonymity" class="welcome-sidebar-link">Anonimato</a>
                <a href="#opensource" class="welcome-sidebar-link">Open Source</a>
                <div class="welcome-nav-buttons">
                    <button type="button"
                            onclick="document.getElementById('prayer-modal').showModal()"
                            class="welcome-sidebar-btn">
                        Pedido de oração
                    </button>
                    <a href="{{ route('donate') }}" class="welcome-sidebar-btn">
                        Apoiar
                    </a>
                </div>
            </nav>
            <div class="mt-auto">
                <a href="https://github.com/GustavoSMelo/rogai_conosco"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="welcome-github-btn">
                    <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8Z"/>
                    </svg>
                    Ver no GitHub
                </a>
                <p class="welcome-sidebar-text">Feito com fé. Sustentado por doações.</p>
            </div>
        </aside>

        {{-- Mobile header --}}
        <header class="welcome-mobile-header">
            <div class="welcome-mobile-header-inner">
                <a href="/" class="welcome-brand-link-sm">
                    <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="welcome-brand-logo-sm">
                    <span class="welcome-brand-text-sm">Rogai <br />Conosco</span>
                </a>
                <button id="menu-btn"
                        class="welcome-menu-btn"
                        aria-label="Open menu"
                        aria-expanded="false"
                        aria-controls="side-nav"
                        type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                        <line x1="4" y1="7" x2="20" y2="7"/>
                        <line x1="4" y1="12" x2="20" y2="12"/>
                        <line x1="4" y1="17" x2="20" y2="17"/>
                    </svg>
                </button>
            </div>
        </header>

        {{-- Mobile nav overlay + drawer --}}
        <div id="nav-overlay" aria-hidden="true" class="md:hidden"></div>
        <nav id="side-nav" aria-label="Main navigation" role="dialog" aria-modal="true" class="md:hidden">
            <div class="welcome-mobile-nav-container">
                <div class="welcome-mobile-nav-header">
                    <button id="close-nav-btn"
                            class="welcome-nav-close-btn"
                            aria-label="Close menu"
                            type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                            <line x1="6" y1="6" x2="18" y2="18"/>
                            <line x1="18" y1="6" x2="6" y2="18"/>
                        </svg>
                    </button>
                </div>
                <div class="welcome-mobile-nav-links">
                    <a href="#hero" class="nav-link welcome-mobile-nav-link">Inicio</a>
                    <a href="#about" class="nav-link welcome-mobile-nav-link">Sobre</a>
                    <a href="#delivery" class="nav-link welcome-mobile-nav-link">Como funciona</a>
                    <a href="#anonymity" class="nav-link welcome-mobile-nav-link">Anonimato</a>
                    <a href="#opensource" class="nav-link welcome-mobile-nav-link">Open Source</a>
                    <div class="welcome-nav-buttons">
                        <button type="button"
                                class="nav-link welcome-mobile-nav-btn"
                                onclick="document.getElementById('prayer-modal').showModal(); closeMobileNav();">
                            Pedido de oração
                        </button>
                        <a href="{{ route('donate') }}" class="nav-link welcome-mobile-nav-btn">
                            Apoiar
                        </a>
                    </div>
                </div>
                <div class="mt-auto">
                    <a href="https://github.com/anomalyco/rogai_conosco"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="welcome-github-btn">
                        <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8Z"/>
                        </svg>
                        Ver no GitHub
                    </a>
                    <p class="welcome-sidebar-text">Feito com fé. Sustentado por doações.</p>
                </div>
            </div>
        </nav>

        {{-- Main content --}}
        <main class="main-content">

            {{-- Hero --}}
            <section id="hero" class="welcome-hero-section">
                {{-- Background photo with gradient overlay --}}
                <div class="welcome-hero-bg" aria-hidden="true">
                    <img src="https://images.unsplash.com/vector-1763972941999-0d38973175c5?q=80&w=1600&auto=format&fit=crop"
                         alt=""
                         class="welcome-hero-image"
                         loading="lazy">
                    <div class="welcome-hero-gradient"></div>
                </div>

                <div class="hero-content reveal welcome-hero-content">
                    <h1 class="welcome-hero-title">
                        Sua oração, carregada por alguém que se importa.
                    </h1>

                    <h3 class="welcome-hero-verse">
                        Tiago 5:16 - Portanto, confessem os seus pecados uns aos outros e orem uns pelos outros para serem curados. A oração de um justo é poderosa e eficaz
                    </h3>
                    <div class="welcome-hero-cta">
                        <button type="button"
                                onclick="document.getElementById('prayer-modal').showModal()"
                                class="welcome-hero-btn">
                            Pedir oração
                        </button>
                        <a href="#about" class="welcome-hero-link">
                            Saiba mais
                        </a>
                    </div>
                </div>

                {{-- Animated forest --}}
                <div class="hero-trees" aria-hidden="true">
                    <div class="tree-layer tree-layer-3" style="bottom: 0;">
                        <svg width="160" height="160" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 20L130 80H70L100 20Z" fill="#7d8a5a" opacity="0.25"/>
                            <rect x="95" y="80" width="10" height="30" fill="#7d8a5a" opacity="0.25"/>
                        </svg>
                        <svg width="200" height="180" viewBox="0 0 200 200" fill="none">
                            <path d="M100 10L140 90H60L100 10Z" fill="#7d8a5a" opacity="0.25"/>
                            <rect x="95" y="90" width="10" height="35" fill="#7d8a5a" opacity="0.25"/>
                        </svg>
                        <svg width="140" height="140" viewBox="0 0 200 200" fill="none">
                            <path d="M100 30L125 80H75L100 30Z" fill="#7d8a5a" opacity="0.25"/>
                            <rect x="95" y="80" width="10" height="25" fill="#7d8a5a" opacity="0.25"/>
                        </svg>
                        <svg width="180" height="170" viewBox="0 0 200 200" fill="none">
                            <path d="M100 15L135 85H65L100 15Z" fill="#7d8a5a" opacity="0.25"/>
                            <rect x="95" y="85" width="10" height="30" fill="#7d8a5a" opacity="0.25"/>
                        </svg>
                    </div>
                    <div class="tree-layer tree-layer-2" style="bottom: 0;">
                        <svg width="220" height="220" viewBox="0 0 240 240" fill="none">
                            <path d="M120 10L170 100H70L120 10Z" fill="#6a6a58" opacity="0.18"/>
                            <rect x="114" y="100" width="12" height="40" fill="#6a6a58" opacity="0.18"/>
                        </svg>
                        <svg width="260" height="240" viewBox="0 0 240 240" fill="none">
                            <path d="M120 5L175 105H65L120 5Z" fill="#6a6a58" opacity="0.18"/>
                            <rect x="113" y="105" width="14" height="45" fill="#6a6a58" opacity="0.18"/>
                        </svg>
                        <svg width="190" height="200" viewBox="0 0 240 240" fill="none">
                            <path d="M120 20L160 95H80L120 20Z" fill="#6a6a58" opacity="0.18"/>
                            <rect x="115" y="95" width="10" height="35" fill="#6a6a58" opacity="0.18"/>
                        </svg>
                    </div>
                    <div class="tree-layer tree-layer-1" style="bottom: 0;">
                        <svg width="280" height="280" viewBox="0 0 280 280" fill="none">
                            <path d="M140 5L200 115H80L140 5Z" fill="#7d8a5a" opacity="0.12"/>
                            <rect x="133" y="115" width="14" height="50" fill="#7d8a5a" opacity="0.12"/>
                        </svg>
                        <svg width="300" height="290" viewBox="0 0 280 280" fill="none">
                            <path d="M140 0L210 120H70L140 0Z" fill="#7d8a5a" opacity="0.12"/>
                            <rect x="132" y="120" width="16" height="55" fill="#7d8a5a" opacity="0.12"/>
                        </svg>
                        <svg width="240" height="260" viewBox="0 0 280 280" fill="none">
                            <path d="M140 15L190 105H90L140 15Z" fill="#7d8a5a" opacity="0.12"/>
                            <rect x="134" y="105" width="12" height="45" fill="#7d8a5a" opacity="0.12"/>
                        </svg>
                    </div>
                </div>
            </section>

            {{-- About / Mission --}}
            <section id="about" class="bg-brand-primary-light welcome-section">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mx-auto max-w-measure">
                        <h2 class="welcome-section-heading">
                            Um lugar seguro para pedir oração
                        </h2>
                        <div class="welcome-section-content">
                            <p>
                                Rogai Conosco existe para que ninguém precise enfrentar suas lutas sozinho.
                                Cada pedido é recebido com dignidade, respeito e oração real de uma pessoa real
                                sem julgamento, sem rastreamento, sem custo.
                            </p>
                            <p>
                                Este é um <strong>espaço gratuito e privado</strong>. Sem cadastro. Sem venda de dados.
                                Sem anúncios. Acreditamos que a oração deve ser acessível a todos,
                                independentemente de renda ou vínculo religioso.
                            </p>
                            <p>
                                O projeto é sustentado inteiramente por doações de quem acredita nesta
                                missão. Tudo o que recebemos é usado para manter este serviço gratuito e
                                expandir nosso alcance.
                            </p>
                        </div>
                        <div class="welcome-features-list">
                            <div class="welcome-feature-item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon" aria-hidden="true">
                                    <path d="M12 21.35C10.55 20.25 5 16 5 11.5 5 8.5 7.5 6 10.5 6c1.5 0 2.85.67 3.75 1.71C15.15 6.67 16.5 6 18 6 21 6 23.5 8.5 23.5 11.5c0 4.5-5.55 8.75-7 9.85L19.5 19 12 21.35Z"/>
                                </svg>
                                <span>Grátis e sempre será</span>
                            </div>
                            <div class="welcome-feature-item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon" aria-hidden="true">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <span>Privado e anônimo</span>
                            </div>
                            <div class="welcome-feature-item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon" aria-hidden="true">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                                </svg>
                                <span>Sustentado por doações</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- How it works --}}
            <section id="delivery" class="bg-brand-surface welcome-section">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mx-auto max-w-measure text-center">
                        <h2 class="welcome-section-heading">
                            Como sua oração chega até você
                        </h2>
                        <p class="welcome-delivery-subtitle">
                            Três formas de receber oração. Escolha a que melhor se encaixa para você.
                        </p>
                    </div>
                    <div class="reveal welcome-steps-wrapper">
                        {{-- Step 1 --}}
                        <div class="welcome-step">
                            <div class="welcome-step-divider">
                                <span class="welcome-step-number bg-brand-primary">1</span>
                                <div class="welcome-step-connector bg-brand-primary/30"></div>
                            </div>
                            <div class="welcome-step-body sm:bg-brand-primary-light">
                                <span class="welcome-step-number-sm bg-brand-primary">1</span>
                                <div class="welcome-step-content">
                                    <h3 class="welcome-step-title">Oração gravada - Mais pedida</h3>
                                    <p class="welcome-step-text">
                                        Uma oração real, gravada em áudio ou vídeo e entregue por WhatsApp ou e-mail em até 24&ndash;48 horas.
                                    </p>
                                </div>
                                <div class="welcome-step-label">
                                    <span class="welcome-chip border-brand-primary/30 text-brand-primary">48h</span>
                                </div>
                            </div>
                        </div>
                        {{-- Step 2 --}}
                        <div class="welcome-step sm:justify-end">
                            <div class="welcome-step-divider sm:order-last">
                                <span class="welcome-step-number bg-brand-accent">2</span>
                                <div class="welcome-step-connector bg-brand-accent/30"></div>
                            </div>
                            <div class="welcome-step-body sm:max-w-xl sm:bg-brand-accent-light">
                                <span class="welcome-step-number-sm bg-brand-accent">2</span>
                                <div class="welcome-step-content">
                                    <h3 class="welcome-step-title">Oração instantânea</h3>
                                    <p class="welcome-step-text">
                                        Orações bíblicas pré-escritas que você pode ler ou receber imediatamente. Baseadas nas Escrituras e pelos Santos e prontas quando você precisar.
                                    </p>
                                </div>
                                <div class="welcome-step-label">
                                    <span class="welcome-chip border-brand-accent/30 text-brand-accent">Imediato</span>
                                </div>
                            </div>
                        </div>
                        {{-- Step 3 --}}
                        <div class="welcome-step">
                            <div class="welcome-step-divider">
                                <span class="welcome-step-number bg-brand-ink">3</span>
                            </div>
                            <div class="welcome-step-body sm:bg-brand-ink/5">
                                <span class="welcome-step-number-sm bg-brand-ink">3</span>
                                <div class="welcome-step-content">
                                    <h3 class="welcome-step-title">Oração por IA</h3>
                                    <p class="welcome-step-text">
                                        Uma oração personalizada, composta por inteligência artificial sob medida para o seu pedido. Gerada instantaneamente.
                                    </p>
                                </div>
                                <div class="welcome-step-label">
                                    <span class="welcome-chip border-brand-ink/20 text-brand-ink/70">Instantâneo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="motherMaria">
                <span>
                    <h2>Santa Mae de Deus, Maria</h2>
                    <h4>Rogai Por nos pecadores agora e na hora de nossa morte</h4>
                </span>
            </section>

            {{-- Por que o anonimato importa --}}
            <section id="anonymity" class="bg-brand-surface welcome-section">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mx-auto max-w-measure text-center">
                        <h2 class="welcome-section-heading">
                            Por que o anonimato importa
                        </h2>
                        <p class="welcome-delivery-subtitle">
                            Às vezes é mais fácil compartilhar o que pesa no coração com alguém que não te conhece.
                            O anonimato torna a oração acessível a todos, sem medo.
                        </p>
                    </div>
                    <div class="reveal welcome-cards-grid">
                        <div class="welcome-card group">
                            <div class="welcome-flex-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-primary" aria-hidden="true">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                    <line x1="1" y1="1" x2="23" y2="23"/>
                                </svg>
                                <h3 class="welcome-card-title">Sem o peso do julgamento</h3>
                            </div>
                            <p class="welcome-card-text">
                                Um estranho não tem histórico, reputação nem contexto para te julgar.
                                Você pode ser sincero sem medo do "o que vão pensar de mim depois?".
                            </p>
                        </div>
                        <div class="welcome-card group">
                            <div class="welcome-flex-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-accent" aria-hidden="true">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                                <h3 class="welcome-card-title">Apenas a oração</h3>
                            </div>
                            <p class="welcome-card-text">
                                Você não precisa de um vínculo pessoal com quem ora. Basta que alguém
                                faça uma oração genuína em seu nome. Sem obrigações, sem cobranças,
                                sem mudança de tratamento.
                            </p>
                        </div>
                        <div class="welcome-card group">
                            <div class="welcome-flex-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-ink/60" aria-hidden="true">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                    <polyline points="9 22 9 12 15 12 15 22"/>
                                </svg>
                                <h3 class="welcome-card-title">Acolhimento sem distância</h3>
                            </div>
                            <p class="welcome-card-text">
                                Quem não faz parte de uma comunidade religiosa ou sente vergonha
                                dentro dela ainda merece apoio espiritual. O anonimato acolhe
                                sem exigir pertencimento.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Comunidade Open Source --}}
            <section id="opensource" class="bg-brand-primary-light welcome-section">
                <div class="mx-auto max-w-6xl">
                    <div class="reveal mx-auto max-w-measure text-center">
                        <h2 class="welcome-section-heading">
                            Comunidade Open Source
                        </h2>
                        <p class="welcome-open-source-subtitle">
                            Este projeto é <strong>código aberto</strong>. Acreditamos que a oração deve ser acessível a todos,
                            e o código também.
                        </p>
                        <div class="welcome-cards-grid">
                            <div class="welcome-card group">
                                <div class="welcome-flex-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-primary" aria-hidden="true">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 5.77 5.07 5.07 0 0 0 19.91 3S18.73.65 15 2.48a13.38 13.38 0 0 0-7 0C4.27.65 3.09 3 3.09 3A5.07 5.07 0 0 0 3 5.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 7 19.13V22"/>
                                    </svg>
                                    <h3 class="welcome-card-title">Código aberto</h3>
                                </div>
                                <p class="welcome-card-text">
                                    Todo o código-fonte está disponível publicamente. Você pode auditá-lo,
                                    modificá-lo e sugerir melhorias. Transparência não é apenas um valor
                                    é uma prática.
                                </p>
                            </div>
                            <div class="welcome-card group">
                                <div class="welcome-flex-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-accent" aria-hidden="true">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                    </svg>
                                    <h3 class="welcome-card-title">Contribua</h3>
                                </div>
                                <p class="welcome-card-text">
                                    Desenvolvedores, designers, tradutores todos são bem-vindos.
                                    O projeto está sempre aberto a novos contribuidores que queiram
                                    ajudar a levar oração a mais pessoas.
                                </p>
                            </div>
                        </div>
                        <div class="welcome-btn-wrapper">
                            <a href="https://github.com/GustavoSMelo/rogai_conosco"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="welcome-btn-outline">
                                Ver no GitHub
                            </a>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        {{-- Footer --}}
        <footer class="main-content welcome-footer">
            <div class="mx-auto max-w-6xl">
                <div class="welcome-footer-inner">
                    <div>
                        <p class="welcome-footer-brand-text">Rogai Conosco</p>
                        <p class="welcome-footer-tagline">Alguém está orando por você.</p>
                    </div>
                    <div class="welcome-footer-links">
                        <p class="welcome-footer-mission-text">
                            Grátis &middot; Privado &middot; Sustentado por doações
                        </p>
                        <a href="/donate" class="welcome-footer-link">
                            Apoie esta missão
                        </a>
                    </div>
                </div>
                <div class="welcome-footer-bottom">
                    <p class="welcome-footer-copyright">
                        Rogai Conosco &copy; {{ date('Y') }}. Feito com fé.
                    </p>
                </div>
            </div>
        </footer>

    </div>

    {{-- Prayer request modal --}}
    <dialog id="prayer-modal" aria-labelledby="modal-title">
        <div class="modal-content">
            <button type="button"
                    onclick="document.getElementById('prayer-modal').close()"
                    class="welcome-modal-close"
                    aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                    <line x1="6" y1="6" x2="18" y2="18"/>
                    <line x1="18" y1="6" x2="6" y2="18"/>
                </svg>
            </button>

            <h2 id="modal-title" class="welcome-modal-title">Pedir oração</h2>
            <p class="welcome-modal-subtitle">Compartilhe o que está no seu coração. Não precisa de cadastro.</p>

            {{-- Step indicator --}}
            <div class="welcome-step-indicator" id="step-indicator">
                <div class="welcome-step-dot welcome-step-dot-active" id="step-dot-1">1</div>
                <div class="welcome-step-connector-line"></div>
                <div class="welcome-step-dot" id="step-dot-2">2</div>
                <span class="welcome-step-label" id="step-label">Passo 1 de 2</span>
            </div>

            @if ($showSuccess)
                <div class="welcome-modal-success">
                    <p class="welcome-success-text">Seu pedido de oração foi recebido.</p>
                </div>
            @endif

            <form class="mt-8" id="prayer-form" onsubmit="return false;">
                {{-- Step 1: Name, WhatsApp, Email --}}
                <div id="modal-step-1" class="welcome-form-row welcome-modal-step">
                    <h3 class="welcome-step-heading">Seus dados</h3>
                    <div>
                        <label for="modal-name" class="welcome-form-label">
                            Seu nome <span class="welcome-form-hint">(opcional)</span>
                        </label>
                        <input type="text"
                               id="modal-name"
                               wire:model="name"
                               placeholder="Como podemos te chamar?"
                               class="welcome-form-input"
                               maxlength="100"
                        >
                    </div>

                    <div>
                        <label for="modal-whatsapp" class="welcome-form-label">
                            WhatsApp <span class="welcome-form-hint">(opcional)</span>
                        </label>
                        <label class="welcome-form-consent-row">
                            <input type="checkbox"
                                   id="modal-whatsapp-consent"
                                   class="welcome-form-checkbox">
                            <span class="welcome-form-consent-label">Quero receber minha oração pelo WhatsApp</span>
                        </label>
                        <input type="tel"
                               id="modal-whatsapp"
                               wire:model.blur="whatsapp"
                               placeholder="+55 (11) 99999-9999"
                               class="welcome-form-input disabled:opacity-50"
                               disabled>
                        <p id="whatsapp-error" class="welcome-form-error hidden mt-1">Informe um WhatsApp válido</p>
                    </div>

                    <div>
                        <label for="modal-email" class="welcome-form-label">
                            E-mail <span class="welcome-form-hint">(opcional)</span>
                        </label>
                        <label class="welcome-form-consent-row">
                            <input type="checkbox"
                                   id="modal-email-consent"
                                   class="welcome-form-checkbox">
                            <span class="welcome-form-consent-label">Quero receber minha oração por e-mail</span>
                        </label>
                        <input type="email"
                               id="modal-email"
                               wire:model="email"
                               placeholder="seu@email.com"
                               inputmode="email"
                               autocomplete="email"
                               class="welcome-form-input disabled:cursor-not-allowed disabled:opacity-60"
                               maxlength="255"
                               disabled>
                        <p id="email-error" class="welcome-form-error hidden mt-1">E-mail inválido</p>
                    </div>

                    <div class="welcome-modal-info-box">
                        <p class="welcome-modal-info-text">
                            <strong class="text-brand-ink">Informações de contato</strong>
                            Escolha ao menos um meio para receber sua oração. Sem obrigação de se identificar.
                        </p>
                    </div>

                    <p id="contact-error" class="welcome-form-error hidden">
                        Informe pelo menos um meio de contato: WhatsApp ou e-mail.
                    </p>

                    <div class="welcome-modal-buttons">
                        <button type="button"
                                id="step-1-continue"
                                class="welcome-modal-btn bg-brand-primary">
                            Continuar
                        </button>
                        <button type="button"
                                onclick="document.getElementById('prayer-modal').close()"
                                class="welcome-modal-cancel">
                            Cancelar
                        </button>
                    </div>
                </div>

                {{-- Step 2: Prayer description, religion, prayer type --}}
                <div id="modal-step-2" class="welcome-form-row welcome-modal-step hidden">
                    <h3 class="welcome-step-heading">Seu pedido</h3>
                    <div>
                        <label for="modal-message" class="welcome-form-label">
                            Seu pedido de oração
                        </label>
                        <textarea id="modal-message"
                                  x-ref="message-input"
                                  rows="4"
                                  maxlength="2000"
                                  placeholder="Compartilhe pelo que você gostaria de orar..."
                                  class="welcome-form-input"></textarea>
                        <div class="welcome-char-count-row">
                            <span id="char-count" class="welcome-char-count">0 / 2000</span>
                            <p id="description-error" class="welcome-form-error hidden" x-ref="desc-error">O pedido de oração não pode estar vazio</p>
                            @error('message')
                                <p class="welcome-form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="modal-religion" class="welcome-form-label">
                            Religião
                        </label>
                        <select id="modal-religion"
                                wire:model="religion"
                                class="welcome-form-input">
                            <option value="catholic">Católica</option>
                            <option value="orthodox">Ortodoxa</option>
                            <option value="protestant">Protestante/Evangelica</option>
                            <option value="other">Outras</option>
                        </select>
                    </div>

                    <div>
                        <label for="modal-prayer-type" class="welcome-form-label">
                            Tipo de oração
                        </label>
                        <select id="modal-prayer-type"
                                wire:model="prayerType"
                                class="welcome-form-input">
                            <option value="ai">Oração por IA</option>
                            <option value="instant">Oração instantânea</option>
                            <option value="person-prayer-audio">Apenas oração (áudio)</option>
                            <option value="person-prayer-video">Apenas oração (vídeo)</option>
                            <option value="person-bible-audio">Apenas palavra (áudio)</option>
                            <option value="person-bible-video">Apenas palavra (vídeo)</option>
                            <option value="person-bible-prayer-audio">Oração + palavra (áudio)</option>
                            <option value="person-bible-prayer-video">Oração + palavra (vídeo)</option>
                        </select>
                    </div>

                    <div class="welcome-modal-info-box">
                        <p class="welcome-modal-info-text">
                            <strong class="text-brand-ink">Oração para:</strong>
                            <span id="step-2-name-display" class="text-brand-ink/85"></span>
                        </p>
                    </div>

                    <div class="welcome-modal-buttons">
                        <button type="button"
                                id="step-2-back"
                                class="welcome-modal-cancel">
                            Voltar
                        </button>
                        <button type="button"
                                id="submit-btn"
                                x-on:click="
                                    $wire.message = $refs['message-input'].value;
                                    if (!$wire.message.trim()) {
                                        $refs['desc-error'].classList.remove('hidden');
                                    } else {
                                        $refs['desc-error'].classList.add('hidden');
                                        $wire.submit();
                                    }
                                "
                                wire:loading.attr="disabled"
                                class="welcome-modal-btn bg-brand-primary disabled:cursor-not-allowed disabled:opacity-60">
                            <span wire:loading.remove wire:target="submit">Enviar pedido de oração</span>
                            <span wire:loading wire:target="submit">
                                <svg class="inline h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                </svg>
                                Enviando...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>

    @vite(['resources/js/welcome.ts', 'resources/css/welcome.css'])
</div>
