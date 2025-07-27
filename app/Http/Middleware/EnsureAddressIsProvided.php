<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAddressIsProvided
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $address = session('address');

        if (
            empty($address['name']) ||
            empty($address['email']) ||
            empty($address['phone']) ||
            empty($address['address']) ||
            empty($address['postal_code'])
        ) {
            return redirect()->to(dynamic_route('checkout' , 'address'))->with('error', 'Please complete your address first.');
        }
        
        return $next($request);
    }
}
