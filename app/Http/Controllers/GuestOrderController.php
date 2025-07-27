<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class GuestOrderController extends Controller
{
    public function show(string $guestToken)
    {
        $order = Order::where('guest_token', $guestToken)->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
