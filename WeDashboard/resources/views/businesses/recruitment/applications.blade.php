@extends('layouts.app')
@section('template_title')
{!! trans('businesses.showing-business', ['name' => $business->name]) !!}
@endsection
@section('content')
<section class="business-zone banner business-view">
    <div class="container">
        <div class="row content">
            <div class="col">
                <div class="business-info float-left">
                    <h4 id="business-name">{{ $business->name }} <small> @if ($business->isOwnerHere()) (Your business)  @endif </small></h4>
                    <div class="row">
                        <div class="col">
                            <star-rating :rating="{{ $business->getStarRating() }}" border-color="#192B50" :border-width="2" active-color="#CBB956" :star-size="20" :read-only="true" :increment="0.1"></star-rating> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span>Based on {{ $business->rating->count() }} {{ $business->rating->count() == 1 ? " review" : " reviews" }}</span>
                        </div>
                    </div>
                    @if ($business->isOwnerHere())
                    <div class="dropdown">
                        <button class="btn text-light dropdown-toggle other-options" data-toggle="dropdown" aria-expanded="true" type="button"><i class="fa fa-cog"></i> More actions</button>
                        <div role="menu" class="dropdown-menu" style="z-index: 19">
                            <a role="presentation" href="{{'/businesses/'.$business->id.'/edit'}}" class="dropdown-item">{{trans('titles.editBusiness')}}</a>
                            <a role="presentation" href="{{'/businesses/'.$business->id.'/logs'}}" class="dropdown-item">{{trans('titles.myBusinessLogs')}}</a>
                        </div>
                    </div>
                    @endif
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
                <div class="nav nav-tabs">
                   <a href="{{'/businesses/'.$business->id.'#overview'}}">Overview</a>
                   @if ($employee && $business->isOwnerHere())
                        <a href="{{'/businesses/'.$business->id.'#project'}}">Projects</a>
                    @else
                        @if ($employee)
                            @if ($employee->isEmployeeHere($business->id))
                                <a href="{{'/businesses/'.$business->id.'#project'}}">Projects</a>
                            @endif
                        @endif
                        @if ($business->isOwnerHere())
                            <a href="{{'/businesses/'.$business->id.'#project'}}">Projects</a>
                        @endif
                    @endif
                   <a href="{{ '/businesses/'.$business->id.'#employee '}}">Employees</a> 
                   <a href="{{ '/businesses/'.$business->id.'/applications' }}" class="active">Applications</a> 
                </div>
             </div>
          </div>
       </div>
    </div>
</section> 
<div style="position: absolute;right: 0;z-index: 19;">
    <a href="{{ url('businesses/'.$business->id) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('businesses.tooltips.back-businesses') }}">
    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
    {!! trans('businesses.buttons.back-to-business') !!}
    </a>
</div>
<section class="business-info-box mt-4 mb-4">
    <div class="container">
        <div class="card business-info-section">
            <div class="card-header">
                <h4 class="title m-0">{{ trans('Applications') }}</h4>
            </div>
            <div class="panel-body pb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        @if(count($applications) === 0)
                            <tr>
                                <p class="text-center margin-half">
                                    {!! trans('businesses.no-records') !!}
                                </p>
                            </tr>
                        @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>created_date</th>
                                    <th>answerer</th>
                                    <th>answer_date</th>
                                    <th>status</th>
                                    <th class="text-center">view</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications->sortByDesc('created_at') as $application)
                                <tr>
                                    @php $profile = $application->user->profile @endphp
                                    <td><a href="{{ url('/profile/'.$application->user->name) }}"><img src="@if ($profile->avatar_status == 1) {{ $profile->avatar }} @else {{ Gravatar::get($application->user->email) }} @endif" alt="{{$application->user->name }}" class="user-avatar-nav">{{ $application->user->last_name." ".$application->user->first_name}}</a></td>
                                    <td><span>{{ $application->created_at->format('d/m/Y H:i')}}</span></td>
                                    <td><a class="second" @if ($application->answerer) href=" {{ url('/profile/'.$application->answerer->name) }}" @endif>{{ ($application->answerer != null) ? $application->answerer->name : "No information available" }}</a></td>
                                    <td>{{ ($application->answer_date != null) ? $application->answer_date->format('d/m/Y H:i') : "No information available" }}</td>
                                    <td>
                                        @if ($application->status === null)
                                            Pending
                                        @elseif ($application->status === 1)
                                            <span class="text-success">Accepted</span>
                                        @elseif  ($application->status === 0)
                                            <span class="text-danger">Rejected</span>
                                        @endif
                                    </td>
                                    @if ($application->business->isOwnerHere() || $application->user->id == Auth::user()->id)
                                    <td class="text-center"><a href="{{ url('/application/'.$application->id) }}">View</a></td>
                                    @else 
                                    <td class="text-center"><i class="fa fa-warning"></i></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        </div>
                        <div class="text-center mt-4">
                            @if(config('usersmanagement.enablePagination'))
                                {{ $applications->links() }}
                                <p class="m-0">{{ 'Showing '.$applications->firstitem().' - '.$applications->lastitem().' of '.$applications->total().' results ('.$applications->perPage().' per page)'}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>
@endsection
