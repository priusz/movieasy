<section class="{{ $total / 10 < 6 && $currentPage == $maxPage ? 'result__container__oneRow' : 'result__container__twoRows' }} item" id="results-container">
    @foreach($results as $result)
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
                <a class="item__action__button" href="#">🖤 ❤️ Favorite</a>
                <a class="item__action__button" href="#">➕ ✅ My list</a>
                <a href="#" class="detailsButton item__action__button" data-id="{{ $result['imdbID'] }}">📰 Details</a>
            </p>
            <p class="item__title">{{ $result['Title'] ?? 'Unknown title' }} ({{ $result['Year'] ?? 'Unknown year' }})</p>
        </section>
    @endforeach
        <p>
            @include('database.pageNavigation')
        </p>
</section>


