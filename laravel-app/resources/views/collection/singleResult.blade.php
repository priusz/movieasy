<section class="{{ $item[0]['onTheList'] ? 'green' : '' }}{{ $item[0]['favorite'] ? '__red' : '' }}{{ $item[0]['watchlist'] ? '__blue' : '' }}"
         id="{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}">
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
    @if($item[0]['onTheList'] === true)
        <p>
            <a data-action-name="collection-my-list"
               class="collection__action__button"
               title="Delete from my list"
               data-id='{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}'
               data-type='{{ $item[0]['Type'] ?? 'season' }}'
               data-season="{{ isset($item[0]['Type']) && ($item[0]['Type'] == 'movie' || $item[0]['Type'] == 'series') ? 0 : $item[0]['Season']}}"
               data-episode="{{ isset($item[0]['Type']) && $item[0]['Type'] == 'episode' ? $item[0]['Episode'] : 0}}"
               href="#">Delete from my list</a>
            <a data-action-name="collection-favorite"
               class="collection__action__button"
               title="{{ $item[0]['favorite'] ? 'Delete from favorites' : 'Add to favorites' }}"
               data-id='{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}'
               data-type='{{ $item[0]['Type'] ?? 'season' }}'
               data-season="{{ isset($item[0]['Type']) && ($item[0]['Type'] == 'movie' || $item[0]['Type'] == 'series') ? 0 : $item[0]['Season']}}"
               data-episode="{{ isset($item[0]['Type']) && $item[0]['Type'] == 'episode' ? $item[0]['Episode'] : 0}}"
               href="#">{{ $item[0]['favorite'] ? '❤️' : '➕' }} Favorites</a>
            <a data-action-name="collection-watchlist"
               class="collection__action__button"
               title="{{ $item[0]['watchlist'] ? 'Delete from watchlist' : 'Add to watchlist' }}"
               data-id='{{ isset($item[0]['Type']) && $item[0]['Type'] === 'episode' ? $item[0]['seriesID'] : $item[0]['imdbID'] }}'
               data-type='{{ $item[0]['Type'] ?? 'season' }}'
               data-season="{{ isset($item[0]['Type']) && ($item[0]['Type'] == 'movie' || $item[0]['Type'] == 'series') ? 0 : $item[0]['Season']}}"
               data-episode="{{ isset($item[0]['Type']) && $item[0]['Type'] == 'episode' ? $item[0]['Episode'] : 0}}"
               href="#">{{ $item[0]['watchlist'] ? '📺' : '➕' }} Watchlist</a>
        </p>
    @endif
</section>
