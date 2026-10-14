<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;

Route::get('/', function () {
    return "yo";
});

Route::resource('jeux', JeuController::class);