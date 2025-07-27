<?php

namespace App\Services\Checkout;

use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CheckoutServiceInterface::class, CheckoutManager::class);
    }
}