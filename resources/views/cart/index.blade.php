<x-layout.app title="Cart" class="grid grid-cols-4 gap-4">
    <x-ui.section class="col-span-3">

    <form method="POST" action="{{ dynamic_route('cart', 'removeSelected') }}" class="flex flex-col gap-4 items-start">
        @csrf
        @method('DELETE')

        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-left">Name</th>
                    <th class="">Price</th>
                    <th class="">Quantity</th>
                    <th class="">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($cart as $cartItemId => $cartItem)
                    @php
                        $cartItemPrice = $cartItem['price'];
                        $cartItemQty = $cartItem['quantity'];
                        $cartItemTotalPrice = $cartItemPrice * $cartItemQty;
                    @endphp
                    
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="cart_item_ids[]" value="{{ $cartItemId }}">
                        </td>
                        <td>{{ $cartItem['name'] }}</td>
                        <td class="text-center">{{ $cartItemPrice }}</td>
                        <td class="text-center">{{ $cartItemQty }}</td>
                        <td class="text-center">{{ $cartItemTotalPrice }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if(session('error'))
            <p class="text-red-500">{{ session('error') }}</p>
        @endif

        @if ($errors->has('cart_item_ids'))
            <p class="text-red-500">No cart items selected.</p>
        @endif

        <x-ui.button>Remove selected</x-ui.button>    

    </form>

</x-ui.section>

    <section class="border p-4 flex flex-col gap-4">
        <p>Cart total: {{ $cart_total }}</p>
        <a href="{{ dynamic_route('checkout', 'address') }}">
            <x-ui.button>Proceed to checkout</x-ui.button>
        </a>
    </section>
</x-layout.app>