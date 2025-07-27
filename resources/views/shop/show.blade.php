<x-layout.app title="{{ $product->name }}" class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <img src="{{ $product->image_url }}" class="w-full h-full col-span-1 sm:col-span-2">
   
    <div class="flex flex-col gap-4">
        <h1 class="text-4xl">{{ $product->name }}</h1>
        
        <p>{{ $product->gender }}</p>
            
        <p>{{ $product->color }}</p>

        <p class="text-2xl">{{ $product->price }}</p>

        @if (session('success'))
            <p class="text-green-500">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ dynamic_route('cart', 'add') }}">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

            <x-ui.button>Add to cart</x-ui.button>
        </form>
    </div>

    <section class="col-span-full flex flex-col gap-4">
        <h2 class="text-4xl">Description</h2>
        <p>{{ $product->description }}</p>
    </section>
</x-layout.app>