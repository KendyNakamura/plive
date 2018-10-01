@extends('admin.layouts.app')

@section('content')
    <table border="1">
        <tr>
            <th style="width:200px;">title</th>
            <th style="width:400px;">text</th>
            <th></th>
        </tr>
        @foreach ($tags as $tag)
            <tbody>
            <tr>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->text }}</td>
                <td>
                    <input type="button" class="btn btn-block btn-default btn-xs" onclick="location.href='{{ route('admin::tag.edit', $tag) }}'" value="編集">
                    <button type="button"
                            class="btn btn-block btn-danger btn-xs"
                            data-toggle="modal"
                            data-target="#modal_delete"
                            data-title="タイトル : {{ $tag->title }}"
                            data-tag_url="{{ route('admin::tag.delete', $tag) }}">
                        @lang('c.delete')
                    </button>
                </td>
            </tr>
        @endforeach
    </table>

    {{-- 削除 モーダル --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal_delete">
        <form role="form" class="form-inline" method="POST" action="">
            {{ csrf_field() }}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@lang('c.delete?')</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('c.cancel')</button>
                        <button type="submit" class="btn btn-danger">@lang('c.delete')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('page_assets_end_body_tag')
    <script>
        // 削除 モーダル
        $('#modal_delete').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var url = button.data('tag_url');
            var modal = $(this);
            modal.find('.modal-body p').eq(0).text(title);
            modal.find('form').attr('action',url);
        });
    </script>
@endsection
