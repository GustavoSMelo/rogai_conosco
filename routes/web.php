<?php

use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\PrayerResultController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::post('/prayer-request', [PrayerRequestController::class, 'store']);
Route::get('/prayer/result', PrayerResultController::class);
