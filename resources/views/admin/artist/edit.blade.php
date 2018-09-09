@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <form id="artist_save_form" action="{{ route('admin::artist.update', $artist)}}" method="post">
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
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary" name="action" value="save" onclick="this.form.target='_top'">@lang('c.save')</button>
                        <button class="btn btn-warning" name="action" value="preview" onclick="this.form.target='_blank'">@lang('c.preview')</button>
                    </div>
                </form>
            </div>
        </div>

        {{--画像アップロード--}}
        <div class="col-sm-6">
            <!-- サーバへ送信する内容を入力する。 -->
            テキスト：<input type="text" id="text"><br/>
            ファイル：<input type="file" id="file"><br/>
            <button type="submit" onclick="send();">送信</button>

            <!-- サーバから受けた内容を表示する。 -->
            <ul id="file_list">
                <li class="each_file">
                    <input type="file" class="input_file" name="img_file" value="" accept="image/*">
                </li>
            </ul>
            <div id="main">

            </div>
        </div>
    </div>
@endsection
<script>
    function send(){

        //ajaxでのcsrfトークン送信
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //テキストの入力値を取得する。
        var textData = $("#text").val();

        //アップロードファイルの入力値を取得する。
        var fileData = document.getElementById("file").files[0];

        //フォームデータを作成する。(送信するデータ)
        var form = new FormData();

        //フォームデータにテキストの内容、アップロードファイルの内容を格納する。
        form.append( "text", textData );
        form.append( "file", fileData );

        //ポスト送信する。
        $.ajax({
            type: 'post',
            url: "{{ route('admin::image.upload') }}",
            data: form,
            processData : false,
            contentType : false,

            //成功の場合、以下を行う。
            success: function(data){
                $("#main").append('保存しました。');
            },

            //失敗の場合、以下を行う。
            error : function(){
                alert('通信ができない状態です。');
            }
        });
    }

    $('#upload').on('click','input[name="hoge"]',function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // ※3
        var fd = new FormData();
        if ($("input[name='hoge']").val()!== '') {
            fd.append( "file", $("input[name='hoge']").prop("files")[0] );
        }
        var postData = {
            type : "POST",
            dataType : "text",
            data : fd,
            processData : false,
            contentType : false
        };
        $.ajax(
            "{{ route('admin::image.upload') }}", postData
        ).done(function( text ){
            console.log(text);
        });
    });

    // inputタグに画像が追加された場合の処理
    $fileList.on('change.inputFile', '#main', function(e) {
        var $input = $(this),
            $li = $input.closest('.each_file'),
            $newLi = $li.clone();
        $fileList.append($newLi);
        //サムネイル画像を表示する処理
        var file = e.target.files[0],
            fileName = file.name;
        //FileReaderオブジェクトの生成
        reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onloadend = function () {
            var fileReader = this;
            if (fileReader.result) {
                var thumb = '<div class = "thumbnail"><img src = "' + fileReader.result + '" width = "150px" style = "max-width: 150px;">' + fileName + '<button class = "delete_btn">削除</button></div>';
                $li.append(thumb);
            }
            return this;
        };
        $input.hide();
    });

    //画像が3つになった場合にinputタグを非表示にする処理
    // var $fileListLI = $('#file_list li input[name=img_file]');
    // var inputFileNum = $fileListLI.length;
    // var lastInputFile = $fileListLI.eq(-1);
    // if (inputFileNum == 4){
    //     $(lastInputFile).hide();
    // }

    {{--function image_upload(){--}}
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
        {{--//Ajaxで飛ばすdata（FromDataオブジェクト）を生成する処理--}}
        {{--var fd = new FormData();--}}
        {{--//画像が選択されるinputタグは必ず最後から2番目--}}
        {{--var $fileListLI = $('#file_list li input[name=img_file]');--}}
        {{--var targetFile = $fileListLI.eq(-1);--}}
        {{--//1画像毎のUPなので[0]、複数である場合は[1][2]...--}}
        {{--fd.append( "file", $('#img_file').prop("files")[0]);--}}

        {{--$.ajax({--}}
            {{--url: "{{ route('admin::image.upload') }}",--}}
            {{--type: 'post',--}}
            {{--dataType: 'json',--}}
            {{--data: fd,--}}
            {{--processData: false,--}}
            {{--contentType: false--}}
        {{--})--}}
            {{--.done(function(res){--}}
                {{--console.log(res);--}}
            {{--})--}}
            {{--.fail(function(jqXHR, statusText, errorThrown){--}}
                {{--console.log(errorThrown);--}}
            {{--});--}}
        {{--return this;--}}
    // }
</script>
