<button type="submit" {{ $attributes->merge(['class'=> 'px-4 py-2 bg-black text-white']) }}>
    {{ $slot }}
</button>