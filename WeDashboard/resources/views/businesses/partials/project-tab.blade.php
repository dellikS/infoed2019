<div id="project" class="tab-pane fade">
@if ($business->project)
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7 business-info-section">
                    <div class="header">
                        <h4 class="title">{{ trans('businesses.projectInfo') }}</h4>
                    </div>
                    <div class="business-info">
                        <ul class="list-unstyled">
                            <li class="label">Project ID</li>
                            <li class="info">{{ "#".$business->project->id }}</li>
                        </ul>
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.title') }}</li>
                            <li class="info">{{ $business->project->title }}</li>
                        </ul>
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.type') }}</li>
                            <li class="info">{{ $business->type }}</li>
                        </ul>                                    
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.description') }}</li>
                            <li class="info">{{ $business->project->details }}</li>
                        </ul>
                            <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.instruction') }}</li>
                            <li class="info">{!! $business->project->instruction !!}</li>
                        </ul>
                        <ul class="list-unstyled">
                            <li class="label">{{ trans('businesses.deadline') }}</li>
                            <li class="info">{{ $business->project->deadline->format('d/m/Y') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 business-info-section">
                    <div class="row">
                        <div class="col">
                            <div class="header">
                                <h4 class="title">Other Details</h4>
                            </div>
                            <div class="business-info">
                                <ul class="list-unstyled">
                                    <li class="label">Project status</li>
                                    <li class="info">{!! $business->project->status == true ? '<span class="text-success">ACTIVE</span>' : '<span class="text-warning">SUSPENDED</span>' !!}</li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li class="label">{{ trans('businesses.budget') }}</li>
                                    <li class="info text-success">{{ $business->project->budget." ".$business->project->currency }}</li>
                                </ul>
                                @if ($business->isOwnerHere())
                                @php
                                    $budgetCosts = 0;
                                    foreach ($business->employee as $employee) {
                                        $budgetCosts = $budgetCosts + $employee->salary;
                                    }

                                    $difference = $business->project->budget - $budgetCosts;
                                @endphp
                                <ul class="list-unstyled">
                                    <li class="label">Current salary costs</li>
                                    <li class="info {{ $budgetCosts > $business->project->budget ? "text-danger" : "text-success" }}">{{ $budgetCosts." ".$business->project->currency }} {{ $budgetCosts > $business->project->budget ? "(".$difference." ".$business->project->currency." )" : "" }}</li>
                                </ul>
                                @endif
                                <ul class="list-unstyled">
                                    <li class="label">Created at</li>
                                    <li class="info">{{ $business->project->created_at->format('d/m/Y H:i') }}</li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li class="label">Updated at</li>
                                    <li class="info">{{ $business->project->updated_at->format('d/m/Y H:i') }}</li>
                                </ul>                                    
                            </div>
                        </div>
                    </div>
                    @if ($business->isOwnerHere())
                    <div class="row mt-5">
                        <div class="col">
                            <div class="header">
                                <h4 class="title">Statistics</h4>
                            </div>
                            <div class="business-info">
                                <business-profit :profit='{{ $business->project->budget }}' :expense='{{ $budgetCosts }}'></business-profit>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@if(count($deletedProjects) !== 0)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12  business-info-section">
                    <div class="header">
                        <h4 class="title">Old projects</h4>
                    </div>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>title</th>
                                <th>budget</th>
                                <th>deleted_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deletedProjects->sortByDesc('deleted_at') as $deletedProject)
                            <tr>
                                <td>{{ $deletedProject->id }}</td>
                                <td>{{ $deletedProject->title }}</td>
                                <td class="text-success">{{ $deletedProject->budget." ".$deletedProject->currency }}</td>
                                <td>{{ $deletedProject->deleted_at->format("d/m/Y H:i") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
</div>