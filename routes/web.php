<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChessController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chess', [ChessController::class, 'index'])->name('chess.index');
