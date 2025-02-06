<p><span>Title: </span>{{ $details['Title'] ?? 'Unknown title' }}</p>
<p><span id="modal-data-type" data-value="{{ $details['Type'] ?? 'Unknown type' }}">Type: </span>{{ $details['Type'] ?? 'Unknown type' }}</p>
@if($details['totalSeasons'] == 1)
    <p><span>Total season: </span>1</p>
@elseif($details['totalSeasons'] == 'N/A' || $details['totalSeasons'] > 1)
    <p><span>Total season: </span>{{ $details['totalSeasons'] }}</p>
@endif
<p><span>Year: </span>{{ $details['Year'] ?? 'Unknown year' }}</p>
<p><span>Runtime: </span>{{ $details['Runtime'] ?? 'Unknown runtime' }}</p>
<p><span>Released: </span>{{ $details['Released'] ?? 'Unknown release date' }}</p>
<p><span>Genre: </span>{{ $details['Genre'] ?? 'Unknown genre' }}</p>
<p><span>Director: </span>{{ $details['Director'] ?? 'Unknown director' }}</p>
<p><span>Writer: </span>{{ $details['Writer'] ?? 'Unknown writer' }}</p>
<p><span>Actors: </span>{{ $details['Actors'] ?? 'Unknown actors' }}</p>
<p><span>Language: </span>{{ $details['Language'] ?? 'Unknown language' }}</p>
<p><span>Awards: </span>{{ $details['Awards'] ?? 'Unknown awards' }}</p>
<p><span>IMDB Rating: </span>{{ $details['imdbRating'] ?? 'Unknown IMDB rating' }}</p>
<p><span>IMDB Votes: </span>{{ $details['imdbVotes'] ?? 'Unknown IMDB votes' }}</p>
<p><span>IMDB ID: </span>{{ $details['imdbID'] ?? 'Unknown IMDB ID' }}</p>
<details>
    <summary>
        <span>Plot: </span>
    </summary>
    <p>
        {{ $details['Plot'] ?? 'Unknown plot' }}
    </p>
</details>
@if($details['totalSeasons'] != 'N/A' && $details['totalSeasons'] > 1)
    <details>
        <summary>
            <span>Seasons: </span>
        </summary>
        <p>
            @for($x = 1; $x <= $details['totalSeasons']; $x++)
                <a href="#" data-id="{{ $details['imdbID'] }}" data-season="{{ $x }}">{{ $x }}. season</a>
            @endfor
        </p>
    </details>
@endif
