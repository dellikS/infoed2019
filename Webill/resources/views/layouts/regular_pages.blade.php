<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{mix('assets/css/wb_app.css')}}">

        <title>@yield('pageTitle') - {{config('app.name', 'Webiz')}}</title>

    </head>
    <body>
        @include('inc.navigation')
        <div id="wb_app"><backtotop></backtotop></div>
        @yield('content')
        @include('inc.footer')
        <script src="{{mix('assets/js/wb_app.js')}}"></script>
    </body>
</html>
