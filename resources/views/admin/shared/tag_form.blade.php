<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="control-label">title</label>
            <input required class="form-control" id="title" name="title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
            <label for="text" class="control-label">text</label>
            <input class="form-control" id="text" name="text" value="{{ old('text') }}">
            @if ($errors->has('text'))
                <span class="help-block">{{ $errors->first('text') }}</span>
            @endif
        </div>
    </div>
</div>
