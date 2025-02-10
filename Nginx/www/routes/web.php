<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::prefix('link')->middleware('validate.link')->group(function () {
    Route::post('/{token}/regenerate', [LinkController::class, 'regenerate'])->name('link.regenerate');
    Route::post('/{token}/deactivate', [LinkController::class, 'deactivate'])->name('link.deactivate');
});

Route::prefix('game')->middleware('validate.link')->group(function () {
    Route::get('/{token}', [GameController::class, 'show'])->name('game.show');
    Route::post('/{token}/play', [GameController::class, 'play'])->name('game.play');
    Route::get('/{token}/history', [GameController::class, 'history'])->name('game.history');
});
