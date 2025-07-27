<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function show(Order $guest_order) {
        @dd($guest_order);
    }
}
