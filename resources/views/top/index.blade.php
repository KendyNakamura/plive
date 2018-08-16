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
@endsection
 
@include('layouts.sub')
 
@section('pageSub')
    <p>個別サイドバーの内容</p>
@endsectionehhq
 
@section('pageJs')
<script src="/js/page.js"></script>
@endsection
 
@include('layouts.footer')
