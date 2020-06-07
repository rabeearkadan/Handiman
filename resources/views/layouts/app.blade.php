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
    <link href="{{asset('css/footer.css')}}" rel="stylesheet">
    <link href="{{asset('css/social-buttons.css')}}" rel="stylesheet">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">
    @stack('css')
    <style>
        .footer {
            width: -webkit-fill-available;
            position: absolute;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="{{route('welcome')}}"><img  width="80px" height="40px" src="/public/img/logo.png" alt="Home"></a>
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
    <div id="app"  style="margin-top: 30px;height: 90vh">
        <div id="preloader"></div>
        @yield('content')
    </div>
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h2>About Handiman.club</h2>

                    <p>A Service-based platform to connect Handymen with their clients providing Smart Scheduling, easy payments...  </p>
                </div><!-- /.col-* -->

                <div class="col-sm-4">
                    <h2>Contact Information</h2>

                    <p>
                        Street 123, Beirut, Lebanon<br>
                        +961-71-123-456-, <a href="#">handiman@gmail.com</a>
                    </p>
                </div><!-- /.col-* -->

                <div class="col-sm-4">
                    <h2>Stay Connected</h2>

                    <ul class="social-links nav nav-pills">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul><!-- /.header-nav-social -->
                </div><!-- /.col-* -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.footer-top -->

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-left">
                © 2020 All rights reserved.
            </div><!-- /.footer-bottom-left -->

            <div class="footer-bottom-right">
                <ul class="nav nav-pills">
                    <li><a href="{{route('welcome')}}">Home</a></li>
                    <li><a href="">Terms &amp; Conditions</a></li>
                    <li><a href="{{url('/#contact')}}">Contact</a></li>
                </ul><!-- /.nav -->
            </div><!-- /.footer-bottom-right -->
        </div><!-- /.container -->
    </div>
</footer><!-- /.footer -->
@stack('script')
<script>
    $('.navTrigger').click(function(){
        $(this).toggleClass('active');
    });
</script>

</body>
</html>
