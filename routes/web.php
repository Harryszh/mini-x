<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Falls du noch eine API oder Ressourcenkontroller hast, kannst du die Route hier lassen
Route::resource('posts', PostController::class);

// Alle anderen Anfragen laufen über Vue.js
Route::get('/{any}', function () {
    return view('app'); // Lädt die Vue App
})->where('any', '^(?!api).*$');