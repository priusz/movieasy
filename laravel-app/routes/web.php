<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'register'])
        ->name('register');

    Route::get('login', [UserController::class, 'login'])
        ->name('login');
});
