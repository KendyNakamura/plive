    <div class="row">
        <div class="col-12">
            <form class="form-control" url="{{ route('artist.index') }}" method="get">
                <input class="form-control" name="artist_search" type="text" placeholder="検索ワードを入力してください">
                <input class="btn btn-primary" type="submit" value="検索">
            </form>
        </div>
    </div>
