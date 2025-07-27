<header class="text-xl p-4 border-b items-center grid grid-cols-2 sm:grid-cols-3">
    <a href="{{ route('home') }}">HOME</a>

    <nav class="hidden text-center sm:block">
        <a href="{{ route('shop.index') }}">SHOP</a>
    </nav>

    <nav class="text-right">
        @guest
            <a href="{{ route('login') }}">LOG-IN</a>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button>LOG-OUT</button>
            </form>            
        @endauth

        <a href="{{ dynamic_route('cart', 'index') }}">CART</a>
    </nav>
</header>