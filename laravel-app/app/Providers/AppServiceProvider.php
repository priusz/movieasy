<?php

namespace App\Providers;

use App\DBConnection\Connection;
use App\Repositories\CollectionRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\UserRepository;
use App\Services\CollectionService;
use App\Services\QuoteService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Connection::class, function ($app) {
            return new Connection();
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(UserService::class, function ($app) {
            $userRepository = $app->make(UserRepository::class);
            return new UserService($userRepository);
        });

        $this->app->singleton(CollectionService::class, function ($app) {
            $collectionRepository = $app->make(CollectionRepository::class);
            return new CollectionService($collectionRepository);
        });

        $this->app->singleton(QuoteService::class, function ($app) {
            $quoteRepository = $app->make(QuoteRepository::class);
            return new QuoteService($quoteRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
