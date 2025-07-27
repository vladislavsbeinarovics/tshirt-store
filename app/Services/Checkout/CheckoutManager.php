<?php

namespace App\Services\Checkout;

use Illuminate\Support\Facades\Auth;

class CheckoutManager implements CheckoutServiceInterface
{
    protected CheckoutServiceInterface $service;

    public function __construct()
    {
        $this->service = Auth::check()
            ? app(UserCheckoutService::class)
            : app(GuestCheckoutService::class);
    }

    public function placeOrder(string $paymentMethod): \App\Models\Order
    {
        return $this->service->placeOrder($paymentMethod);
    }
}