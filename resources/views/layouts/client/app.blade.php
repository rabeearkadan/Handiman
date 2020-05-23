<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{asset('css/client/materialize.min.css')}}" rel="stylesheet">
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




<div class="content">
    @yield('content')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/public/js/materialize.js"></script>
<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>
@stack('js')

</body>
</html>
