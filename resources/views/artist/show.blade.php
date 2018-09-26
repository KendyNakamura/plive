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
                    @foreach($days as $k => $v)
                        {{ $k }}
                        <table  border="1">
                            <tr>
                                <th>日付</th>
                            </tr>
                        @foreach($v as $j => $day)
                            <tr>
                                    <td>{{ $day }}</td>
                            </tr>
                        @endforeach
                        </table>
                    @endforeach
                    <table class="row" border="1">
                        <tr>
                            <th>日付</th>
                            <th class="col-6">ライブ</th>
                        </tr>
                        @foreach($artist->lives as $live)
                            <tr>
                                <td>{{ $live->date }}</td>
                                <td>{{ $live->title }}</td>
                            </tr>
                        @endforeach
                    </table>
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

