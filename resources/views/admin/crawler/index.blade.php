@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <form id="artist_save_form" action="{{ route('admin::crawler.preview') }}" method="get">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">name</label>
                            <input required class="form-control" id="name" name="name">{{ old('name') }}
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="control-label">URL</label>
                            <input required class="form-control" id="url" name="url" >{{ old('url') }}
                            @if ($errors->has('url'))
                                <span class="help-block">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('selector') ? ' has-error' : '' }}">
                            <label for="selector" class="control-label">selector</label>
                            <input required class="form-control" id="selector" name="selector" >{{ old('selector') }}
                            @if ($errors->has('selector'))
                                <span class="help-block">{{ $errors->first('selector') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('title_selector') ? ' has-error' : '' }}">
                            <label for="title_selector" class="control-label">title_selector</label>
                            <input required class="form-control" id="title_selector" name="title_selector" >{{ old('title_selector') }}
                            @if ($errors->has('title_selector'))
                                <span class="help-block">{{ $errors->first('title_selector') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('date_selector') ? ' has-error' : '' }}">
                            <label for="date_selector" class="control-label">date_selector</label>
                            <input required class="form-control" id="date_selector" name="date_selector" >{{ old('date_selector') }}
                            @if ($errors->has('date_selector'))
                                <span class="help-block">{{ $errors->first('date_selector') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-warning" href="javascript:void(0);" onClick="artist_save();" target="_blank">@lang('c.save')する</a>
                        <a class="btn btn-default" href="{{ route('admin::crawler.preview') }}" target="_blank">@lang('c.preview')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    {{-- アーティスト保存確認 --}}
    function artist_save(){
        if(confirm("保存してよろしいですか？")){
            $('#artist_save_form').submit();
        }
    }
</script>
