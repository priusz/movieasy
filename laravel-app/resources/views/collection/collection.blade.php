<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Collection page of my MoviEasy app">
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
<main>
    <h1>My collection:</h1>
    <article>
        <h1>Search and filter:</h1>
        <form>
            @csrf
            <fieldset >
                <legend>Search field</legend>
                <p>
                    <label for="title">Title:
                        @error('title')
                        <span class="search__span__error">{{ $message }}</span>
                        @enderror</label>
                    <input type="text" name="title" id="title">
                </p>
            </fieldset>
            <fieldset>
                <legend>Filter list type field</legend>
                <p>
                    <input type="radio" name="list-type" id="all" value="all"/>
                    <label for="all">All</label>
                </p>
                <p>
                    <input type="radio" name="list-type" id="favorite" value="favorite"/>
                    <label for="favorite">Favorite</label>
                </p>
                <p>
                    <input type="radio" name="list-type" id="watchlist" value="watchlist"/>
                    <label for="watchlist">Watchlist</label>
                </p>
                <p>
                    <input type="radio" name="list-type" id="both" value="both"/>
                    <label for="both">Favorite & Watchlist</label>
                </p>

            </fieldset>
            <fieldset>
                <legend>Filter type field</legend>
                <p>
                    <input type="radio" name="type" id="all" value="all"/>
                    <label for="all">All</label>
                </p>
                <p>
                    <input type="radio" name="type" id="movie" value="movie"/>
                    <label for="movie">Movie</label>
                </p>
                <p>
                    <input type="radio" name="type" id="series" value="series"/>
                    <label for="series">Series</label>
                </p>
                <p>
                    <input type="radio" name="type" id="season" value="season"/>
                    <label for="season">Season</label>
                </p>
                <p>
                    <input type="radio" name="type" id="episode" value="episode"/>
                    <label for="episode">Episode</label>
                </p>
            </fieldset>
            <p>
                <a href="#">Title A-Z</a>
            </p>
        </form>
        <p class="search__buttons">
            <a class="form__button" href="{{ route('home') }}">Home</a>
            <a class="form__button" href="{{ route('collection') }}">Clear</a>
        </p>
    </article>
    <article>
        <h1>All:</h1>
        @if(!empty($items))
            @include('collection.results')
        @else
            <p>Empty collection! 😱 Let's add some items before you visit here! </p>
        @endif
    </article>
</main>
<footer>
    @include('footer')
</footer>
</body>
</html>
