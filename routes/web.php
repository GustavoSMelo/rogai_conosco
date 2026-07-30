<?php

use App\Http\Middleware\DashboardAuthenticate;
use Illuminate\Support\Facades\Route;

Route::livewire("/", "app::welcome")->name("welcome");
Route::livewire("/prayer/result", "app::prayer-result")->name("prayer.result");

Route::livewire("/painel/login", "app::painel-login")->name("painel.login");

Route::middleware(DashboardAuthenticate::class)->group(function () {
    Route::livewire("/painel", "app::painel")->name("painel.dashboard");
    Route::livewire("/painel/responder/{prayerRequest}", "app::painel-responder")->name("painel.responder");
    Route::post("/painel/logout", function () {
        session()->forget('dashboard_authenticated');
        return redirect()->route('painel.login');
    })->name('painel.logout');
});
