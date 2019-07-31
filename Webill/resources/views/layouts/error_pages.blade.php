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
    <body class="errors">
        <section class="section-error">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1><strong>@yield('code')</strong>&nbsp;@yield('pageTitle')</h1>
                    </div>
                </div>
                <div class="row describe-error">
                    <div class="col">
                        <h2>@yield('message')</h2>
                        <p>@yield('message_two')</p>
                    </div>
                </div>
                <div class="row describe-error text-center">
                    <div class="col"><img src="{{asset('assets/svg/cityscape.svg')}}" class="img-fluid" /></div>
                </div>
            </div>
        </section>
        <section class="usefull-links">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2>{{__('errors.usefull-links')}}</h2>
                    </div>
                </div>
                <div class="row row-3">
                    <div class="col-md-4">
                        <div class="row custom-card" onclick="location.href='{{url('/')}}';">
                            <div class="col-2 pad-0"><img src="{{asset('assets/svg/house.svg')}}" class="img-fluid" /></div>
                            <div class="col-10">
                                <h3>{{__('errors.go-homepage')}}</h3>
                                <p>{{__('errors.go-homepage-sub')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="row custom-card" onclick="location.href='{{url('services/webill')}}';">
                            <div class="col-2 pad-0"><img src="{{asset('assets/svg/list.svg')}}" class="img-fluid" /></div>
                            <div class="col-10">
                                <h3>{{__('errors.go-webill')}}</h3>
                                <p>{{__('errors.go-webill-sub')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row custom-card" onclick="location.href='{{url('services/webiz')}}';">
                            <div class="col-2 pad-0"><img src="{{asset('assets/svg/id-card-2.svg')}}" class="img-fluid" /></div>
                            <div class="col-10">
                                <h3>{{__('errors.go-webiz')}}</h3>
                                <p>{{__('errors.go-webiz-sub')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="still-not-working">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>{{__('errors.having-issues')}}&nbsp;<a href="#">{{__('errors.contact-us')}}</a></h3>
                    </div>
                </div>
            </div>
        </section>       
        @include('inc.footer')
        <script src="{{mix('assets/js/wb_app.js')}}"></script>
    </body>
</html>