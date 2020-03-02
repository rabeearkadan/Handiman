<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->


    <!-- Styles -->
    @if(request()->route()->getName() != "client.user-profile")
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=DM+Sans:500,700&display=swap" rel="stylesheet">
    @endif
    @if(request()->route()->getName() != "client.profile")
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('css/client/client.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/preloader.css')}}" rel="stylesheet">

    @stack('css')
</head>
<body>
@include('front.client.partials.preloader')
@include('front.client.partials.navbar')

<div class="content">
    @yield('content')
</div>
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

    function hideLoader() {
        $('#preloader-wrapper').hide();
    }
    setInterval(function(){
        $('#preloader-wrapper').hide();
    },5000);

    // $(window).ready(hideLoader);
    // setTimeout(hideLoader, 10 * 1000);
</script>

@stack('js')
</body>
</html>
