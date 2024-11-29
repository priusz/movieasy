<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Guest\UserController;
use App\Services\QuoteService;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('welcome'); })
        ->name('welcome');

    Route::get('register', [UserController::class, 'getRegisterPage'])
        ->name('register');

    Route::post('register', [UserController::class, 'register'])
        ->name('register');

    Route::get('login', [UserController::class, 'getLoginPage'])
        ->name('login');

    Route::post('login', [UserController::class, 'login'])
        ->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('home', [AuthUserController::class, 'getHomePage'])
        ->name('home');

    Route::get('logout', [AuthUserController::class, 'logout'])
        ->name('logout');

    Route::get('get-random-quote', function (QuoteService $quoteService) {
        $quote = $quoteService->getRandomQuote();
        return $quote; })
        ->name('get-random-quote');
});


