<?php

namespace App\Http\Controllers;

use App\Services\Checkout\GuestCheckoutService;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestCheckoutController extends Controller
{
    public function address()
    {
        return view('checkout.address');
    }

    public function storeAddress(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'postal_code' => 'required|string|max:20',
        ]);

        session(['address' => $validated]);

        return redirect()->to(dynamic_route('checkout', 'payment'));
    }

    public function payment()
    {
        return view('checkout.payment');
    }

    public function storePayment(Request $request, GuestCheckoutService $checkout) {
        $validated = $request->validate([
            'payment_method' => 'required|string|max:20',
        ]);

        session(['payment_method' => $validated['payment_method']]);

        $order = $checkout->placeOrder($validated['payment_method']);
        $guestToken = $order->guest_token;

        return redirect()->to(dynamic_route('orders', 'show', ['guest_token' => $guestToken]));
    }
}
