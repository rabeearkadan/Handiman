<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->

    <!-- Scripts -->
    @if(request()->route()->getName() != "employee.post.create" && request()->route()->getName() != "employee.home" && request()->route()->getName() != "employee.calendar.show")
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    @if(request()->route()->getName() == "employee.post.create" || request()->route()->getName() == "employee.home" || request()->route()->getName() == "employee.calendar.show")
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    @endif
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @if(request()->route()->getName() != "employee.post.create" )
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('css/employee/materialize.css')}}" rel="stylesheet">
    @stack('css')
    <link href="{{asset('css/employee/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/preloader.css')}}" rel="stylesheet">
    @stack('priority-css')
    <style>
        .is-danger{
            border-color: #ff3860;
            color: #ff3860;
        }
        .help {
            display: block;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
    <script>
        $('.navTrigger').on( "click",function(){
            $(this).toggleClass('active');
        });
    </script>
</head>
<body>
    @include('front.employee.partials.preloader')
    @include('front.employee.partials.navbar')
    @yield('outer-elements')
    <div class="content" style="overflow-x: hidden">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/public/js/materialize.js"></script>
    @stack('js')

</body>
</html>
