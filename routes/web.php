<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GuestCartController;
use App\Http\Controllers\GuestCheckoutController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');

Route::prefix('guest')->name('guest.')->group(function() {
    Route::get('/cart', [GuestCartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [GuestCartController::class, 'add'])->name('cart.add');
    Route::delete('/cart', [GuestCartController::class, 'removeSelected'])->name('cart.removeSelected');

    Route::middleware('cart.not.empty')->group(function () {
        Route::get('/checkout/address', [GuestCheckoutController::class, 'address'])->name('checkout.address');
        Route::post('/checkout/address', [GuestCheckoutController::class, 'storeAddress'])->name('checkout.storeAddress');

        Route::middleware(['cart.not.empty', 'address.provided'])->group(function () {
            Route::get('/checkout/payment', [GuestCheckoutController::class, 'payment'])->name('checkout.payment');
            Route::post('/checkout/payment', [GuestCheckoutController::class, 'storePayment'])->name('checkout.storePayment');
        });
    });

    Route::get('/orders/{guest_token}', [GuestOrderController::class, 'show'])->name('orders.show');
});

Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
