@extends('layouts.app')

@section('template_title')
    {!! trans('businesses.editing-business', ['name' => $business->name]) !!}
@endsection

@section('content')
<section class="business-zone banner">
    <div class="container">
        <div class="row content">
            <div class="col">
                <div class="business-info float-left">
                    <h4 id="business-name">Manage your Business<small> ({{ $business->name }}) </small></h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tab-system">
    <div class="container">
        <div class="row">
            <div class="col-md-auto">
                <div id="navigation">
                <div class="nav">
                    <a data-toggle="tab" href="#business" class="active">
                    Business settings
                    </a> 
                    <a data-toggle="tab" href="#project">
                    Projects management
                    </a> 
                    <a data-toggle="tab" href="#recruit">
                    Recruitment
                    </a> 
                </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<div style="position: absolute;right: 0;z-index: 19;">
    <a href="{{ url('businesses/'.$business->id) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('businesses.tooltips.back-business') }}">
    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
    {!! trans('businesses.buttons.back-to-business') !!}
    </a>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content">
                            <div id="business" class="tab-pane fade active show">
                                {!! Form::model($business, array('action' => array('BusinessesController@update', $business->id), 'method' => 'PUT', 'id' => 'business_basics_form')) !!}
                                {{ csrf_field() }}
                                <div class="form-group row ">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            {!! Form::label('motd', trans('forms.business_label_motd'), array('for' => 'motd')); !!}  
                                            {!! Form::text('motd', $business->motd, array('id' => 'motd', 'class' => 'form-control special-input', 'placeholder' => trans('forms.business_ph_motd'))) !!}
                                        </div>
                                        @if($errors->has('motd'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('motd') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('name', trans('forms.business_label_name'), array('for' => 'name')); !!}
                                            {!! Form::text('name', $business->name, array('id' => 'name', 'required' => 'required', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_name'))) !!}
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input group">
                                            {!! Form::label('currency', trans('forms.business_label_currency'), array('for' => 'currency')); !!}
                                            <select id="currency" name="currency" required class="form-control rad" onchange="changeCurrency()">
                                                <option value="" disabled="" {{ old('currency') == "" ? 'selected' : '' }}>Money Currency</option>
                                                <option value="EUR" {{ $business->currency == "EUR" ? 'selected' : '' }}>EUR</option>
                                                <option value="USD" {{ $business->currency == "USD" ? 'selected' : '' }}>USD</option>
                                                <option value="RON" {{ $business->currency == "RON" ? 'selected' : '' }}>RON</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('currency'))
                                            <span class="invalid-phone">
                                                <strong>{{ $errors->first('currency') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            {!! Form::label('description', trans('forms.business_label_description'), array('for' => 'description')); !!}
                                            {!! Form::textarea('description', $business->description, ['style' => 'height: 150px','class' => 'form-control', 'type' => 'text','maxlength' => '1500', 'required', 'autofocus']) !!}
                                        </div>
                                        @if($errors->has('description'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('type') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('type', trans('forms.business_label_type'), array('for' => 'type')); !!}
                                            {!! Form::text('type', $business->type, array('id' => 'type', 'required' => 'required',  'class' => 'form-control', 'placeholder' => trans('forms.business_ph_type'))) !!}
                                        </div>
                                        @if($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('address') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('address', trans('forms.business_label_address'), array('for' => 'address')); !!}
                                            {!! Form::text('address', $business->address, array('id' => 'address', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_address'))) !!}
                                        </div>
                                        @if($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }} {{ $errors->has('website') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('email', trans('forms.business_label_email'), array('for' => 'email')); !!}
                                            {!! Form::text('email', $business->email, array('id' => 'email',  'required' => 'required', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_email'))) !!}
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('website', trans('forms.business_label_website'), array('for' => 'website')); !!}
                                            {!! Form::text('website', $business->website, array('id' => 'website', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_website'))) !!}
                                        </div>
                                        @if ($errors->has('website'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('phone') ? ' has-error ' : '' }} {{ $errors->has('fax') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('phone', trans('forms.business_label_phone'), array('for' => 'phone')); !!}
                                            {!! Form::text('phone', $business->phone, array('id' => 'phone', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_phone'))) !!}
                                        </div>
                                        @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('fax', trans('forms.business_label_fax'), array('for' => 'fax')); !!}
                                            {!! Form::text('fax', $business->fax, array('id' => 'fax', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_fax'))) !!}
                                        </div>
                                        @if ($errors->has('fax'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        {!! Form::button(
                                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitProfileButton'),
                                        array(
                                        'class'             => 'btn btn-dark disabled',
                                        'id'                => 'business_save_trigger',
                                        'disabled'          => true,
                                        'type'              => 'submit',
                                        'data-submit'       => trans('profile.submitProfileButton'),
                                        )) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div id="project" class="tab-pane fade">
                                @if($business->project)
                                {!! Form::model($business, array('action' => array('BusinessesController@updateProject', $business->id), 'method' => 'PUT', 'id' => 'business_project_form')) !!}
                                {{ csrf_field() }}
                                <div class="attention">
                                    <span>You can not change the deadline until one week before it expires!</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group has-feedback row {{ $errors->has('title') ? ' has-error ' : '' }}">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    {!! Form::label('title', trans('forms.business_label_title'), array('for' => 'title')); !!}
                                                    {!! Form::text('title', $business->project->title, array('id' => 'title', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_title'))) !!}
                                                </div>
                                                @if($errors->has('title'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    {!! Form::label('deadline', trans('forms.business_label_deadline'), array('for' => 'deadline')); !!}  
                                                    {!! Form::text('deadline', $business->project->deadline->format('d/m/Y'), array('id' => 'deadline', \Carbon\Carbon::now()->addDays(7) < $business->project->deadline ? 'disabled style="cursor: not-allowed"' : '', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_deadline'))) !!}
                                                </div>
                                                @if($errors->has('deadline'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('deadline') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-md-6">
                                                {{ trans('businesses.budget')}} <span class="text-success font-weight-bold">{{$business->project->budget.' '.$business->project->currency}} </span>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback row {{ $errors->has('details') ? ' has-error ' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    {!! Form::label('details', trans('forms.business_label_details'), array('for' => 'details')); !!}
                                                    {!! Form::textarea('details', $business->project->details, ['style' => 'height: 125px','class' => 'form-control', 'type' => 'text','maxlength' => '1500', 'required', 'autofocus']) !!}
                                                </div>
                                                @if($errors->has('details'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('details') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback row {{ $errors->has('instruction') ? ' has-error ' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    {!! Form::label('instruction', trans('forms.business_label_instruction'), array('for' => 'instruction')); !!}
                                                    {!! Form::textarea('instruction', $business->project->instruction, ['id'=> 'editor', 'class' => 'form-control', 'type' => 'text','maxlength' => '2000', 'required', 'autofocus']) !!}
                                                </div>
                                                @if($errors->has('instruction'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('instruction') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                {!! Form::button(
                                                '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('businesses.submitProjectButton'),
                                                array(
                                                'class'             => 'btn btn-dark disabled',
                                                'id'                => 'business_project_save_trigger',
                                                'disabled'          => true,
                                                'type'              => 'submit',
                                                'data-submit'       => trans('businesses.submitProjectButton'),
                                                )) !!}
                                            </div> 
                                            {!! Form::close() !!}
                                            <div class="row mt-2">
                                            {!! Form::model($business, array('action' => array('BusinessesController@deleteProject', $business->id), 'method' => 'DELETE')) !!}
                                                <label class="small"  for="#checkConfirmDelete">Confirm project deletion</label>
                                                <input type="checkbox" name='checkConfirmDelete' id="checkConfirmDelete"><br>
                                                {!! Form::button(
                                                    '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> ' . trans('businesses.deleteProjectBtn'),
                                                    array(
                                                    'class'             => 'btn btn-danger',
                                                    'id'                => 'delete_project_trigger',
                                                    'disabled'          => true,
                                                    'type'              => 'button',
                                                    'data-toggle'       => 'modal',
                                                    'data-submit'       => trans('businesses.deleteProjectBtn'),
                                                    'data-target'       => '#confirmForm',
                                                    'data-modalClass'   => 'modal-danger',
                                                    'data-title'        => 'Confirm Project Deletion',
                                                    'data-message'      => 'Are you sure you want to delete your project?'
                                                    )
                                                    ) !!}
                                            {!! Form::close() !!}    
                                            </div>                            
                                        </div>
                                    </div>
                                </div>  
                                @else
                                {!! Form::model($business, array('action' => array('BusinessesController@updateProject', $business->id), 'method' => 'PUT', 'id' => 'business_project_form')) !!}
                                {{ csrf_field() }}
                                <div class="attention">
                                    <span>Your business does not have any ongoing projects at the moment!</span>
                                    <ul class="pl-3 m-0">
                                        <li>The currency of the budget is the currency in which the business is currently operating</li>
                                    </ul>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('title') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('title', trans('forms.business_label_title'), array('for' => 'title')); !!}
                                            {!! Form::text('title', null, array('id' => 'title', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_title'))) !!}
                                        </div>
                                        @if($errors->has('title'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('deadline', trans('forms.business_label_deadline'), array('for' => 'deadline')); !!}  
                                            {!! Form::text('deadline', null, array('id' => 'deadline', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_deadline'))) !!}
                                        </div>
                                        @if($errors->has('deadline'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('deadline') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  has-feedback row {{ $errors->has('budget') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span id="budget" class="input-group-addon currency">{{ $business->currency }}</span>
                                            <input id="budget" type="text" class="form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name="budget" value="{{ old('budget') }}" placeholder="{{ __('auth.budget') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('budget'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('budget') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('details') ? ' has-error ' : '' }}">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            {!! Form::label('details', trans('forms.business_label_details'), array('for' => 'details')); !!}
                                            {!! Form::textarea('details', null, ['style' => 'height: 150px','class' => 'form-control', 'type' => 'text','maxlength' => '1500', 'required', 'autofocus']) !!}
                                        </div>
                                        @if($errors->has('details'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('instruction') ? ' has-error ' : '' }}">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            {!! Form::label('instruction', trans('forms.business_label_instruction'), array('for' => 'instruction')); !!}
                                            {!! Form::textarea('instruction', null, ['class' => 'form-control', 'type' => 'text','maxlength' => '2000', 'required', 'autofocus']) !!}
                                        </div>
                                        @if($errors->has('instruction'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('instruction') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="row">
                                        {!! Form::button(
                                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('businesses.createProjectButton'),
                                        array(
                                        'class'             => 'btn btn-dark disabled',
                                        'id'                => 'business_project_save_trigger',
                                        'disabled'          => true,
                                        'type'              => 'submit',
                                        'data-submit'       => trans('businesses.createProjectButton'),
                                        )) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                @endif
                            </div>
                            <div id="recruit" class="tab-pane fade">
                                {!! Form::model($business, array('action' => array('BusinessesController@updateRecruitment', $business->id), 'method' => 'PUT', 'id' => 'business_recruitment_form')) !!}
                                {{ csrf_field() }}
                                <div class="form-group has-feedback row {{ $errors->has('hiring') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <label class="switch mr-2">
                                            {!! Form::checkbox('hiring', true, $business->hiring) !!}
                                            <span class="sliderbox round"></span>
                                            <span class="ontext">ON</span>
                                        </label>
                                        <span>Application status</span>
                                    </div>
                                </div>
                                <div class="form-group row has-feedback">
                                    <div class="col-md-8 controls">
                                    @if ($business->survey)
                                        @foreach($business->survey->questions as $question) 
                                            @if ($loop->last)
                                                <div class="input-group mt-2 entry">
                                                    <input name="questions[]" type="text" class="form-control" placeholder="Enter question here" value="{{ $question }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="input-group mt-2 entry">
                                                    <input name="questions[]" type="text" class="form-control" placeholder="Enter question here" value="{{ $question }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-danger btn-remove" type="button">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="input-group mt-2 entry">
                                            <input name="questions[]" type="text" class="form-control" placeholder="Enter question here">
                                            <div class="input-group-append">
                                                <button class="btn btn-success btn-add" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-4">
                                        {!! Form::button(
                                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('businesses.submitAppButton'),
                                        array(
                                        'class'             => 'btn btn-dark disabled',
                                        'id'                => 'business_recruitment_save_trigger',
                                        'disabled'          => true,
                                        'type'              => 'submit',
                                        )) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-form')
@endsection

@section('footer_scripts')
    <script>
        CKEDITOR.replace( 'instruction' );
    </script>
    @include('scripts.form-modal-script')
    @include('scripts.date-input-script')
    @include('scripts.form-script')
@endsection
