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
                <img src="https://s22.postimg.cc/8mv5gn7w1/paper-plane.png" alt="" class="pricing-img">
                <h2 class="pricing-header"> Client </h2>
                <ul class="pricing-features">
                    <li class="pricing-features-item"> Thousands of verified professionals</li>
                    <li class="pricing-features-item"> Guranteed Services quality</li>
                </ul>
                <span class="pricing-price"> Something here </span>
                <a href="#" class="pricing-button"> Continue </a>
            </div>

            <div class="pricing-plan">
                <img src="https://s28.postimg.cc/ju5bnc3x9/plane.png" alt="" class="pricing-img">
                <h2 class="pricing-header"> Handyman </h2>
                <ul class="pricing-features">
                    <li class="pricing-features-item">Custom Schedule</li>
                    <li class="pricing-features-item">Multiple clients waiting for you</li>
                </ul>
                <span class="pricing-price">Let's go</span>
                <a href="#" class="pricing-button is-featured"> Continue </a>
            </div>
        </div>
    </div>
</div>


</body>
</html>
