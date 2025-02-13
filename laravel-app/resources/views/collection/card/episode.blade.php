<p><span>Title: </span>{{ $details['Title'] ?? 'Unknown title' }}</p>
<p><span>Type: </span>{{ $details['Type'] ?? 'Unknown type' }}</p>
<p><span>Season: </span>{{ $details['Season'] ?? 'Unknown season' }}</p>
<p><span>Episode: </span>{{ $details['Episode'] ?? 'Unknown episode' }}</p>
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
