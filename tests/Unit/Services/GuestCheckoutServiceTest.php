<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use App\Services\Checkout\GuestCheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class GuestCheckoutServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_places_an_order_with_valid_guest_data()
    {
        auth()->logout();
        // Arrange: seed session with cart, address, and payment
        Session::put('cart', [
            1 => ['name' => 'Test Product', 'price' => 50, 'quantity' => 2],
        ]);
        Session::put('cart_total', 100.00);
        Session::put('address', [
            'name' => 'Alice Guest',
            'email' => 'alice@example.com',
            'phone' => '123456789',
            'address' => '123 Laravel Street',
            'postal_code' => 'LV-1000',
        ]);

        $service = app(GuestCheckoutService::class);

        // Act
        $order = $service->placeOrder('credit_card');

        dump($order->guest_token);

        // Assert: database has new order
        $this->assertInstanceOf(Order::class, $order);
        $this->assertDatabaseHas('orders', [
            'email' => 'alice@example.com',
            'payment_method' => 'credit_card',
            'cart_total' => 100.00,
        ]);

        // Assert: guest_token is set and valid UUID
        $this->assertNotNull($order->guest_token);
        $this->assertTrue(Str::isUuid((string) $order->guest_token));

        // Assert: session is cleared
        $this->assertEmpty(Session::get('cart'));
        $this->assertEmpty(Session::get('cart_total'));
        $this->assertEmpty(Session::get('address'));
        $this->assertEmpty(Session::get('payment_method'));
    }
}
