<?php

use App\Http\Controllers\Api\JeuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SessionTokenController;

Route::apiResource('jeux', JeuController::class)
    ->names('api.jeux')
    ->middleware('throttle:60,1')
    ->only(['index', 'show'])
    ->parameters(['jeux' => 'jeu']);

Route::post('login', [SessionTokenController::class, 'store'])
    ->middleware('throttle:6,1');

Route::post('logout', [SessionTokenController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('jeux', JeuController::class)
        ->parameters(['jeux' => 'jeu'])
        ->names('api.jeux')
        ->only(['store', 'update', 'destroy']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('jeux', JeuController::class)
        ->names('api.jeux')
        ->only(['store', 'update', 'destroy']);
});
