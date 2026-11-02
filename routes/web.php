<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\RechercheJeuController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AuthController;
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

Route::get('/inscription', [InscriptionController::class, 'create'])
    ->middleware('guest')->name('register');
Route::post('/inscription', [InscriptionController::class, 'store'])
    ->middleware('guest')->name('register.store');

Route::get('/connexion', [AuthController::class, 'create'])
    ->middleware('guest')->name('login');
Route::post('/connexion', [AuthController::class, 'login'])
    ->middleware(['guest', 'throttle:6,1'])->name('login.store');
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');