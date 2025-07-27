<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart\CartManager;
use Illuminate\Http\Request;

class GuestCartController extends Controller
{
    public function index(CartManager $cart) {
        return view('cart.index', [
            'cart' =>$cart->get(),
            'cart_total' => $cart->getTotal(),
        ]);
    }

    public function add(Request $request, CartManager $cart)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'redirect_to' => 'nullable|url',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $cart->add($product->toArray(), $validated['quantity'] ?? 1);

        $redirectTo = $validated['redirect_to'] ?? route('shop.index');
        return redirect($redirectTo)->with('success', 'Product added to the cart!');
    }

    public function removeSelected(Request $request, CartManager $cart)
    {
        $validated = $request->validate([
            'cart_item_ids' => 'required|array|min:1',
            'cart_item_ids.*' => 'integer',
            'redirect_to' => 'nullable|url',
        ]);

        $cart->remove($validated['cart_item_ids']);

        $redirectTo = $validated['redirect_to'] ?? route('shop.index');
        return redirect($redirectTo)->with('success', 'Item removed.');
    }
}