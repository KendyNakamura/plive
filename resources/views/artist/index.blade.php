@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render('Home') }}
                    @foreach($artists as $artist)
                        <ul>
                            <li>
                                <a href="{{ route('artist.show', $artist) }}">
                                    {{ $artist->name }}
                                </a>
                            </li>
                        </ul>
                    @endforeach
            <div class="mt-3">
                {{ $artists->links() }}
            </div>
        </div>
    </div>
@endsection

@include('layouts.sidebar')
