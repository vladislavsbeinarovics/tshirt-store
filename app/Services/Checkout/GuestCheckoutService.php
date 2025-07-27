<?php

namespace App\Services\Checkout;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GuestCheckoutService implements CheckoutServiceInterface
{
    public function placeOrder(string $paymentMethod): Order
    {
        $cart = Session::get('cart', []);
        $cartTotal = Session::get('cart_total', 0.00);
        $address = Session::get('address', []);
        $user = Auth::user();
        $guestToken = $user ? null : Str::uuid();

        $order = Order::create([
            'user_id' => $user?->id,
            'guest_token' => $guestToken,
            'name' => $address['name'],
            'email' => $address['email'],
            'phone' => $address['phone'],
            'address' => $address['address'],
            'postal_code' => $address['postal_code'],
            'payment_method' => $paymentMethod,
            'cart_total' => $cartTotal,
        ]);

        if (!$user) {
            Session::put('guest_token', $guestToken);
        }

        Session::forget([
            'cart',
            'cart_total',
            'address',
            'payment_method',
        ]);

        return $order;
    }
}