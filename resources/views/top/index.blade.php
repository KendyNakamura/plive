@extends('layouts.app')
 
@include('layouts.header')

@section('content')
    <p>コンテンツ内容が入ります</p>
    @foreach($artists as $artist)
    	<p>{{ $artist->name }}</p>
    @endforeach
    <input type="submit" class="btn btn-deafult">
@endsection
 
@include('layouts.footer')
