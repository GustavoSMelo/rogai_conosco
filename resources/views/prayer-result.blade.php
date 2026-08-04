<?php

use App\Services\AiService;
use App\Services\KeywordExtractorService;
use App\Data\Prays;
use App\Services\PrayerMatcherService;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

new class extends Component {
    public string $type = 'person-prayer-audio';
    public string $religion = 'other';
    public ?string $description = null;
    public mixed $prayer = null;
    public array $extractedTags = [];
    public ?float $matchScore = null;
    public bool $loadingInstant = false;
    public bool $loadingAi = false;
    public array $meta = [];

    public function mount(): void
    {
        $this->type = request()->query('type', 'person-prayer-audio');
        $this->religion = request()->query('religion', 'other');

        $rawDescription = request()->query('description', '');
        try {
            $this->description = Crypt::decryptString($rawDescription);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $this->description = $rawDescription;
        }

        $validTypes = ['ai', 'instant', 'person-prayer-audio', 'person-prayer-video', 'person-bible-audio', 'person-bible-video', 'person-bible-prayer-audio', 'person-bible-prayer-video'];

        if (!in_array($this->type, $validTypes, true)) {
            $this->type = 'person-prayer-audio';
        }

        if ($this->type === 'ai') {
            $this->loadingAi = true;
        }

        if ($this->type === 'instant') {
            $this->loadingInstant = true;
        }

        $this->meta = [
            'title' => match ($this->type) {
                'ai' => 'Rogai Conosco — Sua oração foi ouvida',
                'instant' => 'Rogai Conosco — Uma bênção para seu momento',
                default => 'Rogai Conosco — Sua intenção está em oração',
            },
            'description' => match ($this->type) {
                'ai' => 'Receba uma oração gerada por IA, inspirada pela sua fé e tradição religiosa.',
                'instant' => 'Uma oração previamente escrita para seu momento de fé e reflexão.',
                default => 'Sua intenção de oração foi recebida. Uma pessoa real está orando por você.',
            },
        ];
    }

    public function loadAiPrayer(): void
    {
        if ($this->type !== 'ai' || $this->prayer !== null) {
            return;
        }

        $this->prayer = app(AiService::class)->generate($this->description, $this->religion);
        $this->loadingAi = false;
    }

    public function loadInstantPrayer(): void
    {
        if ($this->type !== 'instant') {
            return;
        }

        try {
            $aiResult = app(AiService::class)->findBestPrayMatch($this->religion, $this->description ?? '');
            if ($aiResult !== null) {
                $this->prayer = $aiResult;
                $this->loadingInstant = false;
                return;
            }
        } catch (\Throwable $e) {
        }

        $matcher = app(PrayerMatcherService::class);
        $extractor = app(KeywordExtractorService::class);

        $matched = $matcher->match($this->description ?? '', 3);

        if (!empty($matched)) {
            $result = $matched[0];
            $this->prayer = $result['prayer'];
            $this->matchScore = $result['score'];
        } else {
            $prayers = Prays::getPrays();
            $list = $prayers[$this->religion] ?? $prayers['other'] ?? [];
            if (empty($list)) {
                $this->prayer = null;
            } elseif (blank($this->description ?? '')) {
                $this->prayer = $list[array_rand($list)];
            } else {
                $this->prayer = $list[crc32($this->description ?? '') % count($list)];
            }
        }

        $this->extractedTags = $extractor->extract($this->description ?? '');
        $this->loadingInstant = false;
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::livewire-minimal', ['meta' => $this->meta])
            ->title($this->meta['title']);
    }
};

?>

