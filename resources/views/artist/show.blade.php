@extends('layouts.app')

@include('layouts.header')

@section('content')
    <p>詳細ページ</p>
    <div class="row">
        <div class="col-md-3 border">
            <p>{{ $artist->name }}</p>
            <p>{{ $artist->content }}</p>
            <p><a href="{{ $artist->url }}">アーティストページへ</a></p>
            <img class="logo" src="/storage/{{ $artist->image }}" alt="logo" width="150px" height="150px">
        </div>
        <div class="border">
            <h2>ライブ一覧</h2>
            <table style="display: inline-block">
                <tr>
                    <th>日付</th>
                </tr>
                @foreach($dates as $date)
                    <tr>
                        <td>{{ $date }}</td>
                    </tr>
                @endforeach
            </table>
            <table style="display: inline-block">
                <tr>
                    <th>ライブ</th>
                </tr>
                @foreach($artist->lives as $live)
                    <tr>
                        <td>{{ $live->title }}</td>
                    </tr>
                @endforeach
            </table>


            <h2>登録しているユーザ一覧</h2>
            @foreach($artist->users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach

            <form role="form" class="form" method="POST" action="{{ route('artist.register', $artist) }}">
                {{ csrf_field() }}
                <input type="hidden" name="users" value="{{ Auth::user()->id ?? ''}}">
                @if (Auth::user())
                <input type="submit" class="btn btn-primary" value="{{ ($artist->users()->get()->where('id', Auth::user()->id) == '[]') ? '登録する' : '登録済'}}"{{ ($artist->users()->get()->where('id', Auth::user()->id) == '[]') ? '' : ' disabled'}}>
                @endif
            </form>
        </div>
    </div>
@endsection

@include('layouts.footer')
