<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rogai Conosco — Sua oração</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-brand-surface min-h-screen flex items-center justify-center px-6 py-16">
    <div class="mx-auto max-w-measure text-center reveal visible">
        @if ($type === 'ai' && $prayer)
            <div class="welcome-card p-8 sm:p-12">
                <h1 class="welcome-modal-title mb-6">Sua oração por IA</h1>
                <div class="text-left text-brand-ink/85 leading-relaxed whitespace-pre-line mb-8">
                    {{ $prayer }}
                </div>
                <div class="flex flex-col gap-4">
                    <a href="{{ url('/prayer/result?type=instant&religion=' . urlencode($religion)) }}"
                       class="welcome-modal-btn bg-brand-accent text-center no-underline">
                        Pedir oração instantânea
                    </a>
                    <a href="/doar"
                       class="welcome-btn-outline text-center">
                        Apoie esta missão
                    </a>
                </div>
            </div>

        @elseif ($type === 'instant' && $prayer)
            <div class="welcome-card p-8 sm:p-12">
                <h1 class="welcome-modal-title mb-2">{{ $prayer['title'] }}</h1>
                <p class="text-sm text-brand-muted mb-6">Oração instantânea</p>
                <div class="text-left text-brand-ink/85 leading-relaxed whitespace-pre-line mb-8">
                    {{ $prayer['body'] }}
                </div>
                <div class="flex flex-col gap-4">
                    <a href="{{ url('/prayer/result?type=ai&religion=' . urlencode($religion)) }}"
                       class="welcome-modal-btn bg-brand-accent text-center no-underline">
                        Pedir oração por IA
                    </a>
                    <a href="/doar"
                       class="welcome-btn-outline text-center">
                        Apoie esta missão
                    </a>
                </div>
            </div>

        @else
            <div class="welcome-card p-8 sm:p-12">
                <h1 class="welcome-modal-title mb-4">Oração recebida</h1>
                <p class="text-brand-ink/85 leading-relaxed mb-6">
                    Sua intenção foi recebida com fé e respeito.
                    <strong>Uma pessoa real está orando por você.</strong>
                </p>
                @if (in_array($type, ['person-prayer', 'person-bible', 'person-bible-prayer']))
                    <p class="text-brand-ink/75 leading-relaxed mb-8">
                        A oração em vídeo será gravada e estará disponível em até <strong>2 dias</strong>.
                        Você receberá uma notificação quando estiver pronta.
                    </p>
                @endif
                <div class="flex flex-col gap-4">
                    <a href="{{ url('/prayer/result?type=ai&religion=' . urlencode($religion)) }}"
                       class="welcome-modal-btn bg-brand-accent text-center no-underline">
                        Pedir oração por IA
                    </a>
                    <a href="{{ url('/prayer/result?type=instant&religion=' . urlencode($religion)) }}"
                       class="welcome-modal-btn bg-brand-primary text-center no-underline">
                        Pedir oração instantânea
                    </a>
                    <a href="/doar"
                       class="welcome-btn-outline text-center">
                        Apoie esta missão
                    </a>
                </div>
            </div>
        @endif

        <a href="/" class="inline-block mt-8 text-sm text-brand-primary no-underline hover:text-brand-accent transition-colors duration-150">
            Voltar para página inicial
        </a>
    </div>
</body>
</html>