<div wire:init="$wire.loadInstantPrayer(); $wire.loadAiPrayer()" class="mx-auto max-w-measure text-center">

    @if (($type === 'instant' && $loadingInstant) || ($type === 'ai' && $loadingAi))
        <div class="result-card reveal visible reveal-delay-1">
            <div class="flex flex-col items-center justify-center py-20 space-y-8">
                <div class="flex gap-3" role="status" aria-label="Carregando oração">
                    <span class="loading-dot"></span>
                    <span class="loading-dot"></span>
                    <span class="loading-dot"></span>
                </div>
                <div class="text-center space-y-2">
                    @if ($type === 'ai')
                        <p class="font-serif text-lg text-brand-primary">Gerando sua oração...</p>
                        <p class="text-sm text-brand-muted">Inspirando-se na sua fé para escrever sua oração</p>
                    @else
                        <p class="font-serif text-lg text-brand-primary">Preparando sua oração...</p>
                        <p class="text-sm text-brand-muted">Buscando a mensagem ideal para seu momento</p>
                    @endif
                    <p class="text-sm text-brand-muted">(aguarde alguns instantes)</p>
                </div>
            </div>
        </div>

    @elseif ($type === 'ai' && $prayer)
        <div class="result-card reveal visible reveal-delay-1">
            <h1 class="result-heading mb-6">Sua oração foi ouvida</h1>
            <div class="result-quote text-left whitespace-pre-line mb-8 reveal visible reveal-delay-2">
                {{ $prayer }}
            </div>
            <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                <a href="{{ route('prayer.result', ['type' => 'instant', 'religion' => $religion]) }}"
                   class="result-btn-primary">
                    Pedir oração instantânea
                </a>
                <a href="/donate"
                   class="result-btn-outline">
                    Apoie esta missão
                </a>
            </div>
        </div>

    @elseif ($type === 'instant' && $prayer)
        <div class="result-card reveal visible reveal-delay-1">
            <h1 class="result-heading mb-2">{{ $prayer['title'] }}</h1>
            @if (!empty($prayer['subcategory'] ?? []))
                <div class="flex flex-wrap gap-2 justify-center mb-3 reveal visible reveal-delay-2">
                    @foreach ($prayer['subcategory'] as $index => $sub)
                        <span class="subcategory-chip-{{ $index % 4 }} inline-block text-xs rounded-full px-3 py-1">{{ $sub }}</span>
                    @endforeach
                </div>
            @endif
            <p class="result-muted mb-6 reveal visible reveal-delay-2">Uma bênção para seu momento</p>
            @if (!empty($extractedTags))
                <div class="mb-6 reveal visible reveal-delay-2">
                    <p class="text-sm text-brand-muted mb-2">Temas identificados:</p>
                    <div class="flex flex-wrap gap-2 justify-center">
                        @foreach ($extractedTags as $tag)
                            <span class="inline-block bg-brand-primary/10 text-brand-primary text-xs rounded-full px-3 py-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="result-prayer-body text-left whitespace-pre-line mb-8 reveal visible reveal-delay-2">
                {{ $prayer['body'] }}
            </div>
            <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                <a href="{{ route('prayer.result', ['type' => 'ai', 'religion' => $religion]) }}"
                   class="result-btn-primary">
                    Pedir oração por IA
                </a>
                <a href="/donate"
                   class="result-btn-outline">
                    Apoie esta missão
                </a>
            </div>
        </div>

    @else
        <div class="result-card reveal visible reveal-delay-1">
            <h1 class="result-heading mb-4">Oração em produção</h1>
            <p class="result-body mb-6 reveal visible reveal-delay-2">
                Sua oração foi recebida com fé e respeito.
                <strong>Uma pessoa real está orando por você.</strong>
            </p>
            @if (in_array($type, ['person-prayer-audio', 'person-prayer-video', 'person-bible-audio', 'person-bible-video', 'person-bible-prayer-audio', 'person-bible-prayer-video']))
                <p class="result-body mb-8 reveal visible reveal-delay-2">
                    A oração em audio/vídeo será gravada e estará disponível em até <strong>2 dias</strong>.
                    Você receberá uma notificação quando estiver pronta.
                </p>
            @endif
            <p class="result-person-hint mb-6 reveal visible reveal-delay-2">
                Caso precise de uma oração o mais urgente possível, temos essas opções instantâneas para você, logo abaixo.
            </p>
            <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                <a href="{{ route('prayer.result', ['type' => 'ai', 'religion' => $religion]) }}"
                   class="result-btn-primary">
                    Pedir oração por IA
                </a>
                <a href="{{ route('prayer.result', ['type' => 'instant', 'religion' => $religion]) }}"
                   class="result-btn-secondary">
                    Pedir oração instantânea
                </a>
                <a href="/donate"
                   class="result-btn-outline">
                    Apoie esta missão
                </a>
            </div>
        </div>
    @endif

    <a href="{{ route('welcome') }}" class="result-back-link">
        Voltar para página inicial
    </a>
</div>
