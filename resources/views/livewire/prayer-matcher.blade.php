<?php

use App\Actions\KeywordExtractor;
use App\Services\PrayerMatcher;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Rogai Conosco — Encontrar Oração')] class extends Component {
    public string $text = '';

    public array $results = [];

    public array $extractedTags = [];

    public bool $hasMatched = false;

    public function match(): void
    {
        if (blank(trim($this->text))) {
            $this->hasMatched = false;
            $this->results = [];
            $this->extractedTags = [];
            return;
        }

        $this->extractedTags = (new KeywordExtractor())->extract($this->text);

        $matcher = new PrayerMatcher();
        $this->results = $matcher->match($this->text);
        $this->hasMatched = true;
    }
}

?>

<div class="welcome-section">
    <div class="mx-auto max-w-measure">
        <h1 class="welcome-section-heading text-center">Como foi seu dia?</h1>
        <p class="welcome-section-text mt-4 text-center">
            Conte como você está se sentindo. Vamos encontrar uma oração que combine com seu momento.
        </p>

        <div class="mt-10">
            <textarea
                wire:model="text"
                class="welcome-form-input min-h-[140px]"
                placeholder="Hoje foi um dia difícil no trabalho, precisei de muita paciência..."
            ></textarea>

            <div class="mt-4 flex justify-center">
                <button
                    wire:click="match"
                    class="welcome-btn-outline"
                >
                    Encontrar Oração
                </button>
            </div>
        </div>

        @if ($hasMatched)
            <div class="mt-12 space-y-6">
                @if (empty($results))
                    <p class="text-center text-brand-muted">
                        Conte um pouco mais sobre seu dia para encontrarmos a oração ideal.
                    </p>
                @else
                    @if (!empty($extractedTags))
                        <div class="mb-8">
                            <p class="text-center text-sm text-brand-muted">
                                Temas identificados:
                            </p>
                            <div class="mt-3 flex flex-wrap justify-center gap-2">
                                @foreach ($extractedTags as $tag)
                                    <span class="rounded-sm bg-brand-primary-light px-2 py-0.5 text-xs text-brand-muted">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <p class="text-center text-sm text-brand-muted">
                        Orações que mais combinam com seu momento:
                    </p>

                    @foreach ($results as $result)
                        <div class="welcome-card">
                            <div class="flex items-start justify-between gap-4">
                                <h3 class="welcome-card-title">{{ $result['prayer']['title'] }}</h3>
                                <span class="welcome-chip shrink-0">
                                    {{ $result['prayer']['category'] }}
                                </span>
                            </div>
                            <p class="welcome-card-text">
                                {{ Str::limit($result['prayer']['body'], 200) }}
                            </p>
                            @if (!empty($result['prayer']['tags']))
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($result['prayer']['tags'] as $tag)
                                        <span class="rounded-sm bg-brand-primary-light px-2 py-0.5 text-xs text-brand-muted">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <p class="mt-6 text-center text-xs text-brand-muted/60">
                        As orações são sugeridas com base nas palavras do seu texto.
                    </p>
                @endif
            </div>
        @endif
    </div>
</div>
