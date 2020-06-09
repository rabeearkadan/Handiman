<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/user-employee.css')}}" rel="stylesheet">

</head>
<body>
<div class="background">
    <div class="container">
        <div class="panel pricing-table">
            <div class="pricing-plan">
                <img src="/public/images/client-home.png" alt="" class="pricing-img">
                <h2 class="pricing-header"> Client </h2>
                <ul class="pricing-features">
                    <li class="pricing-features-item"> Thousands of verified professionals</li>
                    <li class="pricing-features-item"> Guaranteed Services quality</li>
                </ul>
                <span class="pricing-price"> Waiting for you </span>
                <a href="{{route('client.home',['logged'=>true])}}" class="pricing-button"> Continue </a>
            </div>

            <div class="pricing-plan">
                <img src="/public/images/employee-home.png" alt="" class="pricing-img">
                <h2 class="pricing-header"> Handyman </h2>
                <ul class="pricing-features">
                    <li class="pricing-features-item">Custom Schedule</li>
                    <li class="pricing-features-item">Multiple clients waiting for you</li>
                </ul>
                <span class="pricing-price">Let's go</span>
                <a href="{{route('employee.home',['logged'=>true])}}" class="pricing-button is-featured"> Continue </a>
            </div>
        </div>
    </div>
</div>


</body>
</html>
