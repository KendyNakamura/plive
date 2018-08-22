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


            <h2>ユーザ一覧</h2>

	        <form role="form" class="form" method="POST" action="{{ route('artist.register', $artist) }}">
                {{ csrf_field() }}
                <input type="text" name="users" value="{{ Auth::user()->id ?? ''}}">
	        	<button type="submit" class="btn btn-primary">登録する</button>
	        </form>
	    </div>
    </div>
@endsection

@include('layouts.footer')
