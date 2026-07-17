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
        <a href="/" class="flex items-center gap-3 no-underline transition-opacity duration-150 hover:opacity-70">
            <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="h-10 w-10 rounded-full object-contain">
            <span class="font-serif text-xl text-brand-primary">Rogai Conosco</span>
        </a>
        <nav class="mt-12 flex flex-col gap-6">
            <a href="#hero" class="font-serif text-lg text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">
                Inicio
            </a>
            <a href="#about" class="font-serif text-lg text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">
                Sobre
            </a>
            <a href="#delivery" class="font-serif text-lg text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">
                Como funciona
            </a>
            <a href="#opensource" class="font-serif text-lg text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">
                Open Source
            </a>
            <button type="button"
                    onclick="document.getElementById('prayer-modal').showModal()"
                    class="mt-4 self-start rounded border border-brand-accent px-5 py-2 text-sm font-medium text-brand-accent no-underline transition-colors duration-150 hover:bg-brand-accent-light">
                Pedido de oração
            </button>
        </nav>
        <div class="mt-auto">
            <p class="text-sm text-brand-muted">Feito com fé. Sustentado por doações.</p>
        </div>
    </aside>

    {{-- Mobile header --}}
    <header class="fixed top-0 left-0 right-0 z-sticky bg-[#f0f0d8]/90 backdrop-blur-sm md:hidden">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4 sm:px-8">
            <a href="/" class="flex items-center gap-2 no-underline transition-opacity duration-150 hover:opacity-70">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="h-7 w-7 rounded-full object-contain">
                <span class="font-serif text-lg text-brand-primary">Rogai <br />Conosco</span>
            </a>
            <button id="menu-btn"
                    class="relative flex h-10 w-10 items-center justify-center text-brand-ink transition-colors duration-150 hover:text-brand-primary"
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
        <div class="flex h-full flex-col px-8 py-6">
            <div class="flex justify-end">
                <button id="close-nav-btn"
                        class="flex h-10 w-10 items-center justify-center text-brand-ink transition-colors duration-150 hover:text-brand-primary"
                        aria-label="Close menu"
                        type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                        <line x1="6" y1="6" x2="18" y2="18"/>
                        <line x1="18" y1="6" x2="6" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="mt-12 flex flex-col gap-8">
                <a href="#hero" class="nav-link font-serif text-2xl text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">Inicio</a>
                <a href="#about" class="nav-link font-serif text-2xl text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">Sobre</a>
                <a href="#delivery" class="nav-link font-serif text-2xl text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">Como funciona</a>
                <a href="#opensource" class="nav-link font-serif text-2xl text-brand-ink no-underline transition-colors duration-150 hover:text-brand-primary">Open Source</a>
                <button type="button"
                        class="nav-link mt-4 self-start rounded border border-brand-accent px-5 py-2 text-base font-medium text-brand-accent transition-colors duration-150 hover:bg-brand-accent-light"
                        onclick="document.getElementById('prayer-modal').showModal(); closeMobileNav();">
                    Pedido de oração
                </button>
            </div>
            <div class="mt-auto">
                <p class="text-sm text-brand-muted">Feito com fé. Sustentado por doações.</p>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="main-content">

        {{-- Hero --}}
        <section id="hero" class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-6 pt-24 pb-16 text-center sm:px-8">
            {{-- Background photo with gradient overlay --}}
            <div class="absolute inset-0 z-0" aria-hidden="true">
                <img src="https://images.unsplash.com/vector-1763972941999-0d38973175c5?q=80&w=1600&auto=format&fit=crop"
                     alt=""
                     class="h-full w-full object-cover"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-[rgba(28,28,20,0.85)] via-[rgba(125,138,90,0.35)] to-[rgba(28,28,20,0.5)]"></div>
            </div>

            <div class="hero-content reveal relative z-10 max-w-measure">
                <h1 class="text-balance font-serif text-[clamp(2.25rem,5vw,4.5rem)] leading-[1.1] tracking-[-0.02em] text-white">
                    Sua oração, carregada por alguém que se importa.
                </h1>
                <p class="mt-6 text-balance text-lg leading-relaxed text-white/80 sm:text-xl">
                    Oração anônima de pessoas reais, não de robôs.
                    <br class="hidden sm:inline">
                    Grátis. Privado. Para todos.
                </p>
                <div class="mt-10 flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <button type="button"
                            onclick="document.getElementById('prayer-modal').showModal()"
                            class="inline-block rounded-sm bg-brand-accent px-10 py-4 font-medium text-white no-underline transition-all duration-150 hover:bg-brand-accent/90 hover:shadow-lg">
                        Pedir oração
                    </button>
                    <a href="#about"
                       class="inline-block px-8 py-3 font-medium text-white/70 no-underline transition-colors duration-150 hover:text-white">
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
        <section id="about" class="bg-brand-primary-light px-6 py-24 sm:px-8 sm:py-32">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mx-auto max-w-measure">
                    <h2 class="text-balance font-serif text-[clamp(1.75rem,3vw,2.75rem)] leading-[1.2] text-brand-ink">
                        Um lugar seguro para pedir oração
                    </h2>
                    <div class="mt-8 space-y-5 text-base leading-relaxed text-brand-ink/85 sm:text-lg">
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
                        <div class="flex items-center gap-2 text-sm text-brand-muted">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                <path d="M12 21.35C10.55 20.25 5 16 5 11.5 5 8.5 7.5 6 10.5 6c1.5 0 2.85.67 3.75 1.71C15.15 6.67 16.5 6 18 6 21 6 23.5 8.5 23.5 11.5c0 4.5-5.55 8.75-7 9.85L19.5 19 12 21.35Z"/>
                            </svg>
                            <span>Grátis e sempre será</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-brand-muted">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <span>Privado e anônimo</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-brand-muted">
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
        <section id="delivery" class="bg-brand-surface px-6 py-24 sm:px-8 sm:py-32">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mx-auto max-w-measure text-center">
                    <h2 class="text-balance font-serif text-[clamp(1.75rem,3vw,2.75rem)] leading-[1.2] text-brand-ink">
                        Como sua oração chega até você
                    </h2>
                    <p class="mt-4 text-lg leading-relaxed text-brand-muted">
                        Três formas de receber oração. Escolha a que melhor se encaixa para você.
                    </p>
                </div>
                <div class="reveal mt-16 flex flex-col gap-12 sm:gap-0">
                    {{-- Step 1 --}}
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:gap-12">
                        <div class="hidden sm:flex sm:w-16 sm:shrink-0 sm:flex-col sm:items-center">
                            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-primary font-serif text-xl font-medium text-white">1</span>
                            <div class="mt-2 h-24 w-px bg-brand-primary/30"></div>
                        </div>
                        <div class="sm:flex sm:flex-1 sm:items-center sm:gap-10 sm:rounded-sm sm:bg-brand-primary-light sm:p-10">
                            <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-brand-primary font-serif text-sm font-medium text-white sm:hidden">1</span>
                            <div class="flex-1">
                                <h3 class="font-serif text-xl text-brand-ink">Oração gravada</h3>
                                <p class="mt-2 text-sm leading-relaxed text-brand-muted">
                                    Uma oração real, gravada em áudio ou vídeo e entregue por WhatsApp ou e-mail em até 24&ndash;48 horas.
                                </p>
                            </div>
                            <div class="mt-4 shrink-0 sm:mt-0">
                                <span class="inline-block rounded-sm border border-brand-primary/30 px-4 py-1.5 text-xs text-brand-primary">48h</span>
                            </div>
                        </div>
                    </div>
                    {{-- Step 2 --}}
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-end sm:gap-12">
                        <div class="hidden sm:flex sm:w-16 sm:shrink-0 sm:flex-col sm:items-center sm:order-last">
                            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-accent font-serif text-xl font-medium text-white">2</span>
                            <div class="mt-2 h-24 w-px bg-brand-accent/30"></div>
                        </div>
                        <div class="sm:flex sm:flex-1 sm:max-w-xl sm:items-center sm:gap-10 sm:rounded-sm sm:bg-brand-accent-light sm:p-10">
                            <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-brand-accent font-serif text-sm font-medium text-white sm:hidden">2</span>
                            <div class="flex-1">
                                <h3 class="font-serif text-xl text-brand-ink">Oração instantânea</h3>
                                <p class="mt-2 text-sm leading-relaxed text-brand-muted">
                                    Orações bíblicas pré-escritas que você pode ler ou receber imediatamente. Baseadas nas Escrituras e prontas quando você precisar.
                                </p>
                            </div>
                            <div class="mt-4 shrink-0 sm:mt-0">
                                <span class="inline-block rounded-sm border border-brand-accent/30 px-4 py-1.5 text-xs text-brand-accent">Imediato</span>
                            </div>
                        </div>
                    </div>
                    {{-- Step 3 --}}
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:gap-12">
                        <div class="hidden sm:flex sm:w-16 sm:shrink-0 sm:flex-col sm:items-center">
                            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-ink font-serif text-xl font-medium text-white">3</span>
                        </div>
                        <div class="sm:flex sm:flex-1 sm:items-center sm:gap-10 sm:rounded-sm sm:bg-brand-ink/5 sm:p-10">
                            <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-brand-ink font-serif text-sm font-medium text-white sm:hidden">3</span>
                            <div class="flex-1">
                                <h3 class="font-serif text-xl text-brand-ink">Oração por IA</h3>
                                <p class="mt-2 text-sm leading-relaxed text-brand-muted">
                                    Uma oração personalizada, composta por inteligência artificial sob medida para o seu pedido. Gerada instantaneamente.
                                </p>
                            </div>
                            <div class="mt-4 shrink-0 sm:mt-0">
                                <span class="inline-block rounded-sm border border-brand-ink/20 px-4 py-1.5 text-xs text-brand-ink/70">Instantâneo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Comunidade Open Source --}}
        <section id="opensource" class="bg-brand-primary-light px-6 py-24 sm:px-8 sm:py-32">
            <div class="mx-auto max-w-6xl">
                <div class="reveal mx-auto max-w-measure text-center">
                    <h2 class="text-balance font-serif text-[clamp(1.75rem,3vw,2.75rem)] leading-[1.2] text-brand-ink">
                        Comunidade Open Source
                    </h2>
                    <p class="mt-6 text-lg leading-relaxed text-brand-ink/80">
                        Este projeto é <strong>código aberto</strong>. Acreditamos que a oração deve ser acessível a todos,
                        e o código também.
                    </p>
                    <div class="mt-10 grid gap-8 text-left sm:grid-cols-2">
                        <div class="group rounded-sm bg-white/80 p-8 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-brand-primary">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 5.77 5.07 5.07 0 0 0 19.91 3S18.73.65 15 2.48a13.38 13.38 0 0 0-7 0C4.27.65 3.09 3 3.09 3A5.07 5.07 0 0 0 3 5.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 7 19.13V22"/>
                                </svg>
                                <h3 class="font-serif text-lg text-brand-ink">Código aberto</h3>
                            </div>
                            <p class="mt-4 text-sm leading-relaxed text-brand-muted">
                                Todo o código-fonte está disponível publicamente. Você pode auditá-lo,
                                modificá-lo e sugerir melhorias. Transparência não é apenas um valor —
                                é uma prática.
                            </p>
                        </div>
                        <div class="group rounded-sm bg-white/80 p-8 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-brand-accent">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                                <h3 class="font-serif text-lg text-brand-ink">Contribua</h3>
                            </div>
                            <p class="mt-4 text-sm leading-relaxed text-brand-muted">
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
                           class="inline-block rounded-sm border border-brand-accent px-8 py-3 font-medium text-brand-accent no-underline transition-all duration-150 hover:bg-brand-accent hover:text-white">
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
                    <a href="/doar"
                       class="text-sm text-brand-primary no-underline transition-colors duration-150 hover:text-brand-accent">
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
                class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center text-brand-muted transition-colors duration-150 hover:text-brand-ink"
                aria-label="Close">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                <line x1="6" y1="6" x2="18" y2="18"/>
                <line x1="18" y1="6" x2="6" y2="18"/>
            </svg>
        </button>

        <h2 id="modal-title" class="text-balance font-serif text-2xl text-brand-ink">Pedir oração</h2>
        <p class="mt-2 text-sm text-brand-muted">Compartilhe o que está no seu coração. Não precisa de cadastro.</p>

        @if (session('success'))
            <div class="mt-6 rounded-sm bg-brand-accent-light p-6 text-center">
                <p class="font-serif text-lg text-brand-accent">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ url('/prayer-request') }}" class="mt-8" id="prayer-form">
            @csrf

            <div class="space-y-5">
                <div>
                    <label for="modal-name" class="block text-sm font-medium text-brand-ink">
                        Seu nome <span class="text-brand-muted">(opcional)</span>
                    </label>
                    <input type="text"
                           id="modal-name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ou deixe em branco para anônimo"
                           class="mt-2 block w-full rounded-sm border-brand-primary/30 bg-white px-4 py-3 text-brand-ink placeholder:text-brand-muted/60 focus:border-brand-accent focus:ring-1 focus:ring-brand-accent">
                </div>

                <div>
                    <label for="modal-message" class="block text-sm font-medium text-brand-ink">
                        Seu pedido de oração
                    </label>
                    <textarea id="modal-message"
                              name="message"
                              rows="4"
                              required
                              maxlength="2000"
                              placeholder="Compartilhe pelo que você gostaria de orar..."
                              class="mt-2 block w-full rounded-sm border-brand-primary/30 bg-white px-4 py-3 text-brand-ink placeholder:text-brand-muted/60 focus:border-brand-accent focus:ring-1 focus:ring-brand-accent">{{ old('message') }}</textarea>
                    <div class="mt-1 flex items-center justify-between">
                        <span id="char-count" class="text-xs text-brand-muted/60">0 / 2000</span>
                        @error('message')
                            <p class="text-sm text-brand-accent">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="modal-delivery" class="block text-sm font-medium text-brand-ink">
                        Como você gostaria de receber sua oração?
                    </label>
                    <select id="modal-delivery"
                            name="delivery"
                            required
                            class="mt-2 block w-full rounded-sm border-brand-primary/30 bg-white px-4 py-3 text-brand-ink focus:border-brand-accent focus:ring-1 focus:ring-brand-accent">
                        <option value="recorded" {{ old('delivery') === 'recorded' ? 'selected' : '' }}>Oração gravada (áudio/vídeo, 24-48h)</option>
                        <option value="instant" {{ old('delivery') === 'instant' ? 'selected' : '' }}>Oração instantânea</option>
                        <option value="ai" {{ old('delivery') === 'ai' ? 'selected' : '' }}>Oração por IA</option>
                    </select>
                </div>

                <div id="modal-contact-fields" class="hidden space-y-5">
                    <div>
                        <label for="modal-email" class="block text-sm font-medium text-brand-ink">
                            E-mail <span class="text-brand-muted">(para entrega da oração gravada)</span>
                        </label>
                        <input type="email"
                               id="modal-email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="seu@email.com"
                               class="mt-2 block w-full rounded-sm border-brand-primary/30 bg-white px-4 py-3 text-brand-ink placeholder:text-brand-muted/60 focus:border-brand-accent focus:ring-1 focus:ring-brand-accent">
                    </div>
                    <div>
                        <label for="modal-whatsapp" class="block text-sm font-medium text-brand-ink">
                            WhatsApp <span class="text-brand-muted">(opcional)</span>
                        </label>
                        <input type="tel"
                               id="modal-whatsapp"
                               name="whatsapp"
                               value="{{ old('whatsapp') }}"
                               placeholder="+55 (11) 99999-9999"
                               class="mt-2 block w-full rounded-sm border-brand-primary/30 bg-white px-4 py-3 text-brand-ink placeholder:text-brand-muted/60 focus:border-brand-accent focus:ring-1 focus:ring-brand-accent">
                    </div>
                </div>

                <div class="rounded-sm bg-brand-primary-light/60 p-5">
                    <p class="text-sm leading-relaxed text-brand-ink/75">
                        <strong class="text-brand-ink">O que acontece depois?</strong>
                        Seu pedido é recebido por uma pessoa real de fé que orará por você com sinceridade.
                        Você receberá a oração no formato escolhido — sem julgamento, sem rastreamento, sem custo.
                    </p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            id="submit-btn"
                            class="flex-1 rounded-sm bg-brand-accent px-6 py-3 font-medium text-white transition-all duration-150 hover:bg-brand-accent/90 hover:shadow-md disabled:cursor-not-allowed disabled:opacity-60">
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
                            class="rounded-sm border border-brand-primary/30 bg-white px-6 py-3 font-medium text-brand-muted transition-all duration-150 hover:bg-brand-primary-light hover:text-brand-ink">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var splash = document.getElementById('splash');
        var page = document.getElementById('page');
        var menuBtn = document.getElementById('menu-btn');
        var closeNavBtn = document.getElementById('close-nav-btn');
        var sideNav = document.getElementById('side-nav');
        var navOverlay = document.getElementById('nav-overlay');
        var navLinks = document.querySelectorAll('.nav-link');
        var modal = document.getElementById('prayer-modal');
        var modalDelivery = document.getElementById('modal-delivery');
        var modalContactFields = document.getElementById('modal-contact-fields');

        function toggleMobileNav(open) {
            if (!sideNav || !navOverlay) return;
            sideNav.classList.toggle('open', open);
            navOverlay.classList.toggle('open', open);
            if (menuBtn) menuBtn.setAttribute('aria-expanded', open);
            document.body.style.overflow = open ? 'hidden' : '';
        }

        function closeMobileNav() { toggleMobileNav(false); }
        window.closeMobileNav = closeMobileNav;

        if (menuBtn) {
            menuBtn.addEventListener('click', function () { toggleMobileNav(true); });
        }
        if (closeNavBtn) closeNavBtn.addEventListener('click', closeMobileNav);
        if (navOverlay) navOverlay.addEventListener('click', closeMobileNav);

        navLinks.forEach(function (link) {
            link.addEventListener('click', closeMobileNav);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sideNav && sideNav.classList.contains('open')) {
                closeMobileNav();
            }
        });

        function showContactFields() {
            if (modalContactFields && modalDelivery) {
                modalContactFields.classList.toggle('hidden', modalDelivery.value !== 'recorded');
            }
        }

        if (modalDelivery && modalContactFields) {
            modalDelivery.addEventListener('change', showContactFields);
            showContactFields();
        }

        if (modal) {
            modal.addEventListener('click', function (e) {
                var rect = modal.querySelector('.modal-content').getBoundingClientRect();
                var isInDialog = rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                    rect.left <= e.clientX && e.clientX <= rect.left + rect.width;
                if (!isInDialog) modal.close();
            });
            modal.addEventListener('close', function () {
                document.body.style.overflow = '';
            });
            modal.addEventListener('open', function () {
                document.body.style.overflow = 'hidden';
            });
        }

        setTimeout(function () {
            if (splash) {
                splash.classList.add('splash-hide');
                setTimeout(function () {
                    splash.style.display = 'none';
                    page.classList.add('page-show');
                    initRevealObserver();
                }, 400);
            } else {
                page.classList.add('page-show');
                initRevealObserver();
            }
        }, 800);

        function initRevealObserver() {
            var reveals = document.querySelectorAll('.reveal');
            if (!('IntersectionObserver' in window)) {
                reveals.forEach(function (el) { el.classList.add('visible'); });
                return;
            }
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
            reveals.forEach(function (el) { observer.observe(el); });
        }

        var prayerForm = document.getElementById('prayer-form');
        var submitBtn = document.getElementById('submit-btn');
        var submitText = document.getElementById('submit-text');
        var submitSpinner = document.getElementById('submit-spinner');
        var textarea = document.getElementById('modal-message');
        var charCount = document.getElementById('char-count');

        if (prayerForm && submitBtn) {
            prayerForm.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                submitSpinner.classList.remove('hidden');
            });
        }

        if (textarea && charCount) {
            textarea.addEventListener('input', function () {
                charCount.textContent = textarea.value.length + ' / 2000';
            });
        }

        function initScrollSpy() {
            var sections = document.querySelectorAll('section[id]');
            var sidebarLinks = document.querySelectorAll('.sidebar a[href^="#"]');

            if (!sections.length || !sidebarLinks.length) return;

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var id = entry.target.getAttribute('id');
                        sidebarLinks.forEach(function (link) {
                            var href = link.getAttribute('href');
                            link.classList.toggle('nav-link-active', href === '#' + id);
                        });
                    }
                });
            }, { threshold: 0.2, rootMargin: '-80px 0px -40% 0px' });

            sections.forEach(function (section) { observer.observe(section); });
        }

        if (document.querySelector('.sidebar')) {
            initScrollSpy();
        }
    });
</script>

@vite('resources/js/app.js')

</body>
</html>
