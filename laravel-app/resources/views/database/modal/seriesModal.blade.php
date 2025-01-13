<p><span class="modal__data__type">Title: </span>{{ $details['Title'] ?? 'Unknown title' }}</p>
<p><span class="modal__data__type">Type: </span>{{ $details['Type'] ?? 'Unknown type' }}</p>
    @if($details['totalSeasons'] == 1)
        <p><span class="modal__data__type">Total season: </span>1</p>
    @elseif($details['totalSeasons'] == 'N/A' || $details['totalSeasons'] > 1)
        <p><span class="modal__data__type">Total season: </span>{{ $details['totalSeasons'] }}</p>
    @endif
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
@if($details['totalSeasons'] > 1)
    <details>
        <summary>
            <span class="modal__data__type">Seasons: </span>
        </summary>
        <p>
            @for($x = 1; $x <= $details['totalSeasons']; $x++)
                <a href="#" class="detailsButton" data-id="{{ $details['imdbID'] }}" data-season="{{ $x }}">{{ $x }}</a>
            @endfor
        </p>
    </details>
@endif
