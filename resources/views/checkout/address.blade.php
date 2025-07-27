<x-layout.app title="Checkout" class="flex flex-col gap-4">
    @php
        $cart = session('cart', []);
    @endphp
    @if (!empty($cart))

        <x-ui.section class="border p-4 flex justify-between">
            <p>Cart total</p>
            <p>{{ number_format(session('cart_total', 0), 2) }}</p>
        </x-ui.section>

        <x-ui.section class="border p-4">
            <form method="POST" action="{{ dynamic_route('checkout', 'storeAddress') }}" class="flex flex-col gap-4">
                @csrf
                
                <fieldset class="flex flex-col gap-2">
                    <legend>Contact Info</legend>
                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email (optional)">
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                </fieldset>
        
                <fieldset class="flex flex-col gap-2">
                    <legend>Address</legend>
                    <input type="text" name="address" placeholder="Address Line 1" required>
                    <input type="text" name="postal_code" placeholder="Postal Code" required>
                </fieldset>

                <x-ui.button>Continue to Payment</x-ui.button>
            </form>
        </x-ui.section>
    @else
        @php  @endphp
    @endif
</x-layout.app>