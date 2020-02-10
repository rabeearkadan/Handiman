<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Genie</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="Genie">
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body>
@include('cms.layouts.header')

@include('cms.layouts.sidebar')

<div class="app-main">
    @include('cms.layouts.sidebar')
    <div class="app-main__outer">
        <div class="app-main__inner">
            @yield('content')
        </div>
        @include('cms.layouts.footer')
    </div>
</div>
</div>
<script type="text/javascript" src="{{asset('scripts/main.js')}}"></script>

@stack('js')
</body>
</html>

