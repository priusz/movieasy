<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Home page of my MoviEasy app">
    <title>Home</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon.png') }}" type="image/png" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <header class="header">
        <div class="header__left">
            <img class="header__img" src="{{ Vite::asset('resources/images/favicon.png') }}" alt="This is an image">
            <p class="header__p nowrap">Nice to see you again, {{ auth()->user()->name }}! 😎</p>
        </div>
        @include('navbar')
        @if(session('status'))
            <p id="status" class="header__p__status nowrap">{{ session('status') }}</p>
        @endif

        @if(session('error'))
            <p id="error" class="header__p__error nowrap">{{ session('error') }}</p>
        @endif
    </header>
    <main class="home">
        <article class="home__article quote">
            <h2 id="quote-text" class="quote__h2 nowrap">{{ $quote->quote }}</h2>
            <p id="quote-saidBy" class="quote__p nowrap">{{ $quote->said_by }}</p>
        </article>
        <article class="home__article recommend">
            <h1 class="recommend__h1 nowrap">What do you want to do?</h1>
            <section class="recommend__section">
                <h2 class="recommend__h2">Let's browse through the
                    <a class="recommend__a" href={{ route('database') }}>Database</a>
                </h2>
            </section>
            <section class="recommend__section">
                <h2 class="recommend__h2">I'll take a look at my own
                    <a class="recommend__a" href={{ route('collection') }}>Collection</a>
                </h2>
            </section>
        </article>
    </main>
    <footer>
        @include('footer')
    </footer>
</body>
</html>
