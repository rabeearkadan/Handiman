<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

</script>

@stack('js')

</body>
</html>
