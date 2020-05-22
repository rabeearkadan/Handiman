<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    @stack('css')

</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="{{url('/home')}}"><img src="/public/img/logo.png" alt="Home"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <div class="navTrigger">
            <i></i><i></i><i></i>
        </div>
    </button>


    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">

                @if(request()->route()->getName() != "login")
                <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
            @endif
                    @if(request()->route()->getName() != "register")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">Register</a>
                        </li>
                    @endif

            <li class="nav-item">
                <a class="nav-link" href="{{url('/#about')}}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/#team')}}">Our Team</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/#contact')}}">Contact Us</a>
            </li>

        </ul>
    </div>
</nav>
    <div id="app">
        <div id="preloader"></div>
        @yield('content')
    </div>
@stack('script')
<script>
    $('.navTrigger').click(function(){
        $(this).toggleClass('active');
    });
</script>

</body>
</html>
