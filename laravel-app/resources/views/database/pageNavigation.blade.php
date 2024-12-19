<nav>
    <ul>
        <li>
            @if($currentPage == 1)
                <p title="First">⏪</p>
            @else
                <a href="#" class="page-link" data-page="1" title="First">⏪</a>
            @endif
        </li>
        <li>
            @if($currentPage == 1)
                <p title="Previous">◀️</p>
            @else
                <a href="#" class="page-link" data-page="{{ $currentPage - 1 }}" title="Previous">◀️</a>
            @endif
        </li>
        <li>{{ $currentPage }} / {{ $maxPage }}</li>
        <li>
            @if($currentPage == $maxPage)
                <p title="Next">▶️</p>
            @else
                <a href="#" class="page-link" data-page="{{ $currentPage + 1 }}" title="Next">▶️</a>
            @endif
        </li>
        <li>
            @if($currentPage == $maxPage)
                <p title="Last">⏩</p>
            @else
                <a href="#" class="page-link" data-page="{{ $maxPage }}" title="Last">⏩</a>
            @endif
        </li>
    </ul>
</nav>
