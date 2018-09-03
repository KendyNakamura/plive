{{--@extends('layouts.app')--}}

{{--@include('layouts.header')--}}

{{--@section('content')--}}
    <div class="row">
        <div class="col-12 text-center">
            <p>{{ $name }}</p>
            <p><a href="{{ $url }}" target="_blank">アーティストページへ</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
{{--@endsection--}}

{{--@include('layouts.footer')--}}
