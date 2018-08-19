@extends('layouts.app')
 
@include('layouts.header')

@section('content')
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
@endsection
 
@include('layouts.footer')
