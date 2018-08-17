@extends('layouts.app')
 
@include('layouts.header')

@section('content')
    <p>コンテンツ内容が入ります</p>
    <div class="row">
	    @foreach($artists as $artist)
	    	<div class="col-md-3 block">{{ $artist->name }}</div>
	    @endforeach
	</div>
@endsection
 
@include('layouts.footer')
