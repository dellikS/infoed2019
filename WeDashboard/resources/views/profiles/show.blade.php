@extends('layouts.app')

@section('template_title')
@if ($user->profile)
	@if (Auth::user()->id != $user->id)
	{{ $user->name }}'s Profile
	@else 
	My Profile
	@endif
@endif
@endsection

@section('content')
	<section class="profile-zone banner profile-view">
		<div class="container">
			<div class="row content">
				<div class="col">
					<div class="profile-picture float-left">
					@if ($user->profile)
						<img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}">
					@else 
					<img src="{{ Gravatar::get($user->email) }}" alt="{{ $user->name }}">
					@endif
					</div>
					<div class="profile-info float-left">
						@foreach ($user->roles as $user_role)
							@if ($user_role->name == 'Admin')
								@php $iconClass = 'shield' @endphp
							@else
								@php $iconClass = 'default' @endphp
							@endif
						@endforeach
					<h4 id="user-name">{{ $user->name }}<i data-toggle="tooltip" title="{{ $user_role->name }} - Level {{ $user_role->level }}" class="fa fa-{{$iconClass}}"></i></h4>
						<span>{{ $user->email }}</span>
						@if ($user->profile)
							@if (Auth::user()->id == $user->id)
								<div class="dropdown">
										<button class="btn text-light dropdown-toggle other-options" data-toggle="dropdown" aria-expanded="true" type="button"><i class="fa fa-cog"></i> More actions</button>
									<div role="menu" class="dropdown-menu" style="z-index: 19">
										<a role="presentation" href="{{'/profile/'.Auth::user()->name.'/edit'}}" class="dropdown-item">{{trans('titles.editProfile')}}</a>
										<a role="presentation" href="{{'/profile/'.Auth::user()->name.'/logs'}}" class="dropdown-item">{{trans('titles.myUserLogs')}}</a>
									</div>
								</div>
							@else
								@role('admin')
								<div class="dropdown">
										<button class="btn text-light dropdown-toggle other-options" data-toggle="dropdown" aria-expanded="true" type="button"><i class="fa fa-cog"></i> More actions</button>
									<div role="menu" class="dropdown-menu" style="z-index: 19">
										<a role="presentation" href="{{'/users/'.$user->id}}" class="dropdown-item">{{trans('titles.userInformation')}}</a>
										<a role="presentation" href="{{'/users/'.$user->id}}/edit" class="dropdown-item">{{ trans('usersmanagement.editUser') }}</a>
                     					<a role="presentation" href="{{'/profile/'.$user->name.'/logs'}}" class="dropdown-item">{{trans('usersmanagement.userLogs')}}</a>
									</div>
								</div>
								@endrole
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
	@role('admin')
	<div style="position: absolute;right: 0;z-index: 19;">
		<a href="{{ url('/users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-dashboard') }}">
		<i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
		{!! trans('usersmanagement.buttons.back-to-users') !!}
		</a>
	</div>
	@else
	<div style="position: absolute;right: 0;z-index: 19;">
		<a href="{{ url('/home') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-dashboard') }}">
		<i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
		{!! trans('usersmanagement.buttons.back-to-dashboard') !!}
		</a>
	</div>
	@endrole
	<section class="user-info-box mt-n4">
		<div class="container">
			<div class="card">		
				<div class="card-body">
					@if ($user->profile)
					<div class="row">
						<div class="col-md-6 user-info-section">
							<div class="header">
								<h4 class="title">personal iNFORMATION</h4>
							</div>
							<div class="profile-info">
								<ul class="list-unstyled">
									<li class="label">{{ trans('profile.showProfileLastName') }}</li>
									<li class="info">{{ $user->last_name }}</li>
								</ul>
								<ul class="list-unstyled">
									<li class="label">{{ trans('profile.showProfileFirstName') }}</li>
									<li class="info">{{ $user->first_name }}</li>
								</ul>
								@if ($user->profile->country_id)
									@if ($user->phone)
									<ul class="list-unstyled">
										<li class="label">{{ trans('profile.showProfilePhone') }}</li>
										<li class="info">{{ "(+".$country->phonecode.")".$user->phone }}</li>
									</ul>
									@endif
								@endif
								@if ($user->email)
								<ul class="list-unstyled">
									<li class="label">{{ trans('profile.showProfileEmail') }}</li>
									<li class="info">{{ $user->email }}</li>
								</ul>
								@endif
								@if ($user->profile->birth_date)
									<ul class="list-unstyled">
										<li class="label">{{ trans('profile.showProfileBirthDate') }}</li>
										<li class="info">{{ $birthdate." (". $age." ".trans('profile.showProfileAge') }})</li>
									</ul>
								@endif
								@if ($user->profile->bio)
								<ul class="list-unstyled">
									<li class="label">{{ trans('profile.showProfileBio') }}</li>
									<li class="info">{{ $user->profile->bio }}</li>
								</ul>
								@endif
								@if ($user->created_at)
								<ul class="list-unstyled">
									<li class="label">{{ trans('profile.showProfileJoinDate') }}</li>
									<li class="info">{{ $user->created_at->format('d/m/Y H:i:s') }}</li>
								</ul>
								@endif
							</div>
						</div>
						@if ($user->business || $user->employee)
						<div class="col-md-6 user-info-section">
							<div class="header">
								<h4 class="title">Professional Information</h4>
							</div>
							<div class="profile-info">
								@if ($user->business) 
									<ul class="list-unstyled">
										<li class="label">Owned Business</li>
										<li class="info">{!! HTML::link('businesses/'.$user->business->id, $user->business->name, array('target' => '_blank')) !!}</li>
									</ul>
									@if ($user->employee)
										<ul class="list-unstyled">
											<li class="label">Employer</li>
										<li class="info"><a href="{{ url('/businesses/'.$employer->id) }}">{{ $employer->name }}</a></li>
										</ul>
										@if ($user->employee->job_title)
										<ul class="list-unstyled">
											<li class="label">Job Title</li>
											<li class="info">{{ $user->employee->job_title }}</li>
										</ul>
										@endif
										@if ($employer->project)
										<ul class="list-unstyled">
											<li class="label">Project</li>
											<li class="info">{{ $employer->project->title }}</li>
										</ul>
										@endif
										@if ($user->employee->responsability)
										<ul class="list-unstyled">
											<li class="label">Responsabilities</li>
											<li class="info">{{ $user->employee->responsability}}</li>
										</ul>
										@endif
										@if (Auth::user()->id == $user->id)
											@if ($employer->project->budget && $user->employee->salary)
											<ul class="list-unstyled">
												<li class="label">Salary</li>
												<li class="info">{{ $user->employee->salary." ".$employer->project->currency }}</li>
											</ul>
											@endif
										@endif
									@endif
								@elseif ($user->employee)
									<ul class="list-unstyled">
										<li class="label">Employer</li>
									<li class="info"><a href="{{ url('/businesses/'.$employer->id) }}">{{ $employer->name }}</a></li>
									</ul>
									@if ($user->employee->job_title)
									<ul class="list-unstyled">
										<li class="label">Job Title</li>
										<li class="info">{{ $user->employee->job_title }}</li>
									</ul>
									@endif
									@if ($employer->project)
									<ul class="list-unstyled">
										<li class="label">Project</li>
										<li class="info">{{ $employer->project->title }}</li>
									</ul>
									@endif
									@if ($user->employee->responsability)
									<ul class="list-unstyled">
										<li class="label">Responsabilities</li>
										<li class="info">{{ $user->employee->responsability}}</li>
									</ul>
									@endif
									@if (Auth::user()->id == $user->id)
										@if ($employer->project->budget && $user->employee->salary)
										<ul class="list-unstyled">
											<li class="label">Salary</li>
											<li class="info">{{ $user->employee->salary." ".$employer->project->currency }}</li>
										</ul>
										@endif
									@endif
								@endif
								@if ($user->profile->github_username)
								<ul class="list-unstyled">
									<li class="label"><i class="fa fa-github"></i> {{ trans('profile.showProfileGitHubUsername') }}</li>
									<li class="info">{!! HTML::link('https://github.com/'.$user->profile->github_username, $user->profile->github_username, array('target' => '_blank')) !!}</li>
								</ul>
								@endif
							</div>
						</div>
						@endif
					</div>
					<div class="row">
						@if ($user->profile->country_id || $user->profile->address)
						<div class="col-md-6 user-info-section">
							<div class="header">
								<h4 class="title">Location</h4>
							</div>
							<div class="profile-info">
								@if ($user->profile->country_id)
								<ul class="list-unstyled">
									<li class="label">Country</li>
									<li class="info">{{ $country->name }}</li>
								</ul>
								@endif
								@if ($user->profile->address)
								<ul class="list-unstyled">
									<li class="label">Address</li>
									<li class="info">{{ $user->profile->address }}</li>
								</ul>
								@endif
							</div>
						</div>
						@endif
					</div>
					@else
					<div class="row">
						<div class="col-md-6 user-info-section">
							<h4 class="title">{{ trans('profile.noProfileYet') }}</h4>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection

@section('footer_scripts')
	@if(config('settings.googleMapsAPIStatus'))
		@include('scripts.google-maps-geocode-and-map')
	@endif
	@include('scripts.tooltips')
@endsection
