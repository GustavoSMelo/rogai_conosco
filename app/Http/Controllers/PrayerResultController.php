<?php

namespace App\Http\Controllers;

use App\Actions\GenerateAiPrayer;
use Illuminate\Http\Request;

class PrayerResultController extends Controller
{
    public function __invoke(Request $request)
    {
        $type = $request->query('type', 'person-prayer');
        $religion = $request->query('religion', 'generic');
        $validTypes = ['ai', 'instant', 'person-prayer', 'person-bible', 'person-bible-prayer'];

        if (! in_array($type, $validTypes, true)) {
            $type = 'person-prayer';
        }

        $prayer = null;

        if ($type === 'ai') {
            $description = $request->query('description', '');
            $prayer = app(GenerateAiPrayer::class)->generate($description, $religion);
        }

        if ($type === 'instant') {
            $prayers = require resource_path('data/instant-prayers.php');
            $list = $prayers[$religion] ?? $prayers['generic'] ?? [];
            $prayer = $list[array_rand($list)];
        }

        $meta = [
            'title' => match ($type) {
                'ai' => 'Rogai Conosco — Sua oração foi ouvida',
                'instant' => 'Rogai Conosco — Uma bênção para seu momento',
                default => 'Rogai Conosco — Sua intenção está em oração',
            },
            'description' => match ($type) {
                'ai' => 'Receba uma oração gerada por IA, inspirada pela sua fé e tradição religiosa.',
                'instant' => 'Uma oração previamente escrita para seu momento de fé e reflexão.',
                default => 'Sua intenção de oração foi recebida. Uma pessoa real está orando por você.',
            },
            'image' => asset('images/ovelhinha.png'),
        ];

        return view('prayer.result', compact('type', 'religion', 'prayer', 'meta'));
    }
}
