@extends('layouts.app')

@section('content')

<div id="primary" class="primary">
    <div class="container" id="registerBox">
        <div class="row">
            <div class="col-md-8" id="progressBar">
                <ul> 
                    @yield('progress')
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 step-status secondary-background" id="registration-step"><span class="float-left">@yield('title')</span><span class="float-right show-after-m"><i class="fa fa-info" style="cursor: pointer;"></i></span></div>
        </div>
        <div class="row">
            <div class="col-lg-8 authForm">
                @yield('step')
            </div>
            @yield('step-info')
        </div>
    </div>
</div>

@endsection


@section('footer_scripts')
    @if(config('settings.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
    @include('scripts.date-input-script')
@endsection
