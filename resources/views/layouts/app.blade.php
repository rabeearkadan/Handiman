<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->

    <link href="{{asset('css/materialize.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/footer.css')}}" rel="stylesheet">
    <link href="{{asset('css/social-buttons.css')}}" rel="stylesheet">
    <style>

    </style>
    @stack('css')

</head>
<body>
<nav class="black">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">lll</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{route('register')}}">Register</a></li>
            <li><a href="{{url('/#about')}}">Abouts us</a></li>
            <li><a href="{{url('/#team')}}">Our Team</a></li>
            <li><a href="{{url('/#contact')}}">Contact us</a></li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="{{route('register')}}">Register</a></li>
    <li><a href="{{url('/#about')}}">Abouts us</a></li>
    <li><a href="{{url('/#team')}}">Our Team</a></li>
    <li><a href="{{url('/#contact')}}">Contact us</a></li>
</ul>
    <div id="app">
        @yield('content')
    </div>

@stack('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/public/js/materialize.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>
</body>
</html>
