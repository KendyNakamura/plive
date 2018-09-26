@extends('admin.layouts.app')

@section('content')
    <table border="1">
        <tr>
            <th>name</th>
            <th>url</th>
            <th></th>
        </tr>
        @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->text }}</td>
                <td><input type="button" onclick="location.href='{{ route('admin::tag.edit', $tag) }}'" value="編集"></td>
            </tr>
        @endforeach
    </table>
@endsection
