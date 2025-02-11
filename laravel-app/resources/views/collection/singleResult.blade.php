<section class="{{ $item[0]['onTheList'] ? 'green' : '' }}{{ $item[0]['favorite'] ? '__red' : '' }}{{ $item[0]['watchlist'] ? '__blue' : '' }}"
         id="modal-{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}">
    @if(empty($item[1]))
        <h1>{{ $item[0]['Title'] }}</h1>
        <figure>
            <img
                src="{{ $item[0]['Poster'] !== 'N/A' ? $item[0]['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
                alt="{{ $item[0]['Title'] ?? 'Unknown title' }}"
                width="100"
                height="100"
            />
            <figcaption>{{ $item[0]['Title'] ?? 'Unknown title' }}</figcaption>
        </figure>
    @else
        <h1>{{ $item[1]['Title'] . ' ' . $item[0]['Season'] . ' season'}}</h1>
        <figure>
            <img
                src="{{ $item[1]['Poster'] !== 'N/A' ? $item[1]['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
                alt="{{ $item[1]['Title'] ?? 'Unknown title' }}"
                width="100"
                height="100"
            />
            <figcaption >{{ $item[1]['Title'] ?? 'Unknown title' }}</figcaption>
        </figure>
    @endif

    <div>
        @if(isset($item[0]['Type']))
            @if($item[0]['Type'] == 'movie')
                @include('collection.card.movie', ['details' => $item[0]])
            @elseif($item[0]['Type'] == 'series')
                @include('collection.card.series', ['details' => $item[0]])
            @elseif($item[0]['Type'] == 'episode')
                @include('collection.card.episode', ['details' => $item[0]])
            @endif
        @else
            @include('collection.card.season', ['details' => $item[0], 'additionalData' => $item[1]])
        @endif
    </div>
    <p>
        <a data-action-name="modal-my-list"
           title="{{ $item[0]['onTheList'] ? 'Delete from my list' : 'Add to my list' }}"
           data-id='{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}' href="#">{{ $item[0]['onTheList'] ? '✅' : '➕' }} My list</a>
        @if($item[0]['onTheList'])
            <a data-action-name="modal-favorite"
               title="{{ $item[0]['favorite'] ? 'Delete from favorites' : 'Add to favorites' }}"
               data-id='{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}' href="#">{{ $item[0]['favorite'] ? '❤️' : '➕' }} Favorites</a>
            <a data-action-name="modal-watchlist"
               title="{{ $item[0]['watchlist'] ? 'Delete from watchlist' : 'Add to watchlist' }}"
               data-id='{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}' href="#">{{ $item[0]['watchlist'] ? '📺' : '➕' }} Watchlist</a>
        @endif
    </p>
</section>
