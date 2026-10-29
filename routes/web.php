<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\RechercheJeuController;

Route::get('/', function () {
    return view('accueil');
});

Route::get('/recherche/jeux', RechercheJeuController::class)
    ->name('recherche.jeux');

Route::resource('jeux', JeuController::class)
    ->parameters(['jeux' => 'jeu']);
