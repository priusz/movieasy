<section class="item__card {{ $result['onTheList'] ? 'green' : '' }}{{ $result['onTheList'] && $result['favorite'] ? '__red' : '' }}{{ $result['onTheList'] && $result['watchlist'] ? '__blue' : '' }}" id="{{ $result['imdbID'] }}">
    <figure class="item__image">
        <img
            src="{{ $result['Poster'] !== 'N/A' ? $result['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
            alt="{{ $result['Title'] ?? 'Unknown title' }}"
            width="100"
            height="100"
        />
        <figcaption class="offscreen">{{ $result['Title'] ?? 'Unknown title' }}</figcaption>
    </figure>
    <p class="item__actions">
        <a class="item__action__button" data-action-name="item-my-list"
           title="{{ $result['onTheList'] ? 'Delete from my list' : 'Add to my list' }}"
           data-id='{{ $result['imdbID'] }}' href="#">{{ $result['onTheList'] ? '✅' : '➕' }} My list</a>
        @if($result['onTheList'])
            <a class="item__action__button" data-action-name="item-favorite"
               title="{{ $result['favorite'] ? 'Delete from favorites' : 'Add to favorites' }}"
               data-id='{{ $result['imdbID'] }}' href="#">{{ $result['favorite'] ? '❤️' : '➕' }} Favorite</a>
            <a class="item__action__button" data-action-name="item-watchlist"
               title="{{ $result['watchlist'] ? 'Delete from watchlist' : 'Add to watchlist' }}"
               data-id='{{ $result['imdbID'] }}' href="#">{{ $result['watchlist'] ? '📺' : '➕' }} Watchlist</a>
        @endif
        <a href="#" class="detailsButton"
           data-id="{{ $result['imdbID'] }}">📰 Details</a>
    </p>

    <p class="item__title">{{ $result['Title'] ?? 'Unknown title' }} ({{ $result['Year'] ?? 'Unknown year' }})</p>
</section>
