@extends('layouts.app')
 
@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <form class="form-control" url="{{ route('artist.index') }}" method="get">
                <input class="form-control" name="artist_search" type="text" placeholder="検索ワードを入力してください">
                <input class="btn btn-primary" type="submit" value="検索">
            </form>
        </div>
        <div class="col-md-9">
            <p>コンテンツ内容が入ります</p>
            <div class="row">
                @foreach($artists as $artist)
                    <div class="col-md-3 block border">
                        <p><a href="{{ route('artist.show', $artist) }}">{{ $artist->name }}</a></p>
                        <p>{{ $artist->content }}</p>
                        <p><a href="{{ $artist->url }}">アーティストページへ</a></p>
                        <img class="logo" src="/storage/{{ $artist->image }}" alt="logo" width="150px" height="150px">
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $artists->links() }}
            </div>
        </div>
    </div>
@endsection
 
@include('layouts.footer')
