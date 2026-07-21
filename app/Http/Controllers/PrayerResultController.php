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

        return view('prayer.result', compact('type', 'religion', 'prayer'));
    }
}
