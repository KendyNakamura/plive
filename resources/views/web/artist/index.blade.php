@extends('web.layouts.app')

@include('web.layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render('Home') }}
            <div class="row">
                @foreach($artists as $artist)
                    <div class="col-md-3 block border text-center">
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
    </div>
@endsection

@include('web.layouts.footer')
