<section
    class="{{ $total % 10 < 6 && $total % 10 != 0 && $currentPage == $maxPage ? 'result__container__oneRow' : 'result__container__twoRows' }} item"
    id="results-container">
    @foreach($results as $result)
        @include('database.item.singleResult')
    @endforeach
    <p>
        @include('database.pageNavigation')
    </p>
</section>


