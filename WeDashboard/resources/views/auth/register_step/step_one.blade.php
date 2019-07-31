@extends('auth.register')

@section('progress')
<li id="step_user"><img src="{{asset('assets/svg/add-user.svg')}}"></li>
<li id="step_biz" style="display: none"><img src="{{asset('assets/svg/store-2.svg')}}"></li>
<li><img src="{{asset('assets/svg/arrow-right.svg')}}"></li>
<li><img src="{{asset('assets/svg/email-incomplete.svg')}}"></li>
<li><img src="{{asset('assets/svg/arrow-right.svg')}}"></li>
<li><img src="{{asset('assets/svg/ok.svg')}}"></li>
@endsection

@section('step-info')
<div class="col-lg-4 pad-0 watermark hide-after-m">
        <div class="info-box">
            <h2>WeApplication</h2><span>{{ __('auth.infobox_subtitle') }}</span>
            <ul class="pointer">
                <li>{{ __('auth.infobox_detail1') }}</li>
                <li>{{ __('auth.infobox_detail2') }}</li>
                <li>{{ __('auth.infobox_detail3') }}</li>
            </ul><span>{{ __('auth.infobox_footer') }}</span>
        </div>
    </div>
@endsection

@section('title')
    {{ __('auth.enter_details')}}
@endsection

@section('step')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-row">
        <div class="col">
            <h4>{{ __('auth.personal_details')}}</h4>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6 col-md-4">
            <div class="pt-3">
                <div>
                    <select id="gender" name="gender" required class="form-control rad">
                        <option value="" disabled="" {{ old('gender') == "" ? 'selected' : '' }}>{{ __('auth.title_gender') }}</option>
                        <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>{{ __('auth.mr') }}</option>
                        <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>{{ __('auth.mrs') }}</option>
                    </select>
                    @if ($errors->has('gender'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('auth.first_name') }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('auth.last_name') }}" required autofocus>

                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="birth_date" type="tel" name="birth_date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" value="{{ old('birth_date') }}" placeholder="{{ __('auth.birthdate_input') }}"> 
                </div>
                @if ($errors->has('birth_date'))
                <span class="invalid-phone">
                    <strong>{{ $errors->first('birth_date') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="pt-3">
                <div class="input-group">
                <span id="phone" class="input-group-addon">{{ __('auth.prefix') }}</span>
                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" maxlength="17" name="phone" value="{{ old('phone') }}" placeholder="{{ __('auth.phone') }}" required autofocus>
                </div>
                @if ($errors->has('phone'))
                <span class="invalid-phone">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-row pt-3">
        <div class="col">
            <h4>{{ __('auth.address_details')}}</h4>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <select id="country_id" name="country_id" class="form-control" onchange="$('#languageSwitcher').val($(this).children('option:selected').data('country')); $('#languageSwitcher').change()">
                        @if ($country_array)
                            @foreach ($country_array as $country)
                                <option data-country="{{ $country->code }}" value="{{ $country->id }}" {{ App::getLocale() == $country->code ? ' selected' : '' }}>{{ $country->name }}</option>;
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('country_id'))
                    <span class="invalid-phone">
                        <strong>{{ $errors->first('country_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="address" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" type="text" placeholder="{{ __('auth.address_details') }}">
                    @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-row pt-3">
        <div class="col">
            <h4>{{ __('auth.registration_details')}}</h4>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  placeholder="{{ __('auth.name') }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('auth.password') }}" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="pt-3">
                <div>
                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="{{ __('auth.confirmPassword') }}" required>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="pt-3">
                @if(config('settings.reCaptchStatus'))
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-4">
                            <div class="g-recaptcha" data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">{{ __('Register') }}</button>
</form>
<div style="display: none">
    <form action="{{ route('language') }}" method="post" >
        <select name="locale" id="languageSwitcher" onchange="this.form.submit();">
            @foreach ($country_array as $country)
                <option value="{{ $country->code }}">{{ $country->name }}</option>;
            @endforeach
        </select>
        @csrf
    </form>
</div>

@endsection