<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/test", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

Route::post("/ai", function (Request $request) {
    $aiService = new \App\Services\AiService();
    return $aiService->findBestPrayMatch(
        $request->input("religion"),
        $request->input("prayDescription"),
    );
});
