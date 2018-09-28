@extends('admin.layouts.app')

@section('content')
    <table border="1">
        <tr>
            <th>name</th>
            <th>url</th>
            <th>prefecture</th>
            <th>capacity</th>
            <th></th>
        </tr>
        @foreach ($places as $place)
            <tr>
                <td>{{ $place->name }}</td>
                <td>{{ $place->url }}</td>
                <td>{{ $place->prefecture }}</td>
                <td>{{ $place->capacity }}</td>
                <td><input type="button" onclick="location.href='{{ route('admin::place.edit', $place) }}'" value="編集"></td>
            </tr>
        @endforeach
    </table>
@endsection
