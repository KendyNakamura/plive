@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <form id="artist_save_form" action="{{ route('admin::crawler.artist.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">name</label>
                            <input required class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="control-label">URL</label>
                            <input required class="form-control" id="url" name="url" value="{{ old('url') }}">
                            @if ($errors->has('url'))
                                <span class="help-block">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('selector') ? ' has-error' : '' }}">
                            <label for="selector" class="control-label">selector</label>
                            <input class="form-control" id="selector" name="selector" value="{{ old('selector') }}">
                            @if ($errors->has('selector'))
                                <span class="help-block">{{ $errors->first('selector') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('title_selector') ? ' has-error' : '' }}">
                            <label for="title_selector" class="control-label">title_selector</label>
                            <input class="form-control" id="title_selector" name="title_selector" value="{{ old('title_selector') }}">
                            @if ($errors->has('title_selector'))
                                <span class="help-block">{{ $errors->first('title_selector') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('date_selector') ? ' has-error' : '' }}">
                            <label for="date_selector" class="control-label">date_selector</label>
                            <input class="form-control" id="date_selector" name="date_selector" value="{{ old('date_selector') }}">
                            @if ($errors->has('date_selector'))
                                <span class="help-block">{{ $errors->first('date_selector') }}</span>
                            @endif
                        </div>

                        ファイル：<input type="file" name='main'><br/>

                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary" name="action" value="save" onclick="this.form.target='_top'">@lang('c.save')</button>
                        <button class="btn btn-warning" name="action" value="preview" onclick="this.form.target='_blank'">@lang('c.preview')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
