@extends('admin.layouts.app')

@section('content')
    <form id="artist_save_form" action="{{ route('admin::artist.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    @include('admin.shared.artist_form')
                    <div class="col-sm-6">
                        ファイル：<input type="file" name='main'><br/>
                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            @php
                                $artist_tag_ids = isset($artist) ? $artist->tags()->pluck('tags.id')->toArray() : [];
                            @endphp
                            @foreach($tags as $tag)
                                <span class="button-checkbox">
                                    <button type="button" class="btn btn-sm" data-color="primary">{{ $tag->title }}</button>
                                    <input type="checkbox" class="hidden" name="tags[]" value="{{ $tag->id }}"{{ in_array($tag->id, old('tags', $artist_tag_ids))  ? ' checked' : '' }}>
                                </span>
                            @endforeach
                            @if ($errors->has('tag'))
                                <span class="help-block">{{ $errors->first('tags') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" name="action" value="save" onclick="this.form.target='_top'">@lang('c.save')</button>
            <button class="btn btn-warning" name="action" value="preview" onclick="this.form.target='_blank'">@lang('c.preview')</button>
        </div>
    </form>
    <script>
        $(function () {
            $('.button-checkbox').each(function () {

                var $widget = $(this),
                    $button = $widget.find('button'),
                    $checkbox = $widget.find('input:checkbox'),
                    color = $button.data('color'),
                    settings = {
                        on: {
                            icon: 'glyphicon glyphicon-check'
                        },
                        off: {
                            icon: 'glyphicon glyphicon-unchecked'
                        }
                    };

                $button.on('click', function () {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                    $checkbox.triggerHandler('change');
                    updateDisplay();
                });

                $checkbox.on('change', function () {
                    updateDisplay();
                });

                function updateDisplay() {
                    var isChecked = $checkbox.is(':checked');
                    $button.data('state', (isChecked) ? "on" : "off");
                    $button.find('.state-icon')
                        .removeClass()
                        .addClass('state-icon ' + settings[$button.data('state')].icon);

                    if (isChecked) {
                        $button
                            .removeClass('btn-default')
                            .addClass('btn-' + color + ' active');
                    } else {
                        $button
                            .removeClass('btn-' + color + ' active')
                            .addClass('btn-default');
                    }
                }


                function init() {
                    updateDisplay();
                    if ($button.find('.state-icon').length == 0) {
                        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                    }
                }

                init();
            });
        });
    </script>
@endsection
