@extends('layouts.app')

@include('layouts.header')

@section('content')
    {{ Breadcrumbs::render('artist', $artist) }}

    <div class="row">
        <div class="col-12 text-center">
            <img class="logo" src="{{ $artist->img_url }}" alt="logo" width="300px" height="300px">
            <p>{{ $artist->name }}</p>
            <p><a href="{{ $artist->url }}" target="_blank">アーティストページへ</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>ライブ一覧</h2>
            <table class="row" border="1">
                <tr>
                    <th>日付</th>
                    <th class="col-6">ライブ</th>
                </tr>
                @foreach($artist->lives as $live)
                    <tr>
                        <td>{{ $live->date }}</td>
                        <td>{{ $live->title }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @if (Auth::user())
        @if ($artist->artist_register == '[]')
            <form role="form" class="form" method="POST" action="{{route('artist.register', $artist) }}">
                {{ csrf_field() }}
                <input type="hidden" name="users" value="{{ Auth::user()->id ?? ''}}">
                <input type="submit" class="btn btn-primary" value="{{ '登録する' }}">
            </form>
        @else
            <form role="form" class="form" method="POST" action="{{route('artist.register.delete', $artist) }}">
                {{ csrf_field() }}
                <input type="hidden" name="users" value="{{ Auth::user()->id ?? ''}}">
                <input type="submit" class="btn btn-primary" value="{{ '登録済'}}">
            </form>
        @endif
    @endif
@endsection

