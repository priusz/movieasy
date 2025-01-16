<section class="modal__card" id="{{ isset($details['imdbID']) ??
    $additionalData['imdbID'] }}">
    @if(empty($additionalData))
        <h1 class="modal__h1">Details of {{ $details['Title'] }}</h1>
        <figure class="modal__img">
            <img
                src="{{ $details['Poster'] !== 'N/A' ? $details['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
                alt="{{ $details['Title'] ?? 'Unknown title' }}"
                width="100"
                height="100"
            />
            <figcaption class="offscreen">{{ $details['Title'] ?? 'Unknown title' }}</figcaption>
        </figure>
    @else
        <h1 class="modal__h1">Details of {{ $additionalData['Title'] . ' ' . $season . ' season'}}</h1>
        <figure class="modal__img">
            <img
                src="{{ $additionalData['Poster'] !== 'N/A' ? $additionalData['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
                alt="{{ $additionalData['Title'] ?? 'Unknown title' }}"
                width="100"
                height="100"
            />
            <figcaption class="offscreen">{{ $additionalData['Title'] ?? 'Unknown title' }}</figcaption>
        </figure>
    @endif

    <div class="modal__data">
        @if(isset($details['Type']))
            @if($details['Type'] == 'movie')
                @include('database.modal.movieModal')
            @elseif($details['Type'] == 'series')
                @include('database.modal.seriesModal')
            @elseif($details['Type'] == 'episode')
                @include('database.modal.episodeModal')
            @endif
        @else
            @include('database.modal.seasonModal')
        @endif
    </div>
    <p class="modal__action">
        <a class="modal__action__button" href="#">➕ ✅ My list</a>
        <a class="modal__action__button" href="#">➕ ❤️ Favorite</a>
        <a class="modal__action__button" href="#">➕ 📺 Watchlist</a>
    </p>
</section>
