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
<main>
    <h1>Search in the full database:</h1>
    <article>
        <h1>Search and filter:</h1>
        <p>NOTE 1: The title or the exact id number is required, but not both of them!</p>
        <p>NOTE 2: If you search by id, all other search parameters will be ignored!</p>
        <form action="{{ route('database-search') }}" method="post">
            @csrf
            <fieldset>
                <legend>Search field</legend>
                <p>
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $filters['title'] ?? '') }}" pattern="[A-Za-z0-9]{3,}" autofocus>
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
                        <option value="" {{ old('release', $filters['release'] ?? '') === '' ? 'selected' : '' }}>Choose a year</option>
                        @for ($release = 2024; $release >= 1894; $release--)
                            <option value="{{ $release }}" {{ (string) old('release', $filters['release'] ?? '') === (string) $release ? 'selected' : '' }}>
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
                <p>No result!</p>
                <p>{{ $error }}</p>
            @else
                @if($total > 1)
                    <form id="filterForm" action="{{ route('database-filter') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Sorting field:</legend>
                            <p>
                                <input type="hidden" name="title" value="{{ old('title', $filters['title'] ?? '') }}">
                                <input type="hidden" name="id" value="{{ old('id', $filters['id'] ?? '') }}">
                                <input type="hidden" name="release" value="{{ old('release', $filters['release'] ?? '') }}">
                                <input type="hidden" name="type" value="{{ old('type', $filters['type'] ?? '') }}">
                            </p>
                            <p>
                                <label for="sort">Sort by:</label>
                                <select name="sort" id="sort" onchange="document.getElementById('filterForm').submit();">
                                    <option value="">Choose...</option>
                                    <option value="asc-title" {{ request('sort') == 'asc-title' ? 'selected' : '' }}>Title A-Z</option>
                                    <option value="desc-title" {{ request('sort') == 'desc-title' ? 'selected' : '' }}>Title Z-A</option>
                                    <option value="asc-release" {{ request('sort') == 'asc-release' ? 'selected' : '' }}>Year <</option>
                                    <option value="desc-release" {{ request('sort') == 'desc-release' ? 'selected' : '' }}>Year ></option>
                                    <option value="asc-rating" {{ request('sort') == 'asc-rating' ? 'selected' : '' }}>IMDB rating <</option>
                                    <option value="desc-rating" {{ request('sort') == 'desc-rating' ? 'selected' : '' }}>IMDB rating ></option>
                                    <option value="asc-runtime" {{ request('sort') == 'asc-runtime' ? 'selected' : '' }}>Runtime <</option>
                                    <option value="desc-runtime" {{ request('sort') == 'desc-runtime' ? 'selected' : '' }}>Runtime ></option>
                                </select>
                            </p>
                            <p>
                                <input type="checkbox" name="poster" id="poster" value="poster"
                                    {{ request('poster') == 'poster' ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit();"/>
                                <label for="poster">Results with poster</label>
                            </p>
                        </fieldset>
                    </form>
                @endif

                @foreach($results as $result)
                    <section id="{{ $result['imdbID'] }}">
                        <figure>
                            <img
                                src="{{ $result['Poster'] !== 'N/A' ? $result['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
                                alt="{{ $result['Title'] ?? 'Unknown title' }}"
                                width="100"
                                height="100"
                            />
                            <figcaption>{{ $result['Title'] ?? 'Unknown title' }}</figcaption>
                        </figure>
                        <details>
                            <summary>Plot:</summary>
                            <p>Plot: {{ $result['Plot'] ?? 'Unknown plot' }}</p>
                        </details>
                        <p>Year: {{ $result['Year'] ?? 'Unknown year' }}</p>
                        <p>Id: {{ $result['imdbID'] ?? 'Unknown ID' }}</p>
                    </section>
                @endforeach
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
