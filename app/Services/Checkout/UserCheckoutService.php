<?php

namespace App\Services\Checkout;

use App\Models\Order;

class UserCheckoutService implements CheckoutServiceInterface
{
    public function placeOrder(): Order
    {
        throw new \Exception('User checkout not implemented yet.');
    }
}