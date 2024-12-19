<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Home page of my MoviEasy app">
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
<main>
    <h1>Search in the full database:</h1>
    <article>
        <h1>Search and filter:</h1>
        <p>NOTE: The title or the exact id number is required, but if you search by id, all other search parameters will be ignored!</p>
        <form id="search-form" action="{{ route('database-search') }}" method="post">
            @csrf
            <fieldset>
                <legend>Search field</legend>
                <p>
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $filters['title'] ?? '') }}"
                           pattern="[A-Za-z0-9]{3,}" autofocus>
                    <span>(Minimum 3 character)</span>
                    @error('title')
                    <span>{{ $message }}</span>
                    @enderror
                </p>
                <p>
                    <label for="id">IMDB ID:</label>
                    <span>tt</span>
                    <input type="text" name="id" id="id" value="{{ old('id', $filters['id'] ?? '') }}" pattern=".{7,}">
                    <span>(at least 7 digit)</span>
                    @error('id')
                    <span>{{ $message }}</span>
                    @enderror
                </p>
            </fieldset>
            <fieldset>
                <legend>Filter field</legend>
                <p>
                    <label for="release">Year:</label>
                    <select name="release" id="release">
                        <option value="" {{ old('release', $filters['release'] ?? '') === '' ? 'selected' : '' }}>Choose
                            a year
                        </option>
                        @for ($release = 2024; $release >= 1894; $release--)
                            <option
                                value="{{ $release }}" {{ (string) old('release', $filters['release'] ?? '') === (string) $release ? 'selected' : '' }}>
                                {{ $release }}
                            </option>
                        @endfor
                    </select>
                </p>
                <p>
                    <input type="radio" name="type" id="movie" value="movie"
                        {{ old('type', $filters['type'] ?? '') == 'movie' ? 'checked' : '' }} />
                    <label for="movie">Movie</label>
                </p>
                <p>
                    <input type="radio" name="type" id="series" value="series"
                        {{ old('type', $filters['type'] ?? '') == 'series' ? 'checked' : '' }} />
                    <label for="series">Series</label>
                </p>
                <p>
                    <input type="radio" name="type" id="episode" value="episode"
                        {{ old('type', $filters['type'] ?? '') == 'episode' ? 'checked' : '' }} />
                    <label for="episode">Episode</label>
                </p>
                <p>
                    <input type="radio" name="type" id="all" value="all"
                        {{ old('type', $filters['type'] ?? '') == 'all' ? 'checked' : '' }} />
                    <label for="all">All</label>
                </p>
            </fieldset>
            <a href="{{ route('home') }}">Back</a>
            <a href="{{ route('database') }}">Clear</a>
            <a href="#" id="search-button">Search</a>
        </form>
    </article>
    <article>
        <h1>Result: {{ isset($results) ? '( ' . $total . ' item(s) )' : ' ' }}</h1>
        @if(isset($results))
            @if($total < 1)
                @if (isset($error))
                    <p>No result!</p>
                    <p>{{ $error }}</p>
                @else
                    @include('database.sortForm')
                    <p>No result!</p>
                @endif
            @else
                @include('database.sortForm')
                @include('database.results')
            @endif
        @else
            <p>Please provide correct search criterion(s)!</p>
        @endif
    </article>
</main>
<footer>
    @include('footer')
</footer>
</body>
</html>
