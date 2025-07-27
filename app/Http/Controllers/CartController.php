<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function redirectTo() {
        return redirect(cart_route('index'));
    }
}
