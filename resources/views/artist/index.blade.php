@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-9">
            {{ Breadcrumbs::render('Home') }}
            <div class="row">
                @foreach($artists as $artist)
                    <div class="col-md-3 block border">
                        <a href="{{ route('artist.show', $artist) }}">
                            <img class="logo" src="/storage/{{ $artist->image }}" alt="logo" width="150px" height="150px">
                            <p>{{ $artist->name }}</p>
                        </a>
                        <p><a href="{{ $artist->url }}" target="_blank">アーティストページへ</a></p>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $artists->links() }}
            </div>
        </div>
        <div class="col-md-3">
            @include('layouts.rightbar')
        </div>
    </div>
@endsection

@include('layouts.footer')
