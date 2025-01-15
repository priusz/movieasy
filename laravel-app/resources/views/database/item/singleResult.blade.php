<section class="item__card" id="{{ $result['imdbID'] }}">
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
        <a class="item__action__button" data-action-id="item-my-list"
           title="{{ $result['onTheList'] ? 'Delete from my list' : 'Add to my list' }}"
           data-id='{{ $result['imdbID'] }}' href="#">{{ $result['onTheList'] ? '✅' : '➕' }}  My list</a>
        <a class="item__action__button" data-action-id="item-favorite"
           data-id='{{ $result['imdbID'] }}' href="#">➕ ❤️ Favorite</a>
        <a class="item__action__button" data-action-id="item-watchlist"
           data-id='{{ $result['imdbID'] }}' href="#">➕ 📺 Watchlist</a>
        <a href="#" class="detailsButton"
           data-id="{{ $result['imdbID'] }}">📰 Details</a>
    </p>

    <p class="item__title">{{ $result['Title'] ?? 'Unknown title' }} ({{ $result['Year'] ?? 'Unknown year' }})</p>
</section>
