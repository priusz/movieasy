<p><span class="modal__data__type">Title: </span>{{ $details['Title'] ?? 'Unknown title' }}</p>
<p><span class="modal__data__type" id="modal-data-type" data-value="{{ $details['Type'] ?? 'Unknown type' }}">Type: </span>{{ $details['Type'] ?? 'Unknown type' }}</p>
<p><span class="modal__data__type" id="modal-data-season" data-value="{{ $details['Season'] ?? 'Unknown season' }}">Season: </span>{{ $details['Season'] ?? 'Unknown season' }}</p>
<p><span class="modal__data__type" id="modal-data-episode" data-value="{{ $details['Episode'] ?? 'Unknown episode' }}">Episode: </span>{{ $details['Episode'] ?? 'Unknown episode' }}</p>
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
    <p class="details__p">
        {{ $details['Plot'] ?? 'Unknown plot' }}
    </p>
</details>
<p class="details__p show__season__series__container">
    <a href="#" class="detailsButton show__season__button" data-id="{{ $details['seriesID'] }}"
       data-season="{{ $details['Season'] }}">Season details</a>
    <a href="#" class="detailsButton show__series__button" data-id="{{ $details['seriesID'] }}">Series details</a>
</p>
