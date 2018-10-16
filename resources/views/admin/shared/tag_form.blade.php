<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="control-label">title</label>
            <input required class="form-control" id="title" name="title" value="{{ old('title', $tag->title ?? '') }}">
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
</div>
