<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/handyman/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/handyman/preloader.css')}}" rel="stylesheet">
    @stack('css')

</head>
<body>
    @include('front.handyman.partials.preloader')
    @include('front.handyman.partials.navbar')

    <div class="content">
        @yield('content')
    </div>

    @stack('js')

</body>
</html>
