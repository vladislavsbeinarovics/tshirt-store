<?php

namespace App\Services\Cart;

use App\Services\Cart\GuestCartService;
use App\Services\Cart\UserCartService;
use Illuminate\Support\Facades\Auth;

class CartManager implements CartServiceInterface
{
    protected CartServiceInterface $service;

    public function __construct()
    {
        $this->service = Auth::check()
            ? app(UserCartService::class)
            : app(GuestCartService::class);
    }

    public function get(): array
    {
        return $this->service->get();
    }

    public function getTotal(): float
    {
        return $this->service->getTotal();
    }

    public function add(array $product, int $quantity = 1): void
    {
        $this->service->add($product, $quantity);
    }

    public function remove(array $productIds): void
    {
        $this->service->remove($productIds);
    }

    public function has(int $productId): bool
    {
        return $this->service->has($productId);
    }

    public function count(): int
    {
        return $this->service->count();
    }

    public function __call($method, $args)
    {
        return $this->service->$method(...$args);
    }
}