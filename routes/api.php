<?php

use App\Http\Controllers\Api\JeuController;
use Illuminate\Support\Facades\Route;

Route::apiResource('jeux', JeuController::class)
    ->names('api.jeux')
    ->only(['index', 'show'])
    ->parameters(['jeux' => 'jeu']);