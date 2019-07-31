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
        <section class="breadcrumbs-legal">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div id="navigation" class="text-left">
                            @yield('breadcrumbs')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="header-legal">
            <div class="container">
                <div class="row">
                    <div class="col title-legal">
                        <h1>@yield('legalTitle')</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col navigation-legal"><a href="{{url('legal')}}">{{__('footer.legal')}}</a><a href="{{url('legal/privacy')}}">{{__('footer.privacy')}}</a><a href="{{url('legal/cookies')}}">{{__('footer.cookies')}}</a></div>
                </div>
            </div>
        </section>
        <section class="content-legal">
            <div class="container">
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
        @include('inc.footer')
        <script src="{{mix('assets/js/wb_app.js')}}"></script>
    </body>
</html>
