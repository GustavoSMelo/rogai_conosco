<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        /** @var array<string, mixed> $validated */
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:10000'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'religion' => ['nullable', 'string', 'max:100'],
            'prayer_type' => ['required', 'string', 'in:ai,instant,person-prayer,person-bible,person-bible-prayer'],
        ]);

        PrayerRequest::create($validated);

        $type = $validated['prayer_type'];
        $religion = $validated['religion'] ?? 'generic';

        return redirect("/prayer/result?type={$type}&religion={$religion}");
    }
}
