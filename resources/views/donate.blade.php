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
<body class="donate-page" style="background-image: linear-gradient(rgba(240, 240, 216, 0.92), rgba(240, 240, 216, 0.92)), url('{{ asset('images/bgrogai-conosco.png') }}');">

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
                <p class="donate-subline">Cada doação ajuda alguém a receber oração. Gratuitamente, sem cadastro, sem julgamento.</p>
            </div>
        </section>

        {{-- Payment methods: PIX + bank transfer --}}
        <section class="donate-methods" id="donate-methods">
            <div class="donate-methods-header">
                <h2 class="donate-section-heading">Como doar</h2>
                <p class="donate-section-hint">Pix ou transferência bancária. Qualquer valor é bem-vindo.</p>
                <p class="donate-chosen-hint" id="donate-chosen-hint" hidden>Você escolheu <strong></strong> — use os dados abaixo para doar.</p>
            </div>

            <div class="donate-methods-grid">

                {{-- PIX --}}
                <div class="donate-method-card donate-method-pix">
                    <div class="donate-method-head">
                        <span class="donate-method-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v20"/><path d="M17 7l-5-5-5 5"/><path d="M7 17l5 5 5-5"/></svg>
                        </span>
                        <h3 class="donate-method-title">Pix</h3>
                        <span class="donate-method-badge">Instantâneo</span>
                    </div>
                    <p class="donate-method-desc">
                        Pagamento instantâneo, de qualquer banco, direto pelo celular.
                    </p>

                    <div class="donate-pix-qr">
                        <img src="{{ asset('images/QRcode.png') }}"
                             alt="QR Code Pix para doação"
                             class="donate-pix-qr-img">
                    </div>

                    <button type="button" id="pix-copy-btn" class="donate-pix-copy-btn" aria-label="Copiar código Pix">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                        <span id="pix-copy-text">Copiar código Pix</span>
                    </button>
                    <p class="donate-pix-feedback" id="pix-copy-feedback" hidden>Código copiado! É só colar no app do banco.</p>
                    <p class="donate-method-note">
                        Abra o app do seu banco, escolha Pix, escaneie o QR Code ou cole o código copiado.
                    </p>
                </div>

                {{-- Bank transfer --}}
                <div class="donate-method-card donate-method-transfer">
                    <div class="donate-method-head">
                        <span class="donate-method-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10l9-7 9 7"/><path d="M5 10v10"/><path d="M19 10v10"/><path d="M3 20h18"/><path d="M9 20v-6h6v6"/></svg>
                        </span>
                        <h3 class="donate-method-title">Transferência (TED)</h3>
                        <span class="donate-method-badge">Banco</span>
                    </div>
                    <p class="donate-method-desc">
                        Transfira direto de qualquer banco para nossa conta.
                    </p>

                    <dl class="donate-bank-list">
                        {{-- TODO: preencher com os dados bancários reais --}}
                        <div class="donate-bank-row">
                            <dt>Banco</dt>
                            <dd>Bradesco</dd>
                        </div>
                        <div class="donate-bank-row">
                            <dt>Agência</dt>
                            <dd>2856</dd>
                        </div>
                        <div class="donate-bank-row">
                            <dt>Conta</dt>
                            <dd>31974-0</dd>
                        </div>
                        <div class="donate-bank-row">
                            <dt>Titular</dt>
                            <dd>Gustavo Santos Melo</dd>
                        </div>
                        <div class="donate-bank-row">
                            <dt>CNPJ / CPF</dt>
                            <dd>477.049.548-61</dd>
                        </div>
                    </dl>

                    <p class="donate-method-note">
                        A maioria dos bancos não cobra TED. Qualquer valor ajuda a manter a oração gratuita e acessível.
                    </p>
                </div>

            </div>
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
            const shareCopyBtn = document.getElementById('share-copy-btn');
            const shareCopyText = document.getElementById('share-copy-text');
            const shareFeedback = document.getElementById('share-feedback');
            const pixCopyBtn = document.getElementById('pix-copy-btn');
            const pixCopyText = document.getElementById('pix-copy-text');
            const pixCopyFeedback = document.getElementById('pix-copy-feedback');

            const pixPayload = '00020126330014BR.GOV.BCB.PIX0111477409548615204000053039865802BR5919GUSTAVO SANTOS MELO6009SAO PAULO62070503***63049695';

            if (pixCopyBtn) {
                pixCopyBtn.addEventListener('click', () => {
                    navigator.clipboard.writeText(pixPayload).then(() => {
                        pixCopyText.textContent = 'Código copiado!';
                        pixCopyFeedback.hidden = false;
                        setTimeout(() => {
                            pixCopyText.textContent = 'Copiar código Pix';
                            pixCopyFeedback.hidden = true;
                        }, 2500);
                    });
                });
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
