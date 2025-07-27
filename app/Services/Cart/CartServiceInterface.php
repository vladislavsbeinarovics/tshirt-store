<?php

namespace App\Services\Cart;

interface CartServiceInterface
{
    public function get(): array;
    public function getTotal(): float;
    public function add(array $product, int $quantity = 1): void;
    public function remove(array $productIds): void;
    public function has(int $productId): bool;
    public function count(): int;
}
