@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin::place.update', $place) }}" method="post">
        {{ csrf_field() }}
        <div class="box box-solid">
            <div class="box-body">
                @include('admin.shared.place_form')
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit">@lang('c.save')</button>
        </div>
    </form>
@endsection
