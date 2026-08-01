<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Apoie a missão do Rogai Conosco com uma doação. Cada contribuição ajuda a manter a oração gratuita e acessível.">

    <meta property="og:title" content="Doar — Rogai Conosco">
    <meta property="og:description" content="Apoie a missão do Rogai Conosco com uma doação.">
    <meta property="og:image" content="{{ asset('images/ovelhinha.png') }}">
    <meta property="og:type" content="website">

    <title>Doar — Rogai Conosco</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/donate.css'])
</head>
<body class="donate-page">

    {{-- Header --}}
    <header class="donate-header">
        <div class="donate-header-inner">
            <a href="/" class="donate-brand-link">
                <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="donate-brand-logo">
                <span class="donate-brand-text">Rogai Conosco</span>
            </a>
        </div>
        <a href="/" class="donate-back-link">&larr; Voltar</a>
    </header>

    <main class="donate-main">

        {{-- Hero / Banner --}}
        <section class="donate-hero donate-reveal">
            <div class="donate-hero-inner">
                <p class="donate-kicker">Sustentado por doações</p>
                <h1 class="donate-heading">Sua generosidade mantém a oração acessível</h1>
                <p class="donate-subline">Cada doação ajuda alguém a receber oração — gratuitamente, sem cadastro, sem julgamento.</p>
            </div>
        </section>

        {{-- Amount selector --}}
        <section class="donate-offering donate-reveal">
            <div class="donate-offering-header">
                <h2 class="donate-section-heading">Escolha um valor</h2>
                <p class="donate-section-hint">clique em um valor ou digite um valor personalizado</p>
            </div>

            {{-- Mobile: horizontal scroll --}}
            <div class="donate-scroll-area md:hidden">
                <div class="donate-scroll-track" id="donate-scroll-track">
                    <button class="donate-amount-card" data-amount="1" aria-pressed="false">
                        <div class="donate-amount-icon-candle">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l0 10"/><path d="M9 22l0-8a3 3 0 0 1 6 0l0 8z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;1</div>
                        <div class="donate-amount-label">uma oração</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="2" aria-pressed="false">
                        <div class="donate-amount-icon-heart">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;2</div>
                        <div class="donate-amount-label">um gesto de fé</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="5" aria-pressed="false">
                        <div class="donate-amount-icon-cup">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;5</div>
                        <div class="donate-amount-label">um café com oração</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="10" aria-pressed="false">
                        <div class="donate-amount-icon-bread">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 9a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5z"/><path d="M7 14v7"/><path d="M17 14v7"/><path d="M12 14v7"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;10</div>
                        <div class="donate-amount-label">um lanche abençoado</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="20" aria-pressed="false">
                        <div class="donate-amount-icon-book">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;20</div>
                        <div class="donate-amount-label">um livro de orações</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="50" aria-pressed="false">
                        <div class="donate-amount-icon-home">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;50</div>
                        <div class="donate-amount-label">acolhida para muitos</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="100" aria-pressed="false">
                        <div class="donate-amount-icon-community">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;100</div>
                        <div class="donate-amount-label">uma comunidade orando</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="200" aria-pressed="false">
                        <div class="donate-amount-icon-globe">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;200</div>
                        <div class="donate-amount-label">oração sem fronteiras</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="400" aria-pressed="false">
                        <div class="donate-amount-icon-stars">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;400</div>
                        <div class="donate-amount-label">código aberto sustentado</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="500" aria-pressed="false">
                        <div class="donate-amount-icon-leaf">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;500</div>
                        <div class="donate-amount-label">mês de orações entregues</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="1000" aria-pressed="false">
                        <div class="donate-amount-icon-dove">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 21c.5-4.5 2-8 7-10"/><path d="M9 3c1 2 2 3 4 4"/><path d="M14 10c2 1 6 3 6 5 0 3-3 3.5-6 3-1.5 0-3-.5-4.5-1"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;1.000</div>
                        <div class="donate-amount-label">um ano de graça</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                </div>

                {{-- Scroll indicators --}}
                <button class="donate-scroll-btn donate-scroll-left" id="scroll-left" aria-label="Rolar para esquerda" hidden>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <button class="donate-scroll-btn donate-scroll-right" id="scroll-right" aria-label="Rolar para direita">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

            {{-- Desktop: tiered rows --}}
            <div class="donate-tiers hidden md:block">
                <div class="donate-tier-row">
                    <button class="donate-amount-card" data-amount="1" aria-pressed="false">
                        <div class="donate-amount-icon-candle">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l0 10"/><path d="M9 22l0-8a3 3 0 0 1 6 0l0 8z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;1</div>
                        <div class="donate-amount-label">uma oração</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="2" aria-pressed="false">
                        <div class="donate-amount-icon-heart">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;2</div>
                        <div class="donate-amount-label">um gesto de fé</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="5" aria-pressed="false">
                        <div class="donate-amount-icon-cup">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;5</div>
                        <div class="donate-amount-label">um café com oração</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                </div>
                <div class="donate-tier-row">
                    <button class="donate-amount-card" data-amount="10" aria-pressed="false">
                        <div class="donate-amount-icon-bread">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 9a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5z"/><path d="M7 14v7"/><path d="M17 14v7"/><path d="M12 14v7"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;10</div>
                        <div class="donate-amount-label">um lanche abençoado</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="20" aria-pressed="false">
                        <div class="donate-amount-icon-book">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;20</div>
                        <div class="donate-amount-label">um livro de orações</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="50" aria-pressed="false">
                        <div class="donate-amount-icon-home">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;50</div>
                        <div class="donate-amount-label">acolhida para muitos</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                </div>
                <div class="donate-tier-row">
                    <button class="donate-amount-card" data-amount="100" aria-pressed="false">
                        <div class="donate-amount-icon-community">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;100</div>
                        <div class="donate-amount-label">uma comunidade orando</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="200" aria-pressed="false">
                        <div class="donate-amount-icon-globe">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;200</div>
                        <div class="donate-amount-label">oração sem fronteiras</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="400" aria-pressed="false">
                        <div class="donate-amount-icon-stars">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;400</div>
                        <div class="donate-amount-label">código aberto sustentado</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                </div>
                <div class="donate-tier-row">
                    <button class="donate-amount-card" data-amount="500" aria-pressed="false">
                        <div class="donate-amount-icon-leaf">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2z"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;500</div>
                        <div class="donate-amount-label">mês de orações entregues</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                    <button class="donate-amount-card" data-amount="1000" aria-pressed="false">
                        <div class="donate-amount-icon-dove">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 21c.5-4.5 2-8 7-10"/><path d="M9 3c1 2 2 3 4 4"/><path d="M14 10c2 1 6 3 6 5 0 3-3 3.5-6 3-1.5 0-3-.5-4.5-1"/></svg>
                        </div>
                        <div class="donate-amount-value">R$&nbsp;1.000</div>
                        <div class="donate-amount-label">um ano de graça</div>
                        <div class="donate-amount-check">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5l10 -10"/></svg>
                        </div>
                    </button>
                </div>
            </div>

            {{-- Custom amount --}}
            <div class="donate-custom-row">
                <div class="donate-custom-input-wrap">
                    <span class="donate-custom-prefix">R$</span>
                    <input type="number"
                           id="custom-amount"
                           class="donate-custom-input"
                           min="1"
                           step="1"
                           placeholder="Outro valor"
                           aria-label="Valor personalizado">
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="donate-cta donate-reveal">
            <button id="donate-submit" class="donate-cta-btn" disabled aria-label="Confirmar doação">
                Escolha um valor acima
            </button>
            <p class="donate-cta-note">Nenhum gateway de pagamento ativo ainda. Esta página é um compromisso visual com a missão.</p>
        </section>

        {{-- Mission statement --}}
        <section class="donate-mission donate-reveal">
            <div class="donate-mission-inner">
                <h2 class="donate-section-heading">Por que sua doação importa</h2>
                <p class="donate-mission-text">
                    Rogai Conosco existe para que ninguém precise enfrentar suas lutas sozinho.
                    Cada pedido é recebido com dignidade e recebe oração real de uma pessoa real.
                </p>
                <p class="donate-mission-text">
                    O projeto é sustentado inteiramente por doações. Tudo o que recebemos é usado
                    para manter este serviço gratuito e expandir nosso alcance.
                </p>
                <ul class="donate-promises">
                    <li class="donate-promise">
                        <span class="donate-promise-dot"></span>
                        Sem anúncios, agora e sempre
                    </li>
                    <li class="donate-promise">
                        <span class="donate-promise-dot"></span>
                        Seus dados nunca são vendidos
                    </li>
                    <li class="donate-promise">
                        <span class="donate-promise-dot"></span>
                        Cada oração é entregue por uma pessoa real
                    </li>
                    <li class="donate-promise">
                        <span class="donate-promise-dot"></span>
                        Código aberto e transparente
                    </li>
                </ul>
            </div>
        </section>

        {{-- Share section --}}
        <section class="donate-share donate-reveal">
            <h2 class="donate-share-heading">Compartilhe com alguém</h2>
            <p class="donate-share-text">
                Se você não pode doar agora, compartilhar o Rogai Conosco com alguém que precisa
                de oração já é um ato de amor.
            </p>
            <div class="donate-share-row">
                <button class="donate-share-btn" id="share-copy-btn" aria-label="Copiar link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    <span id="share-copy-text">Copiar link</span>
                </button>
                <span class="donate-share-feedback" id="share-feedback" hidden>Copiado!</span>
            </div>
        </section>

    </main>

    {{-- Footer --}}
    <footer class="donate-footer">
        <div class="donate-footer-inner">
            <div>
                <p class="donate-footer-brand">Rogai Conosco</p>
                <p class="donate-footer-tagline">Alguém está orando por você.</p>
            </div>
            <div class="donate-footer-side">
                <p class="donate-footer-mission">Grátis &middot; Privado &middot; Sustentado por doações</p>
                <a href="/" class="donate-footer-link">Voltar ao início</a>
            </div>
        </div>
        <p class="donate-footer-copyright">Rogai Conosco &copy; {{ date('Y') }}. Feito com fé.</p>
    </footer>

    <script>
        (function () {
            const track = document.getElementById('donate-scroll-track');
            const leftBtn = document.getElementById('scroll-left');
            const rightBtn = document.getElementById('scroll-right');
            const cards = document.querySelectorAll('.donate-amount-card');
            const customInput = document.getElementById('custom-amount');
            const submitBtn = document.getElementById('donate-submit');
            const shareCopyBtn = document.getElementById('share-copy-btn');
            const shareCopyText = document.getElementById('share-copy-text');
            const shareFeedback = document.getElementById('share-feedback');

            let selectedAmount = null;

            function updateScrollButtons() {
                if (!track) return;
                leftBtn.hidden = track.scrollLeft <= 8;
                rightBtn.hidden = track.scrollLeft + track.clientWidth >= track.scrollWidth - 8;
            }

            if (track) {
                leftBtn.addEventListener('click', () => {
                    track.scrollBy({ left: -200, behavior: 'smooth' });
                });
                rightBtn.addEventListener('click', () => {
                    track.scrollBy({ left: 200, behavior: 'smooth' });
                });
                track.addEventListener('scroll', updateScrollButtons, { passive: true });
                updateScrollButtons();
            }

            function selectAmount(amount, card) {
                cards.forEach(c => c.setAttribute('aria-pressed', 'false'));
                if (card) card.setAttribute('aria-pressed', 'true');
                selectedAmount = amount;
                customInput.value = '';
                updateSubmit();
            }

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    selectAmount(Number(card.dataset.amount), card);
                });
            });

            customInput.addEventListener('input', () => {
                const v = Number(customInput.value);
                if (v > 0) {
                    cards.forEach(c => c.setAttribute('aria-pressed', 'false'));
                    selectedAmount = v;
                } else {
                    selectedAmount = null;
                }
                updateSubmit();
            });

            function updateSubmit() {
                if (selectedAmount && selectedAmount > 0) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = `Doar R$ ${selectedAmount.toLocaleString('pt-BR')}`;
                } else {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Escolha um valor acima';
                }
            }

            shareCopyBtn.addEventListener('click', () => {
                navigator.clipboard.writeText(window.location.origin).then(() => {
                    shareCopyText.textContent = 'Copiado!';
                    shareFeedback.hidden = false;
                    setTimeout(() => {
                        shareCopyText.textContent = 'Copiar link';
                        shareFeedback.hidden = true;
                    }, 2000);
                });
            });

            // Reveal on scroll
            const reveals = document.querySelectorAll('.donate-reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('donate-reveal-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            reveals.forEach(el => observer.observe(el));
        })();
    </script>
</body>
</html>
