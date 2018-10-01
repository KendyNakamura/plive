@extends('layouts.app')

@include('layouts.header')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render('Home') }}
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            name
                        </th>
                        <th>
                            ホームページ
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($artists as $artist)
                        <tr>
                            <td>
                                <a href="{{ route('artist.show', $artist) }}">
                                    {{ $artist->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ $artist->url }}" target="_blank"><i class="fa fa-clone"></i>アーティストページへ</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            <div class="mt-3">
                {{ $artists->links() }}
            </div>
        </div>
    </div>
@endsection

@include('layouts.sidebar')
