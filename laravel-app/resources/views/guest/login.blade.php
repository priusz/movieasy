<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Login page of my MoviEasy app">
    <title>Login</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon.png') }}" type="image/png" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header">
        <div class="header__left">
            <img class="header__img" src="{{ Vite::asset('resources/images/favicon.png') }}" alt="This is an image">
            <p class="header__p nowrap">Welcome, Human! Please log in 😎</p>
        </div>
        @include('navbar')
        @if(session('status'))
            <p id="status" class="header__p__status nowrap">{{ session('status') }}</p>
        @endif

        @if(session('error'))
            <p id="error" class="header__p__error nowrap">{{ session('error') }}</p>
        @endif
    </header>
    <main class="welcome">
        <article class="welcome__article article">
            <h2 class="article__h2">Login</h2>
            <form class="article__form form" action="{{ route('login') }}" method="post">
                @csrf
                <fieldset class="form__fieldset">
                    <legend class="offscreen">Login form</legend>
                    <p class="form__p">
                        <label class="form__label" for="email">Email:</label>
                        <input class="form__input" type="email" name="email" id="email" placeholder="Your email" value="{{ old('email') }}" required>
                        @error('email')
                        <span>{{ $message }}</span>
                        @enderror
                    </p>
                    <p class="form__p">
                        <label class="form__label" for="password">Password:</label>
                        <input class="form__input" type="password" name="password" id="password" placeholder="Your password" required>
                        @error('password')
                        <span>{{ $message }}</span>
                        @enderror
                    </p>
                </fieldset>
                <a class="form__button" href="{{ route('welcome') }}">Back</a>
                <a class="form__button" href="#" id="login-button">Login</a>
            </form>
        </article>
    </main>
    <footer>
        @include('footer')
    </footer>
</body>
</html>
