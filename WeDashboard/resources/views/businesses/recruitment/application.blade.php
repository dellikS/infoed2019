@extends('layouts.app')
@section('template_title')
  {{'Showing application #'.$application->id }}
@endsection
@section('content')
<section class="business-zone banner pb-4">
    <div class="container">
        <div class="row content">
            <div class="col">
                <div class="business-info float-left">
                    <h4>
                        {{ $application->user->first_name.' '.$application->user->last_name }}'s Application
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="position: absolute;right: 0;z-index: 19;">
    <a href="{{ url('businesses/'.$application->business->id.'/applications') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('businesses.tooltips.back-businesses') }}">
    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
    {!! trans('businesses.buttons.back-to-applications') !!}
    </a>
</div>
<section class="business-info-box mt-n5 mb-4">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 business-info-section">
                        <div class="header">
                            <h4 class="title">{{ trans('Survey') }}</h4>
                        </div>
                        <div class="business-info">
                            @foreach ($application->questions as $key => $question)
                                <ul class="list-unstyled">
                                    <li class="label">{{ $question }}</li> 
                                    <li class="info">{{ $application->answers[$key] }}</li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 business-info-section">
                        <div class="header">
                            <h4 class="title">{{ trans('Details') }}</h4>
                        </div>
                        <div class="business-info">
                            <ul class="list-unstyled">
                                <li class="label">Created date</li>
                                <li class="info">{{ $application->created_at->format('d/m/Y H:i') }}</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="label">Candidate's username</li>
                                <li class="info"><a href="{{ url('/profile/'.$application->user->name) }}">{{ $application->user->name }}</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="label">Business name</li>
                                <li class="info"><a href="{{ url('/businesses/'.$application->business->id) }}">{{ $application->business->name }}</a></li>
                            </ul>
                            <hr>
                            <ul class="list-unstyled">
                                <li class="label">Status</li>
                                <li class="info">
                                @if ($application->status === null)
                                    Pending
                                @elseif ($application->status === 1)
                                    <span class="text-success">Accepted</span>
                                @elseif ($application->status === 0)
                                    <span class="text-danger">Rejected</span>
                                @endif
                             
                            </ul>
                            @if ($application->status !== null)
                            <ul class="list-unstyled">
                                <li class="label">Answerer</li>
                                <li class="info">{{ $application->answerer->first_name.' '.$application->answerer->last_name }}</li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="label">Reason / Response</li>
                                <li class="info">{{ $application->reason }}</li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($application->business->isOwnerHere() && $application->status === null)
                {!! Form::model($application, array('action' => array('RecruitmentController@respond', $application->id), 'method' => 'PUT')) !!}
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-md-4 business-info-section m-0">
                        <div class="business-info m-0">
                            <label class="label" for="reason">Status</label>
                            <select id="status" name="status" required class="form-control rad">
                                <option value="" disabled="" selected {{ old('status') == "" ? 'selected' : '' }}>{{ __('Change application status') }}</option>
                                <option value="1">{{ __('Accepted') }}</option>
                                <option value="0">{{ __('Rejected') }}</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 business-info-section m-0">
                        <div class="business-info">
                            {!! Form::label('reason', trans('forms.business_label_reason'), array('for' => 'reason', 'class' => 'label')); !!}
                            {!! Form::textarea('reason', $application->reason, ['rows' => '4','class' => 'form-control', 'type' => 'text','maxlength' => '1500', 'required', 'autofocus']) !!}
                        </div>
                        @if ($errors->has('reason'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('reason') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {!! Form::button(
                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('Respond to application'),
                        array(
                        'class'             => 'btn btn-dark',
                        'type'              => 'submit',
                        'data-submit'       => trans('Respond to application'),
                        )) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                @endif
            </div>
        </div> 
    </div>
</section>
@endsection
