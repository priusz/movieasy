<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Guest\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
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
    Route::get('logout', [AuthUserController::class, 'logout'])
        ->name('logout');
});
