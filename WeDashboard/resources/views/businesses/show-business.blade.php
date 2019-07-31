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
                    @else
                        <button type="button" id="rateLabel" class="other-options btn" style="color: #cbb956" data-toggle="modal" data-target="#rate"><i class="fa fa-star"></i> Rate this business!</button>
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
                   <a data-toggle="tab" href="#overview" class="active">Overview</a>
                   @if ($employee && $business->isOwnerHere())
                        <a data-toggle="tab" href="#project">Projects</a>
                    @else
                        @if ($employee)
                            @if ($employee->isEmployeeHere($business->id))
                                <a data-toggle="tab" href="#project">Projects</a>
                            @endif
                        @endif
                        @if ($business->isOwnerHere())
                            <a data-toggle="tab" href="#project">Projects</a>
                        @endif
                    @endif
                   <a data-toggle="tab" href="#employee">Employees</a> 
                   <a href="{{ '/businesses/'.$business->id.'/applications' }}">Applications</a> 
                </div>
             </div>
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
<section class="business-info-box mt-4 mb-4">
    <div class="container">
        @if ($business->motd)
            @if ($employee && $business->isOwnerHere())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="attention clearfix"><span class="float-left">{{ 'MOTD: '.$business->motd }}</span><span class="float-right text-warning">{{ 'Last updated: '.$business->updated_at->format('d/m/Y H:i') }}</span></div>
                    </div>
                </div>
            @else
                @if ($employee)
                    @if ($employee->isEmployeeHere($business->id))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="attention clearfix"><span class="float-left">{{ 'MOTD: '.$business->motd }}</span><span class="float-right text-warning">{{ 'Last updated: '.$business->updated_at->format('d/m/Y H:i') }}</span></div>
                        </div>
                    </div>
                    @endif
                @endif
                @if ($business->isOwnerHere())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="attention clearfix"><span class="float-left">{{ 'MOTD: '.$business->motd }}</span><span class="float-right text-warning">{{ 'Last updated: '.$business->updated_at->format('d/m/Y H:i') }}</span></div>
                    </div>
                </div>
                @endif
            @endif
        @endif	
        <div class="tab-content">
            @include('businesses.partials.overview-tab')
            @include('businesses.partials.employee-tab')
            <!-- ANTI BUG -->
            @if ($employee && $business->isOwnerHere())
                    @include('businesses.partials.project-tab')
                @else
                @if ($employee)
                    @if ($employee->isEmployeeHere($business->id))
                        @include('businesses.partials.project-tab')
                    @endif
                @endif
                @if ($business->isOwnerHere())
                    @include('businesses.partials.project-tab')
                @endif
            @endif
        </div>
    </div>
</section>
@if (Auth::user()->id != $business->user_id)
    @include('modals.modal-business-rate')
@endif
@if ($business->isOwnerHere())
    @include('modals.modal-edit')
@endif

@endsection

@section('footer_scripts')
    @include('scripts.business-tabs-script')
    @include('scripts.edit-modal-script')
    @include('scripts.form-script')
@endsection