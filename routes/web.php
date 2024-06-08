<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/', [QuoteController::class, 'index'])->name('home');

Route::post('/storeQuote', [QuoteController::class, 'storeQuote'])->name('storeQuote');
Route::post('/removeQuote', [QuoteController::class, 'removeQuote'])->name('removeQuote');
