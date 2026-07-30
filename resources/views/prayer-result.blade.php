<?php

use App\Services\AiService;
use App\Services\KeywordExtractorService;
use App\Data\Prays;
use App\Services\PrayerMatcherService;
use Livewire\Component;

new class extends Component {
    public string $type = 'person-prayer-audio';
    public string $religion = 'other';
    public ?string $description = null;
    public mixed $prayer = null;
    public array $extractedTags = [];
    public ?float $matchScore = null;
    public bool $loadingInstant = false;
    public array $meta = [];

    public function mount(): void
    {
        $this->type = request()->query('type', 'person-prayer-audio');
        $this->religion = request()->query('religion', 'other');
        $this->description = request()->query('description', '');

        $validTypes = ['ai', 'instant', 'person-prayer-audio', 'person-prayer-video', 'person-bible-audio', 'person-bible-video', 'person-bible-prayer-audio', 'person-bible-prayer-video'];

        if (!in_array($this->type, $validTypes, true)) {
            $this->type = 'person-prayer-audio';
        }

        if ($this->type === 'ai') {
            $this->prayer = app(AiService::class)->generate($this->description, $this->religion);
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

<div wire:init="$wire.loadInstantPrayer()" class="mx-auto max-w-measure text-center">

    @if ($type === 'instant' && $loadingInstant)
        <div class="result-card reveal visible reveal-delay-1">
            <div class="flex flex-col items-center justify-center py-16 space-y-4">
                <div class="loading-spinner" role="status" aria-label="Carregando oração">
                    <svg class="animate-spin h-10 w-10 text-olive motion-reduce:animate-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <p class="text-olive/70 text-sm">Preparando sua oração personalizada...</p>
            </div>
        </div>

    @elseif ($type === 'ai' && $prayer)
        <div class="result-card reveal visible reveal-delay-1">
            <h1 class="result-heading mb-6">Sua oração foi ouvida</h1>
            <div class="result-body text-left whitespace-pre-line mb-8 reveal visible reveal-delay-2">
                {{ $prayer }}
            </div>
            <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                <a href="{{ route('prayer.result', ['type' => 'instant', 'religion' => $religion]) }}"
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
            <h1 class="result-heading mb-2">{{ $prayer['title'] }}
                @if ($matchScore !== null)
                    <span class="inline-block text-xs bg-olive/10 text-olive rounded-full px-2 py-0.5 align-middle ml-2">{{ number_format($matchScore * 100, 0) }}%</span>
                @endif
            </h1>
            <p class="result-muted mb-6 reveal visible reveal-delay-2">Uma bênção para seu momento</p>
            @if (!empty($extractedTags))
                <div class="mb-6 reveal visible reveal-delay-2">
                    <p class="text-sm text-olive/70 mb-2">Temas identificados:</p>
                    <div class="flex flex-wrap gap-2 justify-center">
                        @foreach ($extractedTags as $tag)
                            <span class="inline-block bg-olive/10 text-olive text-xs rounded-full px-3 py-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="result-body text-left whitespace-pre-line mb-8 reveal visible reveal-delay-2">
                {{ $prayer['body'] }}
            </div>
            <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                <a href="{{ route('prayer.result', ['type' => 'ai', 'religion' => $religion]) }}"
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
            @if (in_array($type, ['person-prayer-audio', 'person-prayer-video', 'person-bible-audio', 'person-bible-video', 'person-bible-prayer-audio', 'person-bible-prayer-video']))
                <p class="result-body mb-8 reveal visible reveal-delay-2">
                    A oração em vídeo será gravada e estará disponível em até <strong>2 dias</strong>.
                    Você receberá uma notificação quando estiver pronta.
                </p>
            @endif
            <div class="flex flex-col gap-4 reveal visible reveal-delay-3">
                <a href="{{ route('prayer.result', ['type' => 'ai', 'religion' => $religion]) }}"
                   class="result-btn-primary">
                    Pedir oração por IA
                </a>
                <a href="{{ route('prayer.result', ['type' => 'instant', 'religion' => $religion]) }}"
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

    <a href="{{ route('welcome') }}" class="result-back-link">
        Voltar para página inicial
    </a>
</div>
