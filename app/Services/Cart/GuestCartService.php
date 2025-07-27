<?php

namespace App\Services\Cart;

use App\Services\Cart\CartServiceInterface;
use Illuminate\Support\Facades\Session;

class GuestCartService implements CartServiceInterface
{
    public function get(): array {
        return Session::get('cart', []);
    }

    public function add(array $product, int $quantity = 1): void {
        $cart = $this->get();

        $productId = $product['id'];

        $existingQuantity = $cart[$productId]['quantity'] ?? 0;

        $cart[$productId] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $existingQuantity + $quantity,
        ];

        $this->store($cart);
    }

    public function getTotal(): float
    {
        return array_reduce($this->get(), function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0.00);
    }

    public function remove(array $productIds): void
    {
        $cart = $this->get();

        foreach ($productIds as $id) {
            unset($cart[$id]);
        }

        $this->store($cart);
    }

    public function has(int $productId): bool
    {
        return array_key_exists($productId, $this->get());
    }

    public function count(): int
    {
        return array_sum(array_column($this->get(), 'quantity'));
    }

    public function store(array $cart): void
    {
        Session::put('cart', $cart);
        Session::put('cart_total', $this->getTotal());
    }
}