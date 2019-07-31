<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') - @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="Novac Dan Andrei">
        <link rel="shortcut icon" href="/favicon.svg">

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        <link href="{{ mix('assets/css/wb_app.css') }}" rel="stylesheet">

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')
            
            html,
            body {
                height: 100%;
                box-sizing: border-box;
            }

            html {
                overflow-y: hidden;
            }

        </style>

        {{-- Scripts --}}

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>


        @yield('head')

    </head>
    <body>
        <div id="wb_app">
            @include('partials.nav')

            <main @auth @if (Auth::user()->activated == true) id="is-auth" @endif  @endauth class="dashboard-container main-content pb-4">
                
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            @include('partials.form-status')
                        </div>
                    </div>
                </div>
                
                @yield('content')

            </main>

        </div>

        {{-- Scripts --}}
        <script src="{{ mix('assets/js/wb_app.js') }}"></script>
        @if(config('settings.googleMapsAPIStatus'))
            {!! HTML::script('//maps.googleapis.com/maps/api/js?key='.config("settings.googleMapsAPIKey").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
        @endif
        
        @include('scripts.dashboard-nav-toggle')
        
        @yield('footer_scripts')
        
    </body>
</html>
