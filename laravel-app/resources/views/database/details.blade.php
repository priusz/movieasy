<section class="modal__card" id="{{ $details['imdbID'] }}">
    <h1 class="modal__h1">Details of {{ $details['Title'] }}</h1>
    <figure class="modal__img">
        <img
            src="{{ $details['Poster'] !== 'N/A' ? $details['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
            alt="{{ $details['Title'] ?? 'Unknown title' }}"
            width="100"
            height="100"
        />
        <figcaption class="offscreen">{{ $details['Title'] ?? 'Unknown title' }}</figcaption>
    </figure>
    <div class="modal__data">
        <p><span class="modal__data__type">Title: </span>{{ $details['Title'] ?? 'Unknown title' }}</p>
        <p><span class="modal__data__type">Type: </span>{{ $details['Type'] ?? 'Unknown type' }}</p>
        <p><span class="modal__data__type">Year: </span>{{ $details['Year'] ?? 'Unknown year' }}</p>
        <p><span class="modal__data__type">Runtime: </span>{{ $details['Runtime'] ?? 'Unknown runtime' }}</p>
        <p><span class="modal__data__type">Released: </span>{{ $details['Released'] ?? 'Unknown release date' }}</p>
        <p><span class="modal__data__type">Genre: </span>{{ $details['Genre'] ?? 'Unknown genre' }}</p>
        <p><span class="modal__data__type">Director: </span>{{ $details['Director'] ?? 'Unknown director' }}</p>
        <p><span class="modal__data__type">Writer: </span>{{ $details['Writer'] ?? 'Unknown writer' }}</p>
        <p><span class="modal__data__type">Actors: </span>{{ $details['Actors'] ?? 'Unknown actors' }}</p>
        <p><span class="modal__data__type">Language: </span>{{ $details['Language'] ?? 'Unknown language' }}</p>
        <p><span class="modal__data__type">Awards: </span>{{ $details['Awards'] ?? 'Unknown awards' }}</p>
        <p><span class="modal__data__type">IMDB Rating: </span>{{ $details['imdbRating'] ?? 'Unknown IMDB rating' }}</p>
        <p><span class="modal__data__type">IMDB Votes: </span>{{ $details['imdbVotes'] ?? 'Unknown IMDB votes' }}</p>
        <p><span class="modal__data__type">IMDB ID: </span>{{ $details['imdbID'] ?? 'Unknown IMDB ID' }}</p>
        <details>
            <summary>
                <span class="modal__data__type">Plot: </span>
            </summary>
            <p>
                {{ $details['Plot'] ?? 'Unknown plot' }}
            </p>
        </details>
    </div>
    <p class="modal__action">
        <a class="modal__action__button" href="#">🖤 ❤️ Favorite</a>
        <a class="modal__action__button" href="#">➕ ✅ My list</a>
    </p>
</section>
