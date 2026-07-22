@extends('layouts.minimal')

@section('content')
    <div class="mx-auto max-w-measure text-center">
        @if ($type === 'ai' && $prayer)
            <div class="result-card reveal visible reveal-delay-1">
                <h1 class="result-heading mb-6">Sua oração foi ouvida</h1>
                <div class="result-body text-left whitespace-pre-line mb-8 reveal visible reveal-delay-2">
                    {{ $prayer }}
                </div>
                <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                    <a href="{{ url('/prayer/result?type=instant&religion=' . urlencode($religion)) }}"
                       class="result-btn-primary">
                        Pedir oração instantânea
                    </a>
                    <a href="/doar"
                       class="result-btn-outline">
                        Apoie esta missão
                    </a>
                </div>
            </div>

        @elseif ($type === 'instant' && $prayer)
            <div class="result-card reveal visible reveal-delay-1">
                <h1 class="result-heading mb-2">{{ $prayer['title'] }}</h1>
                <p class="result-muted mb-6 reveal visible reveal-delay-2">Uma bênção para seu momento</p>
                <div class="result-body text-left whitespace-pre-line mb-8 reveal visible reveal-delay-2">
                    {{ $prayer['body'] }}
                </div>
                <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                    <a href="{{ url('/prayer/result?type=ai&religion=' . urlencode($religion)) }}"
                       class="result-btn-primary">
                        Pedir oração por IA
                    </a>
                    <a href="/doar"
                       class="result-btn-outline">
                        Apoie esta missão
                    </a>
                </div>
            </div>

        @else
            <div class="result-card reveal visible reveal-delay-1">
                <h1 class="result-heading mb-4">Sua intenção está em oração</h1>
                <p class="result-body mb-6 reveal visible reveal-delay-2">
                    Sua intenção foi recebida com fé e respeito.
                    <strong>Uma pessoa real está orando por você.</strong>
                </p>
                @if (in_array($type, ['person-prayer', 'person-bible', 'person-bible-prayer']))
                    <p class="result-body mb-8 reveal visible reveal-delay-2">
                        A oração em vídeo será gravada e estará disponível em até <strong>2 dias</strong>.
                        Você receberá uma notificação quando estiver pronta.
                    </p>
                @endif
                <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                    <a href="{{ url('/prayer/result?type=ai&religion=' . urlencode($religion)) }}"
                       class="result-btn-primary">
                        Pedir oração por IA
                    </a>
                    <a href="{{ url('/prayer/result?type=instant&religion=' . urlencode($religion)) }}"
                       class="result-btn-secondary">
                        Pedir oração instantânea
                    </a>
                    <a href="/doar"
                       class="result-btn-outline">
                        Apoie esta missão
                    </a>
                </div>
            </div>
        @endif

        <a href="/" class="result-back-link">
            Voltar para página inicial
        </a>
    </div>
@endsection
