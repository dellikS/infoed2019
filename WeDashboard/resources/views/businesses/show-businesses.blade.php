@extends('layouts.app')

@section('template_title')
    {!! trans('businesses.showing-all-businesses') !!}
@endsection

@section('template_linked_css')
    @if(config('businesses.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('businesses.datatablesCssCDN') }}">
    @endif
@endsection

@section('content')
    <section class="business-zone banner business-view">
        <div class="container content">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">{!! trans('businesses.showing-all-businesses') !!}</h4>
                </div>
            </div>
            @if (!Auth::user()->business)
            <div class="row mb-4">
                <div class="col">
                    <a class="btn btn-primary h-auto" href="{{ url('businesses/create') }}">
                        {!! trans('businesses.buttons.create-new') !!}
                    </a>
                </div>
            </div>
            @endif
        </div>
    </section>
    <div class="container mt-n5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                @if(config('businesses.enableSearchBusinesses'))
                                    @include('partials.search-businesses-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <caption>
                        <span class="text-secondary" id="business_count">{{ trans_choice('businesses.table.caption', 1, ['businessescount' => $businesses->count()]) }}</span>
                    </caption>
                </div>
                <div id="businesses_panel">
                    @foreach($businesses as $business)
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5><a href="{{ url('businesses/' . $business->id) }}"  class="text-uppercase font-weight-bold {{ ($business->isOwnerHere()) ? "text-info" : "third" }} {{ $employee ? $employee->isEmployeeHere($business->id) ? "text-success" : "" : "third" }}" data-toggle="tooltip" title="Details">{{$business->name}}</a></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold text-secondary">{{$business->type}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <star-rating :inline="true" :show-rating="false" :rating="{{ $business->getStarRating() }}" :star-size="18" :read-only="true" :increment="0.1"></star-rating>
                                    <span class="hidden-xs hidden-sm">({{ $business->rating->count() }} {{ $business->rating->count() == 1 ? " review" : " reviews" }})</span>
                                </div>
                            </div>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <p class="text-secondary">{{ $business->description }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <div class="float-left">
                                        <span class="text-secondary">{!! trans('businesses.table.owner') !!}: </span><a class="second" href="{{ url('profile/' . $business->user->name) }}" data-toggle="tooltip" title="View profile">{{$business->user->name}}</a>
                                    </div>
                                    <div class="clear-fix"></div>
                                    <div class="float-right">
                                    @if ($business->hiring == true && !Auth::user()->employee && $business->survey)  
                                        <a class="btn btn-sm btn-light btn-block" href="{{ url('businesses/'.$business->id.'/apply') }}" data-toggle="tooltip" title="Make an application">
                                            {!! trans('businesses.buttons.apply') !!}
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-light" disabled="disabled" data-toggle="tooltip" title="{{ ($business->survey==null) ? "This business has no application model set!" : "" }} {{ ($business->hiring == false) ? "Application Closed!\n" : ((Auth::user()->employee) ? "You are already employed!" : "")}}">
                                            You cannot apply here!
                                        </button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if(config('businesses.enableSearchBusinesses'))
                    <div id="search_results"></div>
                @endif
                <div class="text-center mt-3">
                    @if(config('businesses.enablePagination'))
                        {{ $businesses->links() }}
                        <p>{{ 'Showing '.$businesses->firstitem().' - '.$businesses->lastitem().' of '.$businesses->total().' results ('.$businesses->perPage().' per page)'}}</p>
                    @endif
                </div>
                @php /*<div class="d-none">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table data-table">
                                <caption class="ml-3">
                                    {{ trans_choice('businesses.table.caption', 1, ['businessescount' => $businesses->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('businesses.table.id') !!}</th>
                                        <th>{!! trans('businesses.table.company-name') !!}</th>
                                        <th class="hidden-xs">{!! trans('businesses.table.owner') !!}</th>
                                        <th>{!! trans('businesses.table.type') !!}</th>
                                        <th class="hidden-xs">{!! trans('businesses.table.vacancies') !!}</th>
                                        <th>{!! trans('businesses.table.hiring') !!}</th>
                                        <th class="hidden-md hidden-sm hidden-xs">{!! trans('businesses.table.email') !!}</th>
                                        <th class="hidden-xs">{!! trans('Rating') !!}</th>
                                        <th>{!! trans('businesses.table.application') !!}</th>
                                    </tr>
                                </thead>
                                <tbody id="businesses_table" class="businesses_table">
                                    @foreach($businesses as $business)
                                        <tr>
                                            <td>{{$business->id}}</td>
                                        <td><a href="{{ url('businesses/' . $business->id) }}"  class="{{ ($business->isOwnerHere()) ? "text-info" : "third" }} {{ $employee ? $employee->isEmployeeHere($business->id) ? "text-success" : "" : "third" }}" data-toggle="tooltip" title="Details">{{$business->name}}</a></td>
                                            <td class="hidden-xs"><a class="second" href="{{ url('profile/' . $business->user->name) }}" data-toggle="tooltip" title="View profile">{{$business->user->name}}</a></td>
                                            <td>{{ $business->type }}</td>
                                            <td class="hidden-xs">{{ $business->employee->count()."/". $business->vacancies}}</td>
                                            @if ($business->hiring == true)  
                                            <td class="text-success"><i class="fa fa-unlock"></i> Yes</td>
                                            @else
                                            <td class="text-danger"><i class="fa fa-lock"></i> No</td>
                                            @endif
                                            <td class="hidden-md hidden-sm hidden-xs">{{$business->email}}</td>  
                                            <td class="hidden-xs">
                                                <star-rating :inline="true" :show-rating="false" :rating="{{ $business->getStarRating() }}" :star-size="14" :read-only="true" :increment="0.1"></star-rating>
                                                <span class="hidden-xs hidden-sm">({{ $business->rating->count() }} {{ $business->rating->count() == 1 ? " review" : " reviews" }})</span>
                                            </td>
                                            @if ($business->hiring == true && !Auth::user()->employee && $business->survey)  
                                                <td>
                                                    <a class="btn btn-sm btn-light btn-block" href="{{ url('businesses/'.$business->id.'/apply') }}" data-toggle="tooltip" title="Make an application">
                                                        {!! trans('businesses.buttons.apply') !!}
                                                    </a>
                                                </td>
                                            @else
                                            <td class="text-center" data-toggle="tooltip" title="{{ ($business->survey==null) ? "This business has no application model set!" : "" }} {{ ($business->hiring == false) ? "Application Closed!\n" : ((Auth::user()->employee) ? "You are already employed!" : "")}}">
                                                You cannot apply here!
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--<tbody id="search_results"></tbody>-->
                                @if(config('businesses.enableSearchBusinesses'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>
                            <div class="text-center">
                                @if(config('businesses.enablePagination'))
                                    {{ $businesses->links() }}
                                    <p>{{ 'Showing '.$businesses->firstitem().' - '.$businesses->lastitem().' of '.$businesses->total().' results ('.$businesses->perPage().' per page)'}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>*/
                @endphp
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('businesses.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('businesses.enableSearchBusinesses'))
        @include('scripts.search-businesses')
    @endif
@endsection
