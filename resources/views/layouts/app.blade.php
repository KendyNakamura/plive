<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            @yield('header')
        <div class="container">
            <main class="py-4">
            @if (session('result'))
                <div class="alert alert-success" role="alert">
                    @if(is_array(session('result')))
                        @foreach (session('result') as $result_item)
                            {{ $result_item }}{!! $loop->last ? '' : '<br>' !!}
                        @endforeach
                    @else
                        {{ session('result') }}
                    @endif
                </div>
            @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
