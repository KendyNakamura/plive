@extends('admin.layouts.app')

@section('content')
    <form id="artist_save_form" action="{{ route('admin::artist.update', $artist)}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    @include('admin.shared.artist_form')
                    <div class="col-sm-6">
                        <img src="{{ asset('storage/images/' . $artist->name . '/main.jpg') ?? asset('storage/images/no.jpg') }}" width="250px" height="250px"><br />
                        <input type="file" name='main'><br/>
                        <label>タグ</label>
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
            <div class="box-footer">
                <button class="btn btn-primary" name="action" value="save" onclick="this.form.target='_top'">@lang('c.save')</button>
                <button class="btn btn-warning" name="action" value="preview" onclick="this.form.target='_blank'">@lang('c.preview')</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <form action="{{ route('admin::lives.update', $artist) }}" method="post">
                    <div class="box-header">
                        <label>ライブ一覧</label>
                    </div>
                    <div class="box-body">
                        {{ csrf_field() }}
                        <table>
                            <tr>
                                <th>
                                    日付
                                </th>
                                <th style="width:500px;">
                                    タイトル
                                </th>
                                <th>
                                    場所
                                </th>
                                <th>
                                    公開状態
                                </th>
                            </tr>
                            @foreach($artist->lives->sortByDesc('date') as $live)
                                <tr>
                                    <td class="form-group{{ $errors->has("date.{$live->id}") ? ' has-error' : '' }}">
                                        <input name="date[{{ $live->id }}]" type="text" class="form-control" value="{{ old("date.{$live->id}", $live->date) }}">
                                        @if ($errors->has("date.{$live->id}"))
                                            <span class="help-block">{{ $errors->first("date.{$live->id}") }}</span>
                                        @endif
                                    </td>
                                    <td class="form-group{{ $errors->has("title.{$live->id}") ? ' has-error' : '' }}">
                                        <input name="title[{{ $live->id }}]" type="text" class="form-control" value="{{ old("title.{$live->id}", $live->title) }}">
                                        @if ($errors->has("title.{$live->id}"))
                                            <span class="help-block">{{ $errors->first("title.{$live->id}") }}</span>
                                        @endif
                                    </td>
                                    <td class="form-group{{ $errors->has("place_id.{$live->id}") ? ' has-error' : '' }}">
                                        <select name="place_id[{{ $live->id }}]" class="form-control select2">
                                            <option value="" selected>未選択</option>
                                            @foreach($places as $place)
                                                <option value="{{ $place->id }}"{{ old("place_id.{$live->id}", $live->place_id ?? '') == $place->id ? ' selected' : ''}}>{{ $place->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has("place_id.{$live->id}"))
                                            <span class="help-block">{{ $errors->first("place_id.{$live->id}") }}</span>
                                        @endif
                                    </td>
                                    <td class="form-group{{ $errors->has("is_active.{$live->id}") ? ' has-error' : '' }}">
                                        <input name="is_active[{{ $live->id }}]" id="live_active-{{ $live->id }}" type="checkbox" value="1" {{ old("is_active.{$live->id}", $live->is_active ?? '') == '1' ? 'checked' : ''  }}><label for="live_active-{{ $live->id }}">公開</label>
                                        @if ($errors->has("is_active.{$live->id}"))
                                            <span class="help-block">{{ $errors->first("is_active.{$live->id}") }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary" type="submit">@lang('c.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('.select2').select2();
        });
    </script>
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
