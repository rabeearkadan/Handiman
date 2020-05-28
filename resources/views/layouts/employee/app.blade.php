<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->

    <!-- Scripts -->
    @if(request()->route()->getName() != "employee.post.create")
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    <!-- Styles -->

    @if(request()->route()->getName() != "employee.post.create"   && request()->route()->getName() != "employee.requests")
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('css/employee/materialize.css')}}" rel="stylesheet">
    @stack('css')
    <link href="{{asset('css/employee/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/preloader.css')}}" rel="stylesheet">
    @stack('priority-css')
</head>
<body>
    @include('front.employee.partials.preloader')
    @include('front.employee.partials.navbar')
    @yield('outer-elements')
    <div class="content">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/public/js/materialize.js"></script>
    @stack('js')

</body>
</html>
