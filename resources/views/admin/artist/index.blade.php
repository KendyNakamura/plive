@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @foreach ($artists as $artist)
            {{ $artist->name }}
        @endforeach
    </div>
@endsection
