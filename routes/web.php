<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\NofController;
use App\Http\Controllers\TablaController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('datos', DatosController::class);
    Route::resource('nof', NofController::class);
    // Route::get('/datos', function () {
    //     return view('pages.datos');
    // })->name('datos');

    Route::get('/estrategias', function () {
        return view('pages.estrategias');
    })->name('estrategias');

    // Route::get('/nof', function () {
    //     return view('pages.nof');
    // })->name('nof');

    Route::get('/riesgos', function () {
        return view('pages.riesgos');
    })->name('riesgos');
    
    // Ruta para manejar la consulta a GPT
    Route::post('/ask-gpt', [ChatGPTController::class, 'askGPT'])->name('ask.gpt');
});
