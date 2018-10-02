@extends('layouts.app')

@section('page_assets_head_tag')
    <link href="{{ asset('css/chatbox.css') }}" rel="stylesheet">
@endsection
@include('layouts.header')

@section('content')
    {{ Breadcrumbs::render('artist', $artist) }}
    @foreach($artist->tags as $tag)
        <a href="#">{{ $tag->title }}</a>
    @endforeach
    <div class="row">
        <div class="col-12 text-center">
            <div class="box box-solid">
                <div class="box-body">
                    <img class="logo" src="{{ $artist->img_url }}" alt="logo" width="300px" height="300px">
                    <h2>{{ $artist->name }}</h2>
                    @if (Auth::user())
                        <input id="artistId" type="hidden" name="register" value="{{ Auth::user()->id ?? ''}}">
                        @if ($artist->artist_register == '[]')
                            <a href="javascript:void(0)" id="artistRegister"><i class="far fa-heart"></i>@lang('c.register')</a>
                        @else
                            <a href="javascript:void(0)" id="artistDelete"><i class="fa fa-heart"></i>@lang('c.register_release')</a>
                        @endif
                    @endif
                    <p>登録者数　<span>{{ $artist->users()->count() }}</span></p>
                    <p><a href="{{ $artist->url }}" target="_blank"><i class="fa fa-clone"></i>アーティストページへ</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h2>Live</h2>
                    @foreach($artist->lives->where('is_active', 1)->sortByDesc('date') as $live)
                        <li>
                            {{ $live->date }}
                            {{ $live->title }}
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h2>Message</h2>
                    <div class="line-bc" id="target">
                        @foreach($messages as $message)
                            {{--if this artist--}}
                            @if($message->to_artist_id == $artist->id)
                                {{--if message user = me--}}
                                @if(Auth::user() && $message->user == Auth::user())
                                    <div class="mycomment">
                                        <p>{{ $message->text }}</p>
                                    </div>
                                @else
                                    <div class="balloon6">
                                        <div class="faceicon">
                                            {{--image--}}
                                        </div>
                                        <div class="chatting">
                                            <div class="says">
                                                <p>{{ $message->text }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        <div id="message"></div>
                        <input name="text" type="text" class="form-control" id="messageText">
                        <button id="messagePost" class="btn btn-success">@lang('c.send')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_assets_end_tag')
    <script>
        $(function(){
            $id = $('#artistId').val();
            $(document).on('click', '#artistRegister',function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ route('artist.register', $artist) }}',
                    type:'POST',
                    data:{'register': $id}
                }).done( (data) => {
                    $('#artistRegister').after('<a href="javascript:void(0)" id="artistDelete"><i class="fa fa-heart"></i>@lang('c.register_release')</a>');
                    $('#artistRegister').remove();
                }).fail( (data) => {
                    $('.result').html(data);
                    console.log(data);
                }).always( (data) => {
                });
            });
            $(document).on('click', '#artistDelete',function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ route('artist.register.delete', $artist) }}',
                    type:'POST',
                    data:{'delete':$id}
                }).done( (data) => {
                    $('#artistDelete').after('<a href="javascript:void(0)" id="artistRegister"><i class="far fa-heart"></i>@lang('c.register')</a>');
                    $('#artistDelete').remove();
                }).fail( (data) => {
                    $('.result').html(data);
                    console.log(data);
                }).always( (data) => {
                });
            });

            $(document).on('click', '#messagePost',function() {
                var text = $('#messageText').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ route('message.store', $artist) }}',
                    type:'POST',
                    data:{'text':text}
                }).done( function(data) {
                    $('#message').before('<div class="mycomment"><p>' + data + '</p></div>');
                    console.log(data);
                    $('#messageText').val('');
                }).fail( function(data) {
                    $('.result').html(data);
                    console.log(data);
                }).always( (data) => {
                });

                $('#target').animate({scrollTop: $('#target')[0].scrollHeight}, 'fast');
            })
        });
    </script>
@endsection

