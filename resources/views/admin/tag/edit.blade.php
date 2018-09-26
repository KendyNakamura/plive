@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin::tag.update', $tag) }}" method="post">
        {{ csrf_field() }}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">title</label>
                            <input required class="form-control" id="title" name="title" value="{{ old('title', $tag->title) }}">
                            @if ($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            <label for="text" class="control-label">text</label>
                            <input required class="form-control" id="text" name="text" value="{{ old('text', $tag->text) }}">
                            @if ($errors->has('text'))
                                <span class="help-block">{{ $errors->first('text') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit">@lang('c.save')</button>
        </div>
    </form>
@endsection
