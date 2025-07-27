<?php

namespace App\Services\Cart;

use App\Services\Cart\CartManager;
use App\Services\Cart\CartServiceInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind(CartServiceInterface::class, CartManager::class);
        
        $this->app->singleton(CartServiceInterface::class, CartManager::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
