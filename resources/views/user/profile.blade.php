@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-12 block">
            <h2>{{ Auth::user()->name }}</h2>
            <h2>登録アーティスト</h2>
            @foreach(Auth::user()->artists as $artist)
                <a href="{{ route('artist.show', $artist) }}"><p>{{ $artist->name }}</p></a>
            @endforeach
        </div>
    </div>
@endsection

@include('layouts.footer')
