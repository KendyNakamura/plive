@extends('layouts.app')
 
@section('title', 'トップページ')
@section('keywords', 'A,B,C')
@section('description', '説明文')
@section('pageCss')
<link href="/css/page.css" rel="stylesheet">
@endsection
 
@include('layouts.head')
 
@include('layouts.header')
 
@section('content')
    <p>コンテンツ内容が入ります</p>
    @foreach($artists as $artist)
    	<p>{{ $artist->name }}</p>
    @endforeach
    <input type="submit" class="btn btn-deafult">
@endsection
 
@section('pageJs')
<script src="/js/page.js"></script>
@endsection
 
@include('layouts.footer')
