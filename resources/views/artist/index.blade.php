@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render('Home') }}
            <div class="row">
                @foreach($artists as $artist)
                    <div class="col-md-3 block text-center">
                        <a href="{{ route('artist.show', $artist) }}">
                            <img class="logo" src="{{ asset('storage/images/' . $artist->name . '/main.jpg') }}" alt="logo" width="150px" height="150px">
                            <p>{{ $artist->name }}</p>
                        </a>
                        <p><a href="{{ $artist->url }}" target="_blank"><i class="fa fa-clone"></i>アーティストページへ</a></p>
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
