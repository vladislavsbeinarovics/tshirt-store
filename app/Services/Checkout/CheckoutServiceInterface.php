<?php

namespace App\Services\Checkout;

interface CheckoutServiceInterface
{
    public function placeOrder(string $paymentMethod): \App\Models\Order;
}
