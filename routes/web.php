<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\RechercheJeuController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


Route::get('/', function () {
    return view('accueil');
});

Route::get('/recherche/jeux', RechercheJeuController::class)
    ->name('recherche.jeux');

Route::resource('jeux', JeuController::class)
    ->parameters(['jeux' => 'jeu']);

Route::post('/langue', function (Request $request) {
    $data = $request->validate([
        'locale' => ['required', Rule::in(['fr', 'en'])],
    ]);

    $request->session()->put('locale', $data['locale']);

    return back();
})->name('locale.update');

