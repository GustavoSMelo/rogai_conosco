{{--
DIRECTION CONTRACT
THESIS: The 404 refuses the category scream (giant numbers) — the lost moment is spoken quietly, and the brand's own sheep is the found one.
OWN-WORLD: Pure white field; olive carries structure and the single action; terracotta reserved for the verse. Source Serif 4 voices the comfort; Figtree keeps the recovery plain.
STORY: The visitor arrives lost, reads that the path does not exist but that they are not lost, and takes one calm way home.
FIRST VIEWPORT: Full-viewport centered column — sheep mark, brand word, small "Erro 404" label, serif heading, verse, one olive button.
FORM: Extension of the established welcome world (extend-surface), quiet-centered composition, one authored fade-up reveal.
--}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página não encontrada. Volte ao início e continue seu pedido de oração.">
    <meta name="robots" content="noindex">

    <meta property="og:title" content="Página não encontrada — Rogai Conosco">
    <meta property="og:description" content="Página não encontrada. Volte ao início e continue seu pedido de oração.">
    <meta property="og:image" content="{{ asset('images/ovelhinha.png') }}">
    <meta property="og:type" content="website">

    <title>Página não encontrada — Rogai Conosco</title>

    <link rel="icon" href="{{ asset('images/ovelhinha.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/error.css'])
</head>
<body class="error-page">
    <div class="error-content">
        <a href="{{ url('/') }}" class="error-brand-link error-reveal">
            <img src="{{ asset('images/ovelhinha.png') }}" alt="" class="error-logo">
            <span class="error-brand-text">Rogai Conosco</span>
        </a>

        <p class="error-kicker error-reveal error-reveal-delay-1">Erro 404 - Pagina inexistente</p>

        <h1 class="error-heading error-reveal error-reveal-delay-1">Este caminho não existe<br /> mas você não está perdido.</h1>

        <p class="error-subline error-reveal error-reveal-delay-2">
            O Bom Pastor deixa as noventa e nove e vai atrás da ovelha que se perdeu, até encontrá-la.
        </p>

        <blockquote class="error-verse error-reveal error-reveal-delay-2">
            <p>&ldquo;Vai atrás da ovelha que se perdeu, até encontrá-la.&rdquo;</p>
            <cite class="error-verse-cite">- Lucas 15:4</cite>
        </blockquote>

        <a href="{{ url('/') }}" class="error-btn error-reveal error-reveal-delay-3">Voltar ao início</a>
    </div>

    <footer class="error-footer">
        <p>Feito com fé. Sustentado por doações.</p>
    </footer>
</body>
</html>
