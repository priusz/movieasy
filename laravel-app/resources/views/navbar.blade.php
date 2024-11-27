<nav class="header__nav">
    <ul class="header__ul">
        @if(auth()->check())
{{--            <li>--}}
{{--                <a href="{{ route('welcome') }}">Home</a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('logout') }}" id="logout-button" data-url={{ route('logout') }}>Logout</a>
            </li>
        @else
            <li>
                <a href="{{ route('welcome') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('login') }}">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}">Register</a>
            </li>
        @endif
    </ul>
</nav>
