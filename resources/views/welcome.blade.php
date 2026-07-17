<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rogai Conosco — A safe place to ask for prayer anonymously. Someone is praying for you.">
    <title>Rogai Conosco — Someone is praying for you</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body>

{{-- Splash intro --}}
<div id="splash" aria-hidden="true">
    <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="splash-logo">
    <span class="splash-line">Rogai</span>
    <span class="splash-line splash-line-2">Conosco</span>
</div>

<div id="page">

    {{-- Desktop sidebar --}}
    <aside class="sidebar" aria-label="Main navigation">
        <a href="/" class="welcome-brand-link">
            <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="welcome-brand-logo">
            <span class="welcome-brand-text">Rogai Conosco</span>
        </a>
        <nav class="welcome-nav-column">
            <a href="#hero" class="welcome-sidebar-link">Inicio</a>
            <a href="#about" class="welcome-sidebar-link">Sobre</a>
            <a href="#delivery" class="welcome-sidebar-link">Como funciona</a>
            <a href="#opensource" class="welcome-sidebar-link">Open Source</a>
            <button type="button"
                    onclick="document.getElementById('prayer-modal').showModal()"
                    class="welcome-sidebar-btn">
                Pedido de oração
            </button>
        </nav>
        <div class="mt-auto">
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
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
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
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                        <line x1="6" y1="6" x2="18" y2="18"/>
                        <line x1="18" y1="6" x2="6" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="welcome-mobile-nav-links">
                <a href="#hero" class="nav-link welcome-mobile-nav-link">Inicio</a>
                <a href="#about" class="nav-link welcome-mobile-nav-link">Sobre</a>
                <a href="#delivery" class="nav-link welcome-mobile-nav-link">Como funciona</a>
                <a href="#opensource" class="nav-link welcome-mobile-nav-link">Open Source</a>
                <button type="button"
                        class="nav-link welcome-mobile-nav-btn"
                        onclick="document.getElementById('prayer-modal').showModal(); closeMobileNav();">
                    Pedido de oração
                </button>
            </div>
            <div class="mt-auto">
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
                <p class="welcome-hero-subtitle">
                    Oração anônima de pessoas reais, não de robôs.
                    <br class="hidden sm:inline">
                    Grátis. Privado. Para todos.
                </p>
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
                            Cada pedido é recebido com dignidade, respeito e oração real de uma pessoa real —
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
                    <div class="mt-10 flex flex-wrap gap-6">
                        <div class="welcome-feature-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                <path d="M12 21.35C10.55 20.25 5 16 5 11.5 5 8.5 7.5 6 10.5 6c1.5 0 2.85.67 3.75 1.71C15.15 6.67 16.5 6 18 6 21 6 23.5 8.5 23.5 11.5c0 4.5-5.55 8.75-7 9.85L19.5 19 12 21.35Z"/>
                            </svg>
                            <span>Grátis e sempre será</span>
                        </div>
                        <div class="welcome-feature-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <span>Privado e anônimo</span>
                        </div>
                        <div class="welcome-feature-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
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
                    <p class="mt-4 text-lg leading-relaxed text-brand-muted">
                        Três formas de receber oração. Escolha a que melhor se encaixa para você.
                    </p>
                </div>
                <div class="reveal mt-16 flex flex-col gap-12 sm:gap-0">
                    {{-- Step 1 --}}
                    <div class="welcome-step">
                        <div class="welcome-step-divider">
                            <span class="welcome-step-number bg-brand-primary">1</span>
                            <div class="welcome-step-connector bg-brand-primary/30"></div>
                        </div>
                        <div class="welcome-step-body sm:bg-brand-primary-light">
                            <span class="welcome-step-number-sm bg-brand-primary">1</span>
                            <div class="flex-1">
                                <h3 class="welcome-step-title">Oração gravada</h3>
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
                            <div class="flex-1">
                                <h3 class="welcome-step-title">Oração instantânea</h3>
                                <p class="welcome-step-text">
                                    Orações bíblicas pré-escritas que você pode ler ou receber imediatamente. Baseadas nas Escrituras e prontas quando você precisar.
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
                            <div class="flex-1">
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

        {{-- Comunidade Open Source --}}
        <section id="opensource" class="bg-brand-primary-light welcome-section">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mx-auto max-w-measure text-center">
                    <h2 class="welcome-section-heading">
                        Comunidade Open Source
                    </h2>
                    <p class="mt-6 text-lg leading-relaxed text-brand-ink/80">
                        Este projeto é <strong>código aberto</strong>. Acreditamos que a oração deve ser acessível a todos,
                        e o código também.
                    </p>
                    <div class="mt-10 grid gap-8 text-left sm:grid-cols-2">
                        <div class="welcome-card group">
                            <div class="welcome-flex-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-primary">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 5.77 5.07 5.07 0 0 0 19.91 3S18.73.65 15 2.48a13.38 13.38 0 0 0-7 0C4.27.65 3.09 3 3.09 3A5.07 5.07 0 0 0 3 5.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 7 19.13V22"/>
                                </svg>
                                <h3 class="welcome-card-title">Código aberto</h3>
                            </div>
                            <p class="welcome-card-text">
                                Todo o código-fonte está disponível publicamente. Você pode auditá-lo,
                                modificá-lo e sugerir melhorias. Transparência não é apenas um valor —
                                é uma prática.
                            </p>
                        </div>
                        <div class="welcome-card group">
                            <div class="welcome-flex-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="welcome-svg-icon text-brand-accent">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                                <h3 class="welcome-card-title">Contribua</h3>
                            </div>
                            <p class="welcome-card-text">
                                Desenvolvedores, designers, tradutores — todos são bem-vindos.
                                O projeto está sempre aberto a novos contribuidores que queiram
                                ajudar a levar oração a mais pessoas.
                            </p>
                        </div>
                    </div>
                    <div class="mt-10">
                        <a href="https://github.com/anomalyco/rogai_conosco"
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
    <footer class="main-content border-t border-brand-primary/20 px-6 py-16 sm:px-8">
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col items-center gap-6 text-center sm:flex-row sm:justify-between sm:text-left">
                <div>
                    <p class="font-serif text-base text-brand-ink">Rogai Conosco</p>
                    <p class="mt-1 text-sm text-brand-muted">Alguém está orando por você.</p>
                </div>
                <div class="flex flex-col items-center gap-2 sm:items-end">
                    <p class="text-sm text-brand-muted">
                        Grátis &middot; Privado &middot; Sustentado por doações
                    </p>
                    <a href="/doar" class="welcome-footer-link">
                        Apoie esta missão
                    </a>
                </div>
            </div>
            <div class="mt-12 border-t border-brand-primary/10 pt-6 text-center">
                <p class="text-xs text-brand-muted/70">
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
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                <line x1="6" y1="6" x2="18" y2="18"/>
                <line x1="18" y1="6" x2="6" y2="18"/>
            </svg>
        </button>

        <h2 id="modal-title" class="welcome-modal-title">Pedir oração</h2>
        <p class="welcome-modal-subtitle">Compartilhe o que está no seu coração. Não precisa de cadastro.</p>

        @if (session('success'))
            <div class="welcome-modal-success">
                <p class="font-serif text-lg text-brand-accent">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ url('/prayer-request') }}" class="mt-8" id="prayer-form">
            @csrf

            <div class="welcome-form-row">
                <div>
                    <label for="modal-name" class="welcome-form-label">
                        Seu nome <span class="welcome-form-hint">(opcional)</span>
                    </label>
                    <input type="text"
                           id="modal-name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ou deixe em branco para anônimo"
                           class="welcome-form-input">
                </div>

                <div>
                    <label for="modal-message" class="welcome-form-label">
                        Seu pedido de oração
                    </label>
                    <textarea id="modal-message"
                              name="message"
                              rows="4"
                              required
                              maxlength="2000"
                              placeholder="Compartilhe pelo que você gostaria de orar..."
                              class="welcome-form-input">{{ old('message') }}</textarea>
                    <div class="mt-1 flex items-center justify-between">
                        <span id="char-count" class="welcome-char-count">0 / 2000</span>
                        @error('message')
                            <p class="welcome-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="modal-delivery" class="welcome-form-label">
                        Como você gostaria de receber sua oração?
                    </label>
                    <select id="modal-delivery"
                            name="delivery"
                            required
                            class="welcome-form-input">
                        <option value="recorded" {{ old('delivery') === 'recorded' ? 'selected' : '' }}>Oração gravada (áudio/vídeo, 24-48h)</option>
                        <option value="instant" {{ old('delivery') === 'instant' ? 'selected' : '' }}>Oração instantânea</option>
                        <option value="ai" {{ old('delivery') === 'ai' ? 'selected' : '' }}>Oração por IA</option>
                    </select>
                </div>

                <div id="modal-contact-fields" class="welcome-contact-fields">
                    <div>
                        <label for="modal-email" class="welcome-form-label">
                            E-mail <span class="welcome-form-hint">(para entrega da oração gravada)</span>
                        </label>
                        <input type="email"
                               id="modal-email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="seu@email.com"
                               class="welcome-form-input">
                    </div>
                    <div>
                        <label for="modal-whatsapp" class="welcome-form-label">
                            WhatsApp <span class="welcome-form-hint">(opcional)</span>
                        </label>
                        <input type="tel"
                               id="modal-whatsapp"
                               name="whatsapp"
                               value="{{ old('whatsapp') }}"
                               placeholder="+55 (11) 99999-9999"
                               class="welcome-form-input">
                    </div>
                </div>

                <div class="welcome-modal-info-box">
                    <p class="welcome-modal-info-text">
                        <strong class="text-brand-ink">O que acontece depois?</strong>
                        Seu pedido é recebido por uma pessoa real de fé que orará por você com sinceridade.
                        Você receberá a oração no formato escolhido — sem julgamento, sem rastreamento, sem custo.
                    </p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            id="submit-btn"
                            class="welcome-modal-btn bg-brand-accent disabled:cursor-not-allowed disabled:opacity-60">
                        <span id="submit-text">Enviar pedido de oração</span>
                        <span id="submit-spinner" class="hidden">
                            <svg class="inline h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Enviando...
                        </span>
                    </button>
                    <button type="button"
                            onclick="document.getElementById('prayer-modal').close()"
                            class="welcome-modal-cancel">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</dialog>

@vite(['resources/js/welcome.js', 'resources/css/welcome.css'])

</body>
</html>
