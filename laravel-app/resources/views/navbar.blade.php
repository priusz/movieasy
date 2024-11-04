<div class="top-right">
    @if(auth()->check())
        <a href="{{ route('logout') }}" class="button">Logout</a>
    @else
        <a href="{{ route('login') }}" class="button">Login</a>
        <a href="{{ route('register') }}" class="button">Register</a>
    @endif
</div>
