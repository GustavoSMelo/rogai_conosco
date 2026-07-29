<?php

use Illuminate\Support\Facades\Route;

Route::livewire("/", "app::welcome")->name("welcome");
Route::livewire("/prayer/result", "app::prayer-result")->name("prayer.result");
Route::livewire("/encontrar-oracao", "app::prayer-matcher")->name("prayer.matcher");
