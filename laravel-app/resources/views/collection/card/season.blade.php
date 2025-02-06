<p><span>Title: </span>{{ $additionalData['Title'] ?? 'Unknown title' }}</p>
<p><span id="modal-data-type" data-value="season">Type: </span>Season</p>
<p><span id="modal-data-season" data-value="{{ $season }}">Season: </span>{{ $season }} (Total: {{$details['totalSeasons']}})</p>
<p><span>Genre: </span>{{ $additionalData['Genre'] ?? 'Unknown genre' }}</p>
<p><span>Director: </span>{{ $additionalData['Director'] ?? 'Unknown director' }}</p>
<p><span>Writer: </span>{{ $additionalData['Writer'] ?? 'Unknown writer' }}</p>
<p><span>Actors: </span>{{ $additionalData['Actors'] ?? 'Unknown actors' }}</p>
<p><span>Language: </span>{{ $additionalData['Language'] ?? 'Unknown language' }}</p>
<p><span>Awards: </span>{{ $additionalData['Awards'] ?? 'Unknown awards' }}</p>
<details>
    <summary>
        <span>Episodes: </span>
    </summary>
    <p>
        @for($x = 0; $x < count($details['Episodes']); $x++)
            <a href="#" class="detailsButton" data-id="{{ $additionalData['imdbID'] }}"
               data-season="{{ $season }}" data-episode="{{ $x + 1 }}">
                {{ $x + 1 }}. {{ $details['Episodes'][$x]['Title'] }}</a>
        @endfor
    </p>
</details>
<details>
    <summary>
        <span>Other seasons: </span>
    </summary>
    <p>
        @for($x = 1; $x <= $details['totalSeasons']; $x++)
            @if($x == $season)
                @continue;
            @endif
            <a href="#" data-id="{{ $additionalData['imdbID'] }}" data-season="{{ $x }}">{{ $x }}. season</a>
        @endfor
    </p>
</details>
