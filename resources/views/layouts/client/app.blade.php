<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{asset('css/materialize.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    @stack('css')
    @if(request()->route()->getName() != "client.user-profile")
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=DM+Sans:500,700&display=swap" rel="stylesheet">
    @endif
    <link href="{{asset('css/client/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/preloader.css')}}" rel="stylesheet">
</head>

<body>

@include('front.client.partials.preloader')
@include('front.client.partials.navbar')

<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
            <div class="background">
                <img src="">
            </div>
            <a href="#user"><img class="circle" src=""></a>
            <a href="#name"><span class="black-text name">nnnn</span></a>
            <a href="#email"><span class="black-text email">nnnnn@gmail.com</span></a>
        </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>





<div class="content">
    @yield('content')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/public/js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>

@stack('js')

</body>
</html>
