<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Welcome page of my MoviEasy app">
    <title> MoviEasy</title>
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
        <h1 class="welcome__h1">MoviEasy</h1>
        <p class="welcome__p nowrap">... for movie and series l❤vers</p>
    </main>
    <footer>
        @include('footer')
    </footer>
</body>
</html>
