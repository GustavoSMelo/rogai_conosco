<?php

use App\Http\Controllers\PrayerRequestController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::post('/prayer-request', [PrayerRequestController::class, 'store']);
