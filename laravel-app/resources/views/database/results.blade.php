<section id="results-container">
    @foreach($results as $result)
        <section id="{{ $result['imdbID'] }}">
            <figure>
                <img
                    src="{{ $result['Poster'] !== 'N/A' ? $result['Poster'] : Vite::asset('resources/images/no-poster.png') }}"
                    alt="{{ $result['Title'] ?? 'Unknown title' }}"
                    width="100"
                    height="100"
                />
                <figcaption>{{ $result['Title'] ?? 'Unknown title' }}</figcaption>
            </figure>
            <p>Year: {{ $result['Year'] ?? 'Unknown year' }}</p>
            <p>
                <a href="#">💕</a>
                <a href="#">✅</a>
                <a href="#">Show details</a>
            </p>
        </section>
    @endforeach
        @include('database.pageNavigation')
</section>
