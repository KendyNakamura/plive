@extends('web.layouts.app')

@include('web.layouts.header')

@section('content')
    {{ Breadcrumbs::render('artist', $artist) }}

    <div class="row">
        <div class="col-12 text-center">
            <img class="logo" src="/storage/{{ $artist->image }}" alt="logo" width="150px" height="150px">
            <p>{{ $artist->name }}</p>
            <p><a href="{{ $artist->url }}" target="_blank">アーティストページへ</a></p>
        </div>
        <div class="col-md-6">
            <h2>ライブ一覧</h2>
            <table class="row" border="1">
                <tr>
                    <th>日付</th>
                    <th class="col-md-10">ライブ</th>
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
    <div class="col-md-6">
        <h2>登録しているユーザ一覧</h2>
        @foreach($artist->users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
            </tr>
        @endforeach

        @if (Auth::user())
            <form role="form" class="form" method="POST" action="{{ ($artist->users()->get()->where('id', Auth::user()->id) == '[]') ? route('artist.register', $artist) : route('artist.register.delete', $artist) }}">
                {{ csrf_field() }}
                <input type="hidden" name="users" value="{{ Auth::user()->id ?? ''}}">
                <input type="submit" class="btn btn-primary" value="{{ ($artist->users()->get()->where('id', Auth::user()->id) == '[]') ? '登録する' : '登録済'}}">
            </form>
        @endif
    </div>
@endsection

@include('web.layouts.footer')
