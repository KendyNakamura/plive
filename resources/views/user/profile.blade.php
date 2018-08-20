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
                </div>
            </div>
        </div>
    </div>
@endsection
 
@include('layouts.footer')
