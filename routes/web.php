<?php

use App\Http\Middleware\DashboardAuthenticate;
use Illuminate\Support\Facades\Route;

Route::livewire("/", "app::welcome")->name("welcome");
Route::livewire("/prayer/result", "app::prayer-result")->name("prayer.result");

Route::view("/donate", "donate")->name("donate");

Route::livewire("/painel/login", "painel::painel-login")->name("painel.login");

Route::middleware(DashboardAuthenticate::class)->group(function () {
    Route::livewire("/painel", "painel::painel")->name("painel.dashboard");
    Route::livewire("/painel/responder/{prayerRequest}", "painel::painel-responder")->name("painel.responder");
    Route::post("/painel/logout", function () {
        session()->forget('dashboard_authenticated');
        return redirect()->route('painel.login');
    })->name('painel.logout');
});
