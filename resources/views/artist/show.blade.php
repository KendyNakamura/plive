@extends('layouts.app')

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
                    <h2>ライブ一覧</h2>
                    @foreach($artist->lives->sortByDesc('date') as $live)
                        <li>
                        {{ $live->date }}
                        {{ $live->title }}
                        </li>
                    @endforeach
                {{--@php $monthno = 0; @endphp--}}
                {{--<!-- タブボタン部分 -->--}}
                    {{--<ul class="nav nav-tabs">--}}
                        {{--@foreach($days as $k => $v)--}}
                            {{--@switch ($monthno++)--}}
                                {{--@case(0)--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a href="#tab{{ $monthno }}" class="nav-link active" data-toggle="tab">{{ $k }}</a>--}}
                                {{--</li>--}}
                                {{--@continue;--}}
                                {{--@default--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a href="#tab{{ $monthno }}" class="nav-link" data-toggle="tab">{{ $k }}</a>--}}
                                {{--</li>--}}
                            {{--@endswitch--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--@php $dayno = 0; @endphp--}}
                    {{--<!--タブのコンテンツ部分-->--}}
                    {{--<div class="tab-content">--}}
                        {{--@foreach($days as $k => $v)--}}
                            {{--@switch ($dayno++)--}}
                                {{--@case(0)--}}
                                {{--<div id="tab{{ $dayno }}" class="tab-pane active">--}}
                                    {{--@foreach($v as $j => $day)--}}
                                        {{--<li>{{ $day }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                                {{--@continue;--}}
                                {{--@default--}}
                                {{--<div id="tab{{ $dayno }}" class="tab-pane">--}}
                                    {{--@foreach($v as $j => $day)--}}
                                        {{--<li>{{ $day }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--@endswitch--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
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
        });
    </script>
@endsection

