<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/locales',[LocaleController::class,'index'])
    ->name('locales.index');

    Route::get('/administrador/medidas', function () {
        return view('administrador.medidas.index');
    })->name('administrador.medidas.index');
});
