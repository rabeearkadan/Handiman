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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
{{--    <link href="{{asset('css/navbar.css')}}" rel="stylesheet">--}}
{{--    Remember to delete the file --}}
    <link href="{{asset('css/footer.css')}}" rel="stylesheet">
    <link href="{{asset('css/social-buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/materialize.min.css')}}" rel="stylesheet">
    <style>
        .footer{
            position:absolute;
            bottom:0;
            width:100%;
        }
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
    @stack('css')

</head>
<body>

    <div id="app">
        <div id="preloader"></div>

        <nav class="black">
            <div class="nav-wrapper">
                <a href="{{url('/')}}" class="brand-logo"><img src="" alt="Home"></a>
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
                        <li><a href="">Home</a></li>
                        <li><a href="">Terms &amp; Conditions</a></li>
                        <li><a href="">Contact</a></li>
                    </ul><!-- /.nav -->
                </div><!-- /.footer-bottom-right -->
            </div><!-- /.container -->
        </div><!-- /.footer-bottom -->
    </footer><!-- /.footer -->
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
