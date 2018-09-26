@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-6 block">
            <h2>登録アーティスト</h2>
            <ul class="register-list">
            @foreach(Auth::user()->artists as $artist)
                    <li><a href="{{ route('artist.show', $artist) }}">{{ $artist->name }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection

@include('layouts.sidebar')
