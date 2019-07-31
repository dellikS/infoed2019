@extends('layouts.app')
@section('template_title')
{!! trans('businesses.create-new') !!}
@endsection
@section('content')
<section class="business-zone banner business-view">
    <div class="container content">
        <div class="row">
            <div class="col">
                <h4 class="page-title">{!! trans('businesses.create-new') !!}</h4>
            </div>
        </div>
    </div>
</section>
<div style="position: absolute;right: 0;z-index: 19;">
    <a href="{{ url('businesses') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('businesses.tooltips.back-businesses') }}">
    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
    {!! trans('businesses.buttons.back-to-businesses') !!}
    </a>
</div>
   <div class="container mt-n5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="needs-validation" action="{{ url('businesses') }}">
                            @csrf
                                <fieldset>
                                    <div class="form-row">
                                        <div class="col">
                                            <h4>{{ __('auth.biz_details') }}</h4>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('auth.biz-name') }}" required autofocus>
                                
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                    <select id="currency" name="currency" required class="form-control rad" onchange="changeCurrency()">
                                                        <option value="" disabled="" {{ old('currency') == "" ? 'selected' : '' }}>Money Currency</option>
                                                        <option value="EUR" {{ old('currency') == "EUR" ? 'selected' : '' }}>EUR</option>
                                                        <option value="USD" {{ old('currency') == "USD" ? 'selected' : '' }}>USD</option>
                                                        <option value="RON" {{ old('currency') == "RON" ? 'selected' : '' }}>RON</option>
                                                    </select>
                                                    @if ($errors->has('currency'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('currency') }}</strong>
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
                                                    <input id="type" name="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" value="{{ old('type') }}" type="text" required autofocus placeholder="Field of activity">
                                                </div>
                                                @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                    <input id="vacancies" type="number" name="vacancies" min='1' max='10'class="form-control {{ $errors->has('vacancies') ? ' is-invalid' : '' }}" value="{{ old('vacancies') }}" required autofocus placeholder="Vacancies (max. 10 people)">
                                                </div>
                                                @if ($errors->has('vacancies'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('vacancies') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                    <textarea id="description" type="text" name="description" max="1500" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" required autofocus placeholder="Describe your business">{{ old('description') }}</textarea>
                                                </div>
                                                @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pt-3">
                                        <div class="col">
                                            <h4>{{ __('auth.biz_additional') }}</h4>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                    <select id="country_id" name="country_id" class="form-control" onchange="changePrefix()">
                                                        @foreach ($country_array as $country)
                                                        <option data-phone="{{ $country->phonecode }}" value="{{ $country->id }}" {{ App::getLocale() == $country->code ? ' selected' : '' }}>{{ $country->name }}</option>;
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('country_id'))
                                                        <span class="help-block">
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
                                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="{{ __('auth.biz-address') }}" autofocus>
                                                    @if ($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                <span id="phone" class="input-group-addon prefix"></span>
                                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" maxlength="17" name="phone" value="{{ old('phone') }}" placeholder="{{ __('auth.biz-phone') }}" autofocus>
                                                </div>
                                                @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <span id="fax" class="input-group-addon prefix"></span>
                                                    <input id="fax" type="text" class="form-control{{ $errors->has('fax') ? ' is-invalid' : '' }}" maxlength="17" name="fax" value="{{ old('fax') }}" placeholder="{{ __('auth.biz-fax') }}" autofocus>
                                                </div>
                                                @if ($errors->has('fax'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('fax') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  name="email" value="{{ old('email') }}" placeholder="{{ __('auth.biz-email') }}" required autofocus>
                                                </div>
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"  name="website" value="{{ old('website') }}" placeholder="{{ __('auth.biz-web') }}" autofocus>
                                                </div>
                                                @if ($errors->has('website'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('website') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-dark btn-next" name="next" type="button" value="Next">{{ __('pagination.next')}}</button>
                                </fieldset>
                                <fieldset>
                                    <div class="form-row">
                                        <div class="col">
                                            <h4>{{ __('auth.project_details') }}</h4>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" maxlength="32" name="title" value="{{ old('title') }}" placeholder="{{ __('auth.project-title') }}" required autofocus>
                                                </div>
                                                @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                    <input id="deadline" type="tel" name="deadline" class="form-control{{ $errors->has('deadline') ? ' is-invalid' : '' }}" value="{{ old('deadline') }}" required autofocus placeholder="{{ __('auth.project-deadline') }}"> 
                                                </div>
                                                @if ($errors->has('deadline'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('deadline') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <textarea id="details" type="text" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" placeholder="{{ __('auth.project-details') }}" required autofocus>{{ old('details') }}</textarea>
                                                </div>
                                                @if ($errors->has('details'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('details') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <textarea id="instruction" type="text" style="height:150px" class="form-control{{ $errors->has('instruction') ? ' is-invalid' : '' }}" name="instruction" placeholder="{{ __('auth.project-instruction') }}" required autofocus>{{ old('instruction') }}</textarea>
                                                </div>
                                                @if ($errors->has('instruction'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('instruction') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div class="input-group">
                                                    <span id="budget" class="input-group-addon currency">{{ old('currency') }}</span>
                                                    <input id="budget" type="text" class="form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name="budget" value="{{ old('budget') }}" placeholder="{{ __('auth.budget') }}" required autofocus>
                                                </div>
                                                @if ($errors->has('budget'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('budget') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-dark btn-prev" type="button">{{ __('pagination.previous')}}</button>
                                    <button type="submit" class="float-right btn btn-primary" type="button">Create business</button>
                                </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer_scripts')
    <script>
        CKEDITOR.replace( 'instruction' );
    </script>
    @include('scripts.date-input-script')
    @include('scripts.business-tabs-script')
@endsection