<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Genie') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:500,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            height: 100vh;
            width: 100%;
            padding: 0 5px;
        }
        .nav {
            width:100%;
            display: inline-flex;
            position: relative;
            overflow: hidden;
            background-color: #fff;
            padding: 0 20px;
            /*border-radius: 10px;*/
            box-shadow: 0 10px 40px rgba(159, 162, 177, .8);
        }
        .nav-item{
            color: #83818c;
            padding: 20px;
            text-decoration: none;
            transition: .3s;
            margin: 0 6px;
            z-index: 1;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            position: relative;
        &:before {
             content: "";
             position: absolute;
             bottom: -6px;
             left: 0;
             width: 100%;
             height: 5px;
             background-color: #dfe2ea;
             border-radius: 8px 8px 0 0;
             opacity: 0;
             transition: .3s;
         }
        }
        .nav-item:not(.is-active):hover:before {
            opacity: 1;
            bottom: 0;
        }
        .nav-item:not(.is-active):hover { color: #333; }
        .nav-indicator {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            transition: .4s;
            height: 5px;
            z-index: 1;
            border-radius: 8px 8px 0 0;
        }
        @media (max-width: 580px) {
            .nav {
                overflow: auto;
                padding: 0 10px;
            }
            .nav-item {
                padding: 15px;
                margin: 0 3px;
                font-weight: 300;
            }
        }
        /* Float four columns side by side */
        .column {
            float: left;
            width: 25%;
            padding: 0 10px;
        }
        /* Remove extra left and right margins, due to padding in columns */
        .row {
            margin: 60px -5px;}

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
            padding: 16px;
            text-align: center;
            background-color: #f1f1f1;
        }
        /* Responsive columns - one column layout (vertical) on small screens */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        /*----------------------- Preloader -----------------------*/
        body.preloader-site {
            overflow: hidden;
        }

        .preloader-wrapper {
            height: 100%;
            width: 100%;
            background: #FFF;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999;
        }

        .preloader-wrapper .preloader {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 120px;
        }

        section.wrapper {
            padding: 40px 0;
        }
        section.wrapper.dark {
            background: #313134;
        }

        div.spinner {
            -moz-animation: rotate 10s infinite linear;
            -webkit-animation: rotate 10s infinite linear;
            animation: rotate 10s infinite linear;
            position: relative;
            display: block;
            margin: auto;
            width: 142px;
            height: 142px;
        }
        div.spinner i {
            -moz-animation: rotate 3s infinite cubic-bezier(0.09, 0.6, 0.8, 0.03);
            -webkit-animation: rotate 3s infinite cubic-bezier(0.09, 0.6, 0.8, 0.03);
            animation: rotate 3s infinite cubic-bezier(0.09, 0.6, 0.8, 0.03);
            -moz-transform-origin: 50% 100% 0;
            -webkit-transform-origin: 50% 100% 0;
            transform-origin: 50% 100% 0;
            position: absolute;
            display: inline-block;
            top: 50%;
            left: 50%;
            border: solid 6px transparent;
            border-bottom: none;
        }
        div.spinner i:nth-child(1) {
            -moz-animation-timing-function: cubic-bezier(0.09, 0.3, 0.12, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 0.3, 0.12, 0.03);
            animation-timing-function: cubic-bezier(0.09, 0.3, 0.12, 0.03);
            width: 44px;
            height: 22px;
            margin-top: -22px;
            margin-left: -22px;
            border-color: #2172b8;
            border-top-left-radius: 36px;
            border-top-right-radius: 36px;
        }
        div.spinner i:nth-child(2) {
            -moz-animation-timing-function: cubic-bezier(0.09, 0.6, 0.24, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 0.6, 0.24, 0.03);
            animation-timing-function: cubic-bezier(0.09, 0.6, 0.24, 0.03);
            width: 58px;
            height: 29px;
            margin-top: -29px;
            margin-left: -29px;
            border-color: #18a39b;
            border-top-left-radius: 42px;
            border-top-right-radius: 42px;
        }
        div.spinner i:nth-child(3) {
            -moz-animation-timing-function: cubic-bezier(0.09, 0.9, 0.36, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 0.9, 0.36, 0.03);
            animation-timing-function: cubic-bezier(0.09, 0.9, 0.36, 0.03);
            width: 72px;
            height: 36px;
            margin-top: -36px;
            margin-left: -36px;
            border-color: #82c545;
            border-top-left-radius: 48px;
            border-top-right-radius: 48px;
        }
        div.spinner i:nth-child(4) {
            -moz-animation-timing-function: cubic-bezier(0.09, 1.2, 0.48, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 1.2, 0.48, 0.03);
            animation-timing-function: cubic-bezier(0.09, 1.2, 0.48, 0.03);
            width: 86px;
            height: 43px;
            margin-top: -43px;
            margin-left: -43px;
            border-color: #f8b739;
            border-top-left-radius: 54px;
            border-top-right-radius: 54px;
        }
        div.spinner i:nth-child(5) {
            -moz-animation-timing-function: cubic-bezier(0.09, 1.5, 0.6, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 1.5, 0.6, 0.03);
            animation-timing-function: cubic-bezier(0.09, 1.5, 0.6, 0.03);
            width: 100px;
            height: 50px;
            margin-top: -50px;
            margin-left: -50px;
            border-color: #f06045;
            border-top-left-radius: 60px;
            border-top-right-radius: 60px;
        }
        div.spinner i:nth-child(6) {
            -moz-animation-timing-function: cubic-bezier(0.09, 1.8, 0.72, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 1.8, 0.72, 0.03);
            animation-timing-function: cubic-bezier(0.09, 1.8, 0.72, 0.03);
            width: 114px;
            height: 57px;
            margin-top: -57px;
            margin-left: -57px;
            border-color: #ed2861;
            border-top-left-radius: 66px;
            border-top-right-radius: 66px;
        }
        div.spinner i:nth-child(7) {
            -moz-animation-timing-function: cubic-bezier(0.09, 2.1, 0.84, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 2.1, 0.84, 0.03);
            animation-timing-function: cubic-bezier(0.09, 2.1, 0.84, 0.03);
            width: 128px;
            height: 64px;
            margin-top: -64px;
            margin-left: -64px;
            border-color: #c12680;
            border-top-left-radius: 72px;
            border-top-right-radius: 72px;
        }
        div.spinner i:nth-child(8) {
            -moz-animation-timing-function: cubic-bezier(0.09, 2.4, 0.96, 0.03);
            -webkit-animation-timing-function: cubic-bezier(0.09, 2.4, 0.96, 0.03);
            animation-timing-function: cubic-bezier(0.09, 2.4, 0.96, 0.03);
            width: 142px;
            height: 71px;
            margin-top: -71px;
            margin-left: -71px;
            border-color: #5d3191;
            border-top-left-radius: 78px;
            border-top-right-radius: 78px;
        }

        @-moz-keyframes rotate {
            to {
                -moz-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-webkit-keyframes rotate {
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes rotate {
            to {
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body onload="services()">
@include('front.client.preloader')
@include('front.client.navbar')

<div class="content">
    @yield('content')
</div>
<script>
    function home() {
        document.getElementById('home').style.display = 'block';
        document.getElementById('services').style.display = 'none';
    }
    function services() {
        document.getElementById('home').style.display = 'none';
        document.getElementById('services').style.display = 'block';
    }
</script>
<script>
    $(document).ready(function($) {
        var Body = $('body');
        Body.addClass('preloader-site');
    });
    $(window).on('load',function() {
        $('.preloader-wrapper').fadeOut();
        $('body').removeClass('preloader-site');
    });

    const indicator = document.querySelector('.nav-indicator');
    const items = document.querySelectorAll('.nav-item');
    function handleIndicator(el) {
        items.forEach(item => {
            item.classList.remove('is-active');
            item.removeAttribute('style');
        });

        indicator.style.width = `${el.offsetWidth}px`;
        indicator.style.left = `${el.offsetLeft}px`;
        indicator.style.backgroundColor = el.getAttribute('active-color');

        el.classList.add('is-active');
        el.style.color = el.getAttribute('active-color');
    }
    items.forEach((item, index) => {
        item.addEventListener('click', (e) => { handleIndicator(e.target)});
        item.classList.contains('is-active') && handleIndicator(item);
    });
</script>
</body>
</html>
