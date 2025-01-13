<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Database page of my MoviEasy app">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon.png') }}" type="image/png"/>

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
<main class="database">
    <h1 class="database__h1 nowrap">Search in the full database:</h1>
    <article class="database__article">
        <h1 class="search__h1 offscreen">Search and filter:</h1>
        <p class="search__note"><span class="note__span">NOTE:</span> The title or the exact id number is required, but if you search by id, all other search parameters will be ignored!</p>
        <form id="search-form" class="search__form" action="{{ route('database-search') }}" method="post">
            @csrf
            <fieldset class="search__fieldset search">
                <legend class="offscreen">Search field</legend>
                <p class="search__p">
                    <label class="search__label" for="title">Title:
                        @error('title')
                        <span class="search__span__error">{{ $message }}</span>
                        @enderror</label>
                    <input class="search__input" type="text" name="title" id="title" value="{{ old('title', $filters['title'] ?? '') }}"
                           pattern="[A-Za-z0-9]{3,}" placeholder="minimum 3 character" autofocus>
                </p>
                <p class="search__p">
                    <label class="search__label" for="id">IMDB ID:
                        @error('id')
                        <span class="search__span__error">{{ $message }}</span>
                        @enderror</label>
                    <input class="search__input search__id" type="text" name="id" id="id" value="{{ old('id', $filters['id'] ?? '') }}"
                           pattern=".{7,}" placeholder="starts with 'tt', followed by at least 7 digit">
                </p>
            </fieldset>
            <fieldset class="filter_fieldset filter">
                <legend class="offscreen">Filter year field</legend>
                <p class="filter__p">
                    <label class="filter__label" for="release">Year:</label>
                    <select class="filter__select" name="release" id="release">
                        <option class="filter__option" value="" {{ old('release', $filters['release'] ?? '') === '' ? 'selected' : '' }}>Choose
                            a year
                        </option>
                        @for ($release = 2025; $release >= 1894; $release--)
                            <option class="filter__option"
                                value="{{ $release }}" {{ (string) old('release', $filters['release'] ?? '') === (string) $release ? 'selected' : '' }}>
                                {{ $release }}
                            </option>
                        @endfor
                    </select>
                </p>
            </fieldset>
            <fieldset class="filter_fieldset filter">
                <legend class="offscreen">Filter type field</legend>
                <p class="filter__p">
                    <input class="filter__input" type="radio" name="type" id="movie" value="movie"
                        {{ old('type', $filters['type'] ?? '') == 'movie' ? 'checked' : '' }} />
                    <label class="filter__label" for="movie">Movie</label>
                </p>
                <p class="filter__p">
                    <input class="filter__input" type="radio" name="type" id="series" value="series"
                        {{ old('type', $filters['type'] ?? '') == 'series' ? 'checked' : '' }} />
                    <label class="filter__label" for="series">Series</label>
                </p>
                <p class="filter__p">
                    <input class="filter__input" type="radio" name="type" id="episode" value="episode"
                        {{ old('type', $filters['type'] ?? '') == 'episode' ? 'checked' : '' }} />
                    <label class="filter__label" for="episode">Episode</label>
                </p>
                <p class="filter__p">
                    <input class="filter__input" type="radio" name="type" id="all" value="all"
                        {{ old('type', $filters['type'] ?? '') == 'all' ? 'checked' : '' }} />
                    <label class="filter__label" for="all">All</label>
                </p>
            </fieldset>
        </form>
        <p class="search__buttons">
            <a class="form__button" href="{{ route('home') }}">Back</a>
            <a class="form__button" href="{{ route('database') }}">Clear</a>
            <a class="form__button" href="#" id="search-button">Search</a>
        </p>
    </article>
    <article class="database__article result">
        <h1 class="result__h1">Result: {{ isset($results) ? '( ' . $total . ' item(s) )' : ' ' }}</h1>
        @if(isset($results))
            @if($total < 1)
                @if (isset($error))
                    <p class="result__noResult">No result!</p>
                    <p class="result__error">{{ $error }}</p>
                @else
                    @include('database.sortForm')
                    <p class="result__noResult">No result!</p>
                @endif
            @elseif (count(session("allResults")) == 1)
                @include('database.results')
            @else
                @include('database.sortForm')
                @include('database.results')
            @endif
        @else
            <p class="result__noResult">Please provide correct search criterion(s)!</p>
        @endif
    </article>
    <article id="movieDetailsModal" class="modal" style="display: none;">
        <div class="modal__content">
            <a class="close-button" href="#">❌</a>
            <div id="modalBody"></div>
        </div>
    </article>
</main>
<footer>
    @include('footer')
</footer>
</body>
</html>
