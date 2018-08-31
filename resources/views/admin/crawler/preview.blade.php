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
            <h2>ライブ一覧</h2>
            <table class="row" border="1">
                <tr>
                    <th>日付</th>
                    <th class="col-6">ライブ</th>
                </tr>
                @foreach($lives as $date => $title)
                    <tr>
                        <td>{{ $lives[$date] }}</td>
                        <td>{{ $lives[$title] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
{{--@endsection--}}

{{--@include('layouts.footer')--}}
