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
            'delivery' => ['required', 'in:recorded,instant,ai'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
        ]);

        PrayerRequest::create($validated);

        return redirect('/#request')->with('success', 'Your prayer request has been received. Someone is praying for you.');
    }
}
