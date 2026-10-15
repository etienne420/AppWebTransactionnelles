<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;

Route::get('/', function () {
    return view('accueil');
});
Route::resource('jeux', JeuController::class)
    ->parameters(['jeux' => 'jeu']);
