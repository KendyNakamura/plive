@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <form id="artist_save_form" action="{{ route('admin::artist.update', $artist)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">name</label>
                            <input required class="form-control" id="name" name="name" value="{{ $artist->name ?? old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="control-label">URL</label>
                            <input required class="form-control" id="url" name="url" value="{{ $artist->url ?? old('url') }}">
                            @if ($errors->has('url'))
                                <span class="help-block">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('selector') ? ' has-error' : '' }}">
                            <label for="selector" class="control-label">selector</label>
                            <input class="form-control" id="selector" name="selector" value="{{ $artist->selector ?? old('selector') }}">
                            @if ($errors->has('selector'))
                                <span class="help-block">{{ $errors->first('selector') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('title_selector') ? ' has-error' : '' }}">
                            <label for="title_selector" class="control-label">title_selector</label>
                            <input class="form-control" id="title_selector" name="title_selector" value="{{ $artist->title_selector ?? old('title_selector') }}">
                            @if ($errors->has('title_selector'))
                                <span class="help-block">{{ $errors->first('title_selector') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('date_selector') ? ' has-error' : '' }}">
                            <label for="date_selector" class="control-label">date_selector</label>
                            <input class="form-control" id="date_selector" name="date_selector" value="{{ $artist->date_selector ?? old('date_selector') }}">
                            @if ($errors->has('date_selector'))
                                <span class="help-block">{{ $errors->first('date_selector') }}</span>
                            @endif
                        </div>

                        <img src="{{ asset('storage/images/' . $artist->name . '/main.jpg') ?? asset('storage/images/no.jpg') }}" width="250px" height="250px"><br />
                        <input type="file" name='main'><br/>

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
