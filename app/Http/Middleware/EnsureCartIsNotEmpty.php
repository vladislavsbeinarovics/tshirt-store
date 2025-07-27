<?php

namespace App\Http\Middleware;

use App\Services\Cart\CartServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCartIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __invoke(Request $request, Closure $next): Response
    {
        $cart = app(CartServiceInterface::class);
        
        if ($cart->count() == 0) {
            return redirect()->to(dynamic_route('cart', 'index'));
        }

        return $next($request);
    }
}
