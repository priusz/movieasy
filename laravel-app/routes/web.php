<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Collection\CollectionController;
use App\Http\Controllers\Database\DatabaseController;
use App\Http\Controllers\Guest\GuestUserController;
use App\Services\QuoteService;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('welcome'); })
        ->name('welcome');

    Route::get('register', [GuestUserController::class, 'getRegisterPage'])
        ->name('register');

    Route::post('register', [GuestUserController::class, 'register'])
        ->name('register');

    Route::get('login', [GuestUserController::class, 'getLoginPage'])
        ->name('login');

    Route::post('login', [GuestUserController::class, 'login'])
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

    Route::get('database', [DatabaseController::class, 'getDatabasePage'])
        ->name('database');

    Route::post('database/search', [DatabaseController::class, 'getDatabasePageWithFilteredData'])
        ->name('database-search');

    Route::get('database/search', [DatabaseController::class, 'getDatabasePage'])
        ->name('database-search');

    Route::post('database/sort', [DatabaseController::class, 'getDatabasePageWithSortedData'])
        ->name('database-sort');

    Route::post('update-page', [DatabaseController::class, 'updatePage'])
        ->name('update-page');

    Route::get('details/{id}/{season}/{episode}', [DatabaseController::class, 'getDetails'])
        ->name('details');

    Route::get('update/item/{target}/{itemId}/{season}/{episode}', [CollectionController::class, 'updateItem'])
        ->name('updateItem');

    Route::get('update/modal/{target}/{itemId}/{season}/{episode}', [CollectionController::class, 'updateModal'])
        ->name('updateModal');

    Route::get('refresh/item/{target}/{itemId}/{type}/{season}/{episode}', [CollectionController::class, 'refreshItem'])
        ->name('refreshItem');

    Route::get('collection', [CollectionController::class, 'getCollectionPage'])
        ->name('collection');

    Route::get('collection/filter/{title}/{listType}/{itemType}', [CollectionController::class, 'getFilteredItems'])
        ->name('collectionFilter');

    Route::get('collection/sort/{actualState}', [CollectionController::class, 'getSortedItems'])
        ->name('collectionSort');

    Route::get('collection/update/{target}/{itemId}/{type}/{season}/{episode}', [CollectionController::class, 'refreshCollection'])
        ->name('refreshCollection');

});


