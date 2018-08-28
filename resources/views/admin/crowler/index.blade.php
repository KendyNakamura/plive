@extends('admin.layouts.app')

@section('content')

    <form action="{{ route('Admin::crowler.index') }}" method="get">
        <input type="text" name="selector">
        <input type="text" name="title_selector">
        <input type="text" name="date_selector">
        <input type="submit" value="send">
    </form>

@endsection
