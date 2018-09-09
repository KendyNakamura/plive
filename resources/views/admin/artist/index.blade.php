@extends('admin.layouts.app')

@section('content')
    <table border="1">
        <tr>
            <th>name</th>
            <th>url</th>
            <th>selector</th>
            <th>title_selector</th>
            <th>date_selector</th>
            <th></th>
        </tr>
        @foreach ($artists as $artist)
        <tr>
            <td>{{ $artist->name }}</td>
            <td>{{ $artist->url }}</td>
            <td>{{ $artist->selector }}</td>
            <td>{{ $artist->title_selector }}</td>
            <td>{{ $artist->date_selector }}</td>
            <td><input type="button" onclick="location.href='{{ route('admin::artist.edit', $artist) }}'" value="編集"></td>
        </tr>
        @endforeach
    </table>
@endsection
