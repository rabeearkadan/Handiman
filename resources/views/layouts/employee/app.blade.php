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
    <link href="{{asset('css/employee/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/preloader.css')}}" rel="stylesheet">
    @stack('css')

</head>
<body>
    @include('front.employee.partials.preloader')
    @include('front.employee.partials.navbar')

    <div class="content">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('js')

</body>
</html>
