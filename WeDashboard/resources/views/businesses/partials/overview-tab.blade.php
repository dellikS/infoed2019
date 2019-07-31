<div id="overview" class="tab-pane fade active show">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 business-info-section">
                    <div class="header">
                        <h4 class="title">{{ trans('businesses.businessInfo') }}</h4>
                    </div>
                    <div class="business-info">
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.owner') }}</li>
                            <li class="info">{!! HTML::link('profile/'.$business->user->name, $business->user->name, array('target' => '_blank')) !!}</li>
                        </ul>
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.vacancies') }}</li>
                            <li class="info">{{ $business->employee->count()."/".$business->vacancies }}</li>
                        </ul>  
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.hiring') }}</li>
                            @if($business->hiring == false)
                                <li class="info text-danger"><i class="fa fa-lock"></i> No</li>
                            @else
                                <li class="info text-success"><i class="fa fa-unlock"></i> Yes</li>
                            @endif
                        </ul>     
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.setupdate') }}</li>
                            <li class="info">{{ $business->created_at->format('d/m/Y H:i:s') }}</li>
                        </ul>  
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.description') }}</li>
                            <li class="info">{{ $business->description }}</li>
                        </ul>               
                    </div>
                </div>
                <div class="col-md-6 business-info-section">
                    <div class="header">
                        <h4 class="title">{{ trans('businesses.projectOverview') }}  {{ $business->project ? " #".$business->project->id : "" }}</h4>
                    </div>
                    @if($business->project)
                        <div class="business-info project">
                            <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.type') }}</li>
                                <li class="info">{{ $business->type }}</li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="label">{{ trans('businesses.deadline') }}</li>
                                <li class="info">{{ $business->project->deadline->format('d/m/Y') }}</li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="label">{{ trans('businesses.title') }}</li>
                                <li class="info">{{ $business->project->title }}</li>
                            </ul>   
                            <ul class="list-unstyled">
                                <li class="label">{{ trans('businesses.description') }}</li>
                                <li class="info">{{ str_limit($business->project->details, $limit = 160, $end = "...") }}</li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="label">{{ trans('businesses.budget') }}</li>
                                <li class="info">{{ $business->project->budget.' '.$business->project->currency }}</li>
                            </ul>
                        </div>
                    @else
                        <div class="business-info">
                        No project available, come back soon!
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 business-info-section">
                    <div class="header">
                        <h4 class="title">{{ trans('businesses.contactInfo') }}</h4>
                    </div>
                    <div class="business-info">
                    @if($business->country_id)
                        <ul class="list-unstyled">
                            <li class="label">Country</li>
                            <li class="info">{{ $country->name }}</li>
                        </ul>
                    @endif
                    @if($business->address)
                        <ul class="list-unstyled">
                            <li class="label">Address</li>
                            <li class="info">{{ $business->address }}</li>
                        </ul>
                    @endif
                    <div class="row">
                    @if($business->email)
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="label">Email</li>
                            <li class="info">{{ $business->email }}</li>
                        </ul>
                    </div>
                    @endif
                    @if($business->website)
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="label">Website</li>
                            <li class="info"><a href="{{ 'https://'.$business->website }}">{{ $business->website }}</a></li>
                        </ul>
                    </div>
                    @endif
                    </div>
                    <div class="row">
                        @if($business->country_id)
                            @if($business->phone)
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="label">Phone</li>
                                    <li class="info">{{ '(+'.$country->phonecode.')'.$business->phone }}</li>
                                </ul>
                            </div>
                            @endif
                            @if($business->fax)
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="label">Fax</li>
                                    <li class="info">{{ '(+'.$country->phonecode.')'.$business->fax }}</li>
                                </ul>
                            </div>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 business-info-section">
                    <div class="header">
                        <h4 class="title">{{ trans('businesses.statisticsInfo') }}</h4>
                    </div>
                    <business-slots :employees='{{ $business->employee->count() }}' vacancies='{{ $business->vacancies }}'></business-slots>
                </div>
            </div>
        </div>
    </div>
</div>