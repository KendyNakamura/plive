<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">name</label>
            <input required class="form-control" id="name" name="name" value="{{ old('name', $place->name ?? '') }}">
            @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label for="url" class="control-label">url</label>
            <input class="form-control" id="url" name="url" value="{{ old('url', $place->url ?? '') }}">
            @if ($errors->has('url'))
                <span class="help-block">{{ $errors->first('url') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('prefecture') ? ' has-error' : '' }}">
            <label for="prefecture" class="control-label">prefecture</label>
            <select name="prefecture" id="prefecture" class="form-control" required>
                @foreach(config('prefecture') as $prefecture)
                    <option value="{{ $prefecture }}"{{ old('prefecture', $place->prefecture ?? '') == $prefecture ? " selected" : "" }}>{{ $prefecture }}</option>
                @endforeach
            </select>
            @if ($errors->has('prefecture'))
                <span class="help-block">{{ $errors->first('prefecture') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
            <label for="capacity" class="control-label">capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $place->capacity ?? '') }}">
            @if ($errors->has('capacity'))
                <span class="help-block">{{ $errors->first('capacity') }}</span>
            @endif
        </div>
    </div>
</div>
