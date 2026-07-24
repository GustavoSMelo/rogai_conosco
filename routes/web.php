<?php

use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\PrayerResultController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::post('/prayer-request', [PrayerRequestController::class, 'store']);
Route::get('/prayer/result', PrayerResultController::class);

Route::prefix('livewire')->group(function () {
    Route::livewire('/', 'livewire::welcome')->name('livewire.welcome');
    Route::livewire('/prayer/result', 'livewire::prayer-result')->name('livewire.prayer.result');
});
