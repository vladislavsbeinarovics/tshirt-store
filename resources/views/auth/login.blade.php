<x-layout.app title="Login" class="grid place-items-center">

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="m-4">
            <label for="email" class="block">Email</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="m-4">
            <label for="password" class="block">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="m-4">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>

        <div class="m-4">
            <x-ui.button>Log in</x-ui.button>
        </div>
    </form>
</x-layout.app>