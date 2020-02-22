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
   <link href="{{asset('css/client.css')}}" rel="stylesheet">
</head>
<body >
@include('front.client.partials.preloader')
@include('front.client.partials.navbar')

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
</script>
<script>
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
