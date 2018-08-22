@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <p>プロフィール</p>
            <div class="row">
                <div class="col-md-12 block border">
                    <p>{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                    <h2>アーティスト一覧</h2>
                    @foreach(Auth::user()->artists as $artist)
                        <p>{{ $artist->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
 
@include('layouts.footer')
