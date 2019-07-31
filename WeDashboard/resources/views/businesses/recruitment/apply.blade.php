@extends('layouts.app')
@section('template_title')
{{ 'Apply to '.$business->name }}
@endsection
@section('content')
<section class="business-zone banner business-view">
    <div class="container content">
        <div class="row">
            <div class="col text-light">
                <h4 class="page-title m-0">{{ $business->name }}</h4>
                <star-rating :rating="{{ $business->getStarRating() }}" border-color="#192B50" :border-width="2" active-color="#CBB956" :star-size="20" :read-only="true" :increment="0.1"></star-rating> 
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
                        {!! Form::model($business, array('action' => array('RecruitmentController@store', $business->id), 'method' => 'POST')) !!}
                        {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col">
                                    <h4>{{ __('Answer the questions below') }}</h4>
                                </div>
                            </div>
                            @foreach($business->survey->questions as $key => $question) 
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <div class="mt-2">
                                            <div>
                                                <label for="answers">{{ $question }}</label>
                                                <textarea id="answers" type="text" class="form-control" name="answers[]"  placeholder="Write the answer here" required autofocus>{{ old('answers.'.$key.'') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-primary mt-4">Submit application</button>
                            {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection