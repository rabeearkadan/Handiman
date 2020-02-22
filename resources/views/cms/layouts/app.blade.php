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
    <link rel="stylesheet" href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css">

    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    @stack('css')
    @stack('js_links')
    @stack('style_links')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('cms.layouts.header')

    <div class="app-main">
        @include('cms.layouts.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner">
                @yield('content')
            </div>
            @include('cms.layouts.footer')
        </div>
        <script type="text/javascript" src="{{asset('scripts/main.js')}}"></script>
    </div>
@stack('js')


</body>
</html>

