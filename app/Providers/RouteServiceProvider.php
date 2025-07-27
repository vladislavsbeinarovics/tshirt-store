<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // Custom binding: guest order via token
        Route::bind('guest_order', function ($token) {
            return Order::where('guest_token', $token)->firstOrFail();
        });
    }
}