<form class="form-inline" url="{{ route('artist.index') }}" method="get">
    <input class="form-control" name="artist_search" type="text" placeholder="検索ワード" value="{{ request()->artist_search }}">
    <input class="btn btn-primary" type="submit" value="検索">
</form>
