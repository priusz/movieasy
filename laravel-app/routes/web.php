<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'getRegisterPage'])
        ->name('register');

    Route::post('register', [UserController::class, 'createUser'])
        ->name('register');

    Route::get('login', [UserController::class, 'getLoginPage'])
        ->name('login');

    Route::post('login', [UserController::class, 'loginAttempt'])
        ->name('login');
});
