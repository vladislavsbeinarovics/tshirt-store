<x-layout.app title="Shop" class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    @foreach ($products as $product)
        <a href="{{ route('shop.show', $product) }}" class="border p-2">
            <img 
                src="{{ asset('storage/products/' . $product->image_path) }}"
                alt="{{ $product->name }}"
                class="w-full"
            >

            <p>{{ $product->name }}</p>
            <p class="text-xs">{{ $product->gender }}</p>
            <p class="text-lg">{{ $product->price }}</p>
        </a>   
    @endforeach

    <div class="col-span-1 sm:col-span-3">
        {{ $products->links() }}
    </div>
</x-layout.app>