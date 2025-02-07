<section id="filtered-items">
    @if (!empty($items))
        @foreach($items as $item)
            @include('collection.singleResult')
        @endforeach
    @else
        <p>Item not found! 😱</p>
    @endif
</section>
