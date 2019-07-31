@extends('auth.register')

@section('progress')
<li><img src="{{asset('assets/svg/add-user.svg')}}"></li>
<li><img src="{{asset('assets/svg/arrow-right.svg')}}"></li>
<li><img src="{{asset('assets/svg/email.svg')}}"></li>
<li><img src="{{asset('assets/svg/arrow-right.svg')}}"></li>
<li><img src="{{asset('assets/svg/ok.svg')}}"></li>
@endsection

@section('step-info')
<div class="col-lg-4 pad-0 watermark hide-after-m">
        <div class="info-box">
            <h2>WeApplication</h2><span>Doar 3 pasi si veti putea obtine contul dumneavoastra WeApplication gratuit!</span>
            <ul class="pointer">
                <li>Vei primi acces instant la toate facilitatile platformei noastre, in perioada BETA!</li>
                <li>Vei putea gestiona resursele umane ale firmei tale printr-o interfata prietenoasa!</li>
                <li>Vei beneficia de ajutor gratuit din partea echipei noastre!</li>
            </ul><span>Proiect creeat exclusiv pentru InfoEducatie, &nbsp; sursa o aveti pe GitHub</span>
        </div>
    </div>
@endsection

@section('title')
    {{ trans('titles.activation') }}
@endsection

@section('step')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <p>{{ trans('auth.regThanks') }}</p>
            <p>{{ trans('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</p>
            <p>{{ trans('auth.clickInEmail') }}</p>
            <p><a href='/activation' class="btn btn-primary">{{ trans('auth.clickHereResend') }}</a></p>
        </div>
    </div>
@endsection