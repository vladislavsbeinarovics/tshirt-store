<x-layout.app title="Payment" class="flex flex-col gap-4">
    <x-ui.section class="flex justify-between">
        <p>Cart Total</p>
        <p>{{ session('cart_total') }}</p>
    </x-ui.section>

    <x-ui.section class="flex justify-between">
        <p>Shipping To</p>

        <div class="text-right">
            @foreach (session('address') as $info)
                <p>{{ $info }}</p>
            @endforeach
        </div>
    </x-ui.section>
    
    <x-ui.section>
        <form  method="POST" action="{{ dynamic_route('checkout', 'storePayment') }}" class="grid grid-cols-2 gap-4">
            @csrf
            
            <p>Choose a payment method:</p>

            <ul class="text-right">
                <li>
                    <label>
                        Direct bank transfer

                        <input type="radio" name="payment_method" value="direct_bank_transfer" required>                        
                    </label>
                </li>

                <li>
                    <label>                        
                        Paypal
            
                        <input type="radio" name="payment_method" value="paypal">
                    </label>
                </li>

                <li>
                    <label>
                        Cash

                        <input type="radio" name="payment_method" value="cash">
                    </label>
                </li>
            </ul>

            <x-ui.button class="col-span-2">Confirm</x-ui.button>
        </form>
    </x-ui.section>
</x-layout.app>