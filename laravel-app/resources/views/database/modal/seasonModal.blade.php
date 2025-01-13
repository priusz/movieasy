<p><span class="modal__data__type">Title: </span>{{ $additionalData['Title'] ?? 'Unknown title' }}</p>
<p><span class="modal__data__type">Type: </span>Season</p>
<p><span class="modal__data__type">Season: </span>{{ $season }} (Total: {{$details['totalSeasons']}})</p>
<p><span class="modal__data__type">Genre: </span>{{ $additionalData['Genre'] ?? 'Unknown genre' }}</p>
<p><span class="modal__data__type">Director: </span>{{ $additionalData['Director'] ?? 'Unknown director' }}</p>
<p><span class="modal__data__type">Writer: </span>{{ $additionalData['Writer'] ?? 'Unknown writer' }}</p>
<p><span class="modal__data__type">Actors: </span>{{ $additionalData['Actors'] ?? 'Unknown actors' }}</p>
<p><span class="modal__data__type">Language: </span>{{ $additionalData['Language'] ?? 'Unknown language' }}</p>
<p><span class="modal__data__type">Awards: </span>{{ $additionalData['Awards'] ?? 'Unknown awards' }}</p>
<details>
    <summary>
        <span class="modal__data__type">Episodes: </span>
    </summary>
    <p>
        @for($x = 0; $x < count($details['Episodes']); $x++)
            <a href="#" class="detailsButton" data-id="{{ $additionalData['imdbID'] }}"
               data-season="{{ $season }}" data-episode="{{ $x + 1 }}">{{ $details['Episodes'][$x]['Title'] }}</a>
        @endfor
    </p>
</details>
<details>
        <summary>
            <span class="modal__data__type">Other seasons: </span>
        </summary>
        <p>
            @for($x = 1; $x <= $details['totalSeasons']; $x++)
                @if($x == $season)
                    @continue;
                @endif
                <a href="#" class="detailsButton" data-id="{{ $additionalData['imdbID'] }}" data-season="{{ $x }}">{{ $x }}</a>
            @endfor
        </p>
</details>
