<form class="sort__form sort" id="sort-form" action="{{ route('database-sort') }}" method="post">
    @csrf
    <fieldset class="sort__fieldset">
        <legend class="offscreen">Sorting field:</legend>
        <p>
            <input type="hidden" name="title" value="{{ old('title', $filters['title'] ?? '') }}">
            <input type="hidden" name="id" value="{{ old('id', $filters['id'] ?? '') }}">
            <input type="hidden" name="release"
                   value="{{ old('release', $filters['release'] ?? '') }}">
            <input type="hidden" name="type" value="{{ old('type', $filters['type'] ?? '') }}">
        </p>
        <p class="sort__sort">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort-button">
                <option value="">Choose...</option>
                <option value="asc-title" {{ request('sort') == 'asc-title' ? 'selected' : '' }}>
                    Title A-Z
                </option>
                <option value="desc-title" {{ request('sort') == 'desc-title' ? 'selected' : '' }}>
                    Title Z-A
                </option>
                <option
                    value="asc-release" {{ request('sort') == 'asc-release' ? 'selected' : '' }}>
                    Year <
                </option>
                <option
                    value="desc-release" {{ request('sort') == 'desc-release' ? 'selected' : '' }}>
                    Year >
                </option>
            </select>
        </p>
        <p class="sort__poster">
            <input type="checkbox" name="poster" id="poster-button" value="poster"
                {{ request('poster') == 'poster' ? 'checked' : '' }}/>
            <label for="poster">Results with poster</label>
        </p>
    </fieldset>
</form>
