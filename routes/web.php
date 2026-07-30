<?php

use Illuminate\Support\Facades\Route;

Route::livewire("/", "app::welcome")->name("welcome");
Route::livewire("/prayer/result", "app::prayer-result")->name("prayer.result");
