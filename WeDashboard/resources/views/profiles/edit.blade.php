

@extends('layouts.app')
@section('template_title')
{{ trans('profile.templateTitle') }}
@endsection
@section('content')
@if ($user->profile)
@if (Auth::user()->id == $user->id)
<section class="profile-zone banner">
    <div class="container">
        <div class="row content">
            <div class="col">
                <div class="profile-info float-left">
                    <h4>{{ trans('profile.templateTitle') }}</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tab-system mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-auto">
                <div id="navigation">
                    <div class="nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="active" data-toggle="pill" href=".edit-profile-tab" role="tab" aria-controls="edit-profile-tab" aria-selected="true">
                        {{ trans('profile.editProfileTitle') }}
                        </a>
                        <a data-toggle="pill" href=".edit-settings-tab" role="tab" aria-controls="edit-settings-tab" aria-selected="false">
                        {{ trans('profile.editAccountTitle') }}
                        </a>
                        <a data-toggle="pill" href=".edit-password-tab" role="tab" aria-controls="edit-password-tab" aria-selected="false">
                        {{ trans('profile.changePwPill') }}
                        </a>
                        <a data-toggle="pill" href=".delete-account-tab" role="tab" aria-controls="delete-account-tab" aria-selected="false">
                        {{ trans('profile.deleteAccountPill') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            @if ($user->profile)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active edit-profile-tab" role="tabpanel" aria-labelledby="edit-profile-tab">
                                <div class="row mb-1">
                                    <div class="col-sm-12">
                                        <div id="avatar_container">
                                            <div class="collapseOne card-collapse collapse @if($user->profile->avatar_status == 0) show @endif">
                                                <div class="card-body">
                                                    <img src="{{  Gravatar::get($user->email) }}" alt="{{ $user->name }}" class="user-avatar">
                                                </div>
                                            </div>
                                            <div class="collapseTwo card-collapse collapse @if($user->profile->avatar_status == 1) show @endif">
                                                <div class="card-body">
                                                    <div class="dz-preview"></div>
                                                    {!! Form::open(array('route' => 'avatar.upload', 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                                                    <img id="user_selected_avatar" class="user-avatar" src="@if ($user->profile->avatar != NULL) {{ $user->profile->avatar }} @endif" alt="{{ $user->name }}">
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->name], 'id' => 'user_profile_form', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-10 offset-1 col-sm-10 offset-sm-1 mb-2">
                                        <div class="row" data-toggle="buttons">
                                            <div class="col-6 col-xs-6">
                                                <label class="btn btn-dark @if($user->profile->avatar_status == 0) active @endif btn-block" style="cursor:pointer" data-toggle="collapse" data-target=".collapseOne:not(.show), .collapseTwo.show">
                                                <input type="radio" name="avatar_status" id="option1" autocomplete="off" value="0" @if($user->profile->avatar_status == 0) checked @endif> Use Gravatar
                                                </label>
                                            </div>
                                            <div class="col-6 col-xs-6">
                                                <label class="btn btn-dark @if($user->profile->avatar_status == 1) active @endif btn-block" style="cursor:pointer" data-toggle="collapse" data-target=".collapseOne.show, .collapseTwo:not(.show)">
                                                <input type="radio" name="avatar_status" id="option2" autocomplete="off" value="1" @if($user->profile->avatar_status == 1) checked @endif> Use My Image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('address') ? ' has-error ' : '' }}">
                                    {!! Form::label('address', trans('profile.label-address') , array('class' => 'col-12 control-label')); !!}
                                    <div class="col-12">
                                        {!! Form::text('address', old('address'), array('id' => 'address', 'class' => 'form-control', 'placeholder' => trans('profile.ph-address'))) !!}
                                        <span class="glyphicon {{ $errors->has('address') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                        @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('country_id') ? ' has-error ' : '' }}">
                                    {!! Form::label('country_id', trans('profile.label-country_id') , array('class' => 'col-12 control-label')); !!}
                                    <div class="col-12">
                                        <select id="country_id" name="country_id" class="form-control">
                                            @if ($country_array)
                                                @foreach ($country_array as $country)
                                                    <option value="{{ $country->id }}" {{$user->profile->country_id == $country->id ? ' selected' : '' }}>{{ $country->name }}</option>;
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('country_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('birth_date') ? ' has-error ' : '' }}">
                                    {!! Form::label('birth_date', trans('profile.label-birth_date') , array('class' => 'col-12 control-label')); !!}
                                    <div class="col-12">
                                        {!! Form::text('birth_date', $birthdate, array('id' => 'birth_date', 'class' => 'form-control', 'placeholder' => trans('profile.ph-birth_date'))) !!}
                                        <span class="glyphicon {{ $errors->has('birth_date') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                        @if ($errors->has('birth_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('bio') ? ' has-error ' : '' }}">
                                    {!! Form::label('bio', trans('profile.label-bio') , array('class' => 'col-12 control-label')); !!}
                                    <div class="col-12">
                                        {!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'form-control', 'placeholder' => trans('profile.ph-bio'))) !!}
                                        <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                        @if ($errors->has('bio'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('twitter_username') ? ' has-error ' : '' }}">
                                    {!! Form::label('twitter_username', trans('profile.label-twitter_username') , array('class' => 'col-12 control-label')); !!}
                                    <div class="col-12">
                                        {!! Form::text('twitter_username', old('twitter_username'), array('id' => 'twitter_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-twitter_username'))) !!}
                                        <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                        @if ($errors->has('twitter_username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('twitter_username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="margin-bottom-2 form-group has-feedback {{ $errors->has('github_username') ? ' has-error ' : '' }}">
                                    {!! Form::label('github_username', trans('profile.label-github_username') , array('class' => 'col-12 control-label')); !!}
                                    <div class="col-12">
                                        {!! Form::text('github_username', old('github_username'), array('id' => 'github_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-github_username'))) !!}
                                        <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                        @if ($errors->has('github_username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('github_username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group margin-bottom-2">
                                    <div class="col-12">
                                        {!! Form::button(
                                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitButton'),
                                        array(
                                        'id'                => 'confirmFormSave',
                                        'class'             => 'btn btn-dark disabled',
                                        'type'              => 'button',
                                        'data-target'       => '#confirmForm',
                                        'data-modalClass'   => 'modal-success',
                                        'data-toggle'       => 'modal',
                                        'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                        'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                        )) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            </div>
                            <div class="tab-pane fade edit-settings-tab" role="tabpanel" aria-labelledby="edit-settings-tab">
                                {!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'id' => 'user_basics_form')) !!}
                                {{ csrf_field() }}
                                <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }} {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('for' => 'first_name')); !!}   
                                            {!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                                        </div>
                                        @if($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('first_name', trans('forms.create_user_label_lastname'), array('for' => 'last_name')); !!}   
                                            {!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                                        </div>
                                        @if($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('name', trans('forms.create_user_label_username'), array('for' => 'name')); !!}
                                            {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_username'))) !!}
                                        </div>
                                        @if($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }} {{ $errors->has('phone') ? ' has-error ' : '' }}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('email', trans('forms.create_user_label_email'), array('for' => 'email')); !!}
                                            {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            {!! Form::label('phone', trans('forms.create_user_label_phone'), array('for' => 'phone')); !!}
                                            {!! Form::text('phone', $user->phone, array('id' => 'phone', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_phone'))) !!}
                                        </div>
                                        @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
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
                                        'id'                => 'account_save_trigger',
                                        'disabled'          => true,
                                        'type'              => 'button',
                                        'data-submit'       => trans('profile.submitProfileButton'),
                                        'data-target'       => '#confirmForm',
                                        'data-modalClass'   => 'modal-success',
                                        'data-toggle'       => 'modal',
                                        'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                        'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                        )) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane fade edit-password-tab" role="tabpanel" aria-labelledby="edit-password-tab">
                                <div class="attention"><span>To change your current password, please enter it below. Then type in your new password in the appropriate box. Next time you login, you’ll be able to use your new password.</span></div>
                                <h3 class="margin-bottom-1 text-left text-warning">
                                    {{ trans('profile.changePwTitle') }}
                                </h3>
                                {!! Form::model($user, array('action' => array('ProfilesController@updateUserPassword', $user->id), 'method' => 'PUT', 'autocomplete' => 'new-password')) !!}
                                <div class="pw-change-container margin-bottom-2">
                                    <div class="form-group has-feedback row {{ $errors->has('current_password') ? ' has-error ' : '' }}">
                                        <div class="col-md-4">
                                            {!! Form::label('current_password', trans('forms.create_user_label_pw_current')); !!}
                                            {!! Form::password('current_password', array('id' => 'current_password', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_current'))) !!}
                                            @if ($errors->has('current_password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                        <div class="col-md-4">
                                            {!! Form::label('password', trans('forms.create_user_label_password')); !!}
                                            {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'), 'autocomplete' => 'new-password')) !!}
                                            @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                                        <div class="col-md-4">
                                            {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation')); !!}
                                            {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                                            <span class="pass-text" id="pw_status"></span>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        {!! Form::button(
                                        '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitPWButton'),
                                        array(
                                        'class'             => 'btn btn-warning',
                                        'id'                => 'pw_save_trigger',
                                        'disabled'          => true,
                                        'type'              => 'button',
                                        'data-submit'       => trans('profile.submitButton'),
                                        'data-target'       => '#confirmForm',
                                        'data-modalClass'   => 'modal-warning',
                                        'data-toggle'       => 'modal',
                                        'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                        'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                        )) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane fade delete-account-tab" role="tabpanel" aria-labelledby="delete-account-tab">
                                <div class="attention"><span>Are you sure you want to delete your {{ config('app.name', Lang::get('titles.app')) }} account? Please be aware that once your account is deleted, all your data will be permanently removed from our system, and you will be unable to retrieve it.</span></div>
                                <h3 class="margin-bottom-1 text-center text-danger">
                                    {{ trans('profile.deleteAccountTitle') }}
                                </h3>
                                <p class="margin-bottom-2 text-center">
                                    <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
                                    <strong>Deleting</strong> your account is <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be undone.
                                    <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
                                </p>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 offset-sm-3 margin-bottom-3 text-center">
                                        {!! Form::model($user, array('action' => array('ProfilesController@deleteUserAccount', $user->id), 'method' => 'DELETE')) !!}
                                        <div class="btn-group btn-group-vertical margin-bottom-2 custom-checkbox-fa" data-toggle="buttons">
                                            <label class="btn no-shadow" for="checkConfirmDelete" >
                                            <input type="checkbox" name='checkConfirmDelete' id="checkConfirmDelete">
                                            <i class="fa fa-square-o fa-fw fa-2x"></i>
                                            <i class="fa fa-check-square-o fa-fw fa-2x"></i>
                                            <span class="margin-left-2"> Confirm Account Deletion</span>
                                            </label>
                                        </div>
                                        {!! Form::button(
                                        '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> ' . trans('profile.deleteAccountBtn'),
                                        array(
                                        'class'             => 'btn btn-block btn-danger',
                                        'id'                => 'delete_account_trigger',
                                        'disabled'          => true,
                                        'type'              => 'button',
                                        'data-toggle'       => 'modal',
                                        'data-submit'       => trans('profile.deleteAccountBtnConfirm'),
                                        'data-target'       => '#confirmForm',
                                        'data-modalClass'   => 'modal-danger',
                                        'data-title'        => trans('profile.deleteAccountConfirmTitle'),
                                        'data-message'      => trans('profile.deleteAccountConfirmMsg')
                                        )
                                        ) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p>{{ trans('profile.noProfileYet') }}</p>
            @endif
        </div>
    </div>
</div>
@include('modals.modal-form')
@endsection
@section('footer_scripts')
@include('scripts.form-modal-script')
@if(config('settings.googleMapsAPIStatus'))
@include('scripts.gmaps-address-lookup-api3')
@endif
@include('scripts.user-avatar-dz')
@include('scripts.date-input-script')
@include('scripts.form-script')
@endsection

