@extends('layouts.app')

@section('content')
<div id="primary-login">
    <div class="loginForm">
        <section id="sectionLogin">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <fieldset>
                    <div class="container">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="col-md-11">
                                        <div class="field-wrapper flat">
                                            <div class="input-wrapper margin-bottom-20">
                                                <input id="name" class="form-control{{ $errors->has('email') || $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{__('auth.ph_email_or_username')}}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-login">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif

                                                @if ($errors->has('name'))
                                                <span class="invalid-login">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-11">
                                        <div class="field-wrapper flat">
                                            <div class="input-wrapper margin-bottom-20">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{__('auth.ph_password')}}" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-login">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-11">
                                        <div class="field-wrapper flat">
                                            <div class="input-wrapper">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="rememberme" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                                    <label for="rememberme" class="form-check-label">{{ __('Remember me') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-11 margin-top-30"><button class="btn btn-primary" type="submit" id="login-button">{{ __('Login') }}</button><button class="btn btn-primary" onclick="window.location.href='{{ route('register') }}'" type="button" id="register-button">{{ __('Register Now!') }}</button></div>
                                    <div class="col-md-11 margin-top-30"><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="box-light">
                                    <h4>For your security</h4>
                                    <ol>
                                        <li>Webiz will never ask you to disclose your username, password, or a PIN by e-mail.<br /></li>
                                        <li>The Webiz log-in page is encrypted, which is why its address begins with &quot;https://&quot;<br /></li>
                                    </ol>
                                    <h4>Now even more security with the 2-step login<br /></h4>
                                    <p>In addition to your Webiz password, you can now enter a second authentication code. This new facility provides an auxiliary protection against unauthorized access to your account. You can activate this added
                                        security for free in &quot;My data&quot;.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </div>
</div>

@include('partials.auth-footer')

@endsection
