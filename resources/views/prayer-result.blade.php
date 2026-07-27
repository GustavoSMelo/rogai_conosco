<?php

use App\Actions\GenerateAiPrayer;
use App\Data\Prays;
use Livewire\Component;

new class extends Component {
    public string $type = 'person-prayer-audio';
    public string $religion = 'other';
    public ?string $description = null;
    public mixed $prayer = null;
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
            $this->prayer = app(GenerateAiPrayer::class)->generate($this->description, $this->religion);
        }

        if ($this->type === 'instant') {
            $prayers = Prays::getPrays();
            $list = $prayers[$this->religion] ?? $prayers['other'] ?? [];
            $this->prayer = !empty($list) ? $list[array_rand($list)] : null;
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

    public function render()
    {
        return $this->view()
            ->layout('layouts::livewire-minimal', ['meta' => $this->meta])
            ->title($this->meta['title']);
    }
};

?>

<div class="mx-auto max-w-measure text-center">
    @if ($type === 'ai' && $prayer)
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
            <h1 class="result-heading mb-2">{{ $prayer['title'] }}</h1>
            <p class="result-muted mb-6 reveal visible reveal-delay-2">Uma bênção para seu momento</p>
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
