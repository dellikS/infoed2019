<div id="employee" class="tab-pane fade">
    <div class="card business-info-section">
        <div class="card-header">
            <h4 class="title m-0">{{ trans('businesses.employeesInfo') }}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    @if(count($business->employee) === 0)
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
                                <th>job_title</th>
                                <th>responsability</th>
                                <th>joined</th>
                                @if ($business->isOwnerHere())
                                    @if ($business->project)
                                        <th>salary</td>
                                    @endif
                                <th><i class="fa fa-cog"></i></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($business->employee->sortBy('created_at') as $employee)
                            <tr>
                                @php $profile = $employee->user->profile @endphp
                                <td><a href="{{ url('/profile/'.$employee->user->name) }}"><img src="@if ($profile->avatar_status == 1) {{ $profile->avatar }} @else {{ Gravatar::get($employee->user->email) }} @endif" alt="{{$employee->user->name }}" class="user-avatar-nav">{{ $employee->user->last_name." ".$employee->user->first_name}}</a></td>
                                
                                <td><span class="badge-job bg-gradient-silver text-dark">{{ $employee->job_title ? $employee->job_title : "No information available"}}</span></td>
                                <td>{{ $employee->responsability ? $employee->responsability : "No information available" }}</td>
                                <td>{{ $employee->created_at->diffForHumans() }}</td>
                                @if ($business->isOwnerHere())
                                    @if ($business->project)
                                        <td><span class="text-success">{{ $employee->salary ? $employee->salary." ".$business->project->currency : 'Not set yet' }}</span></td>
                                    @endif
                                    <td>
                                        {!! Form::model($employee, array('action' => array('EmployeesController@update', $employee->id), 'method' => 'PUT')) !!}
                                            {{ csrf_field() }}
                                            {!! Form::button(
                                                '<i class="fa fa-edit" aria-hidden="true"></i> ',
                                                array(
                                                'class'             => 'btn p-0',
                                                'id'                => 'edit_employee_trigger',
                                                'disabled'          =>  false,
                                                'type'              => 'button',
                                                'data-employee'     => $employee->id,
                                                'data-toggle'       => 'modal',
                                                'data-target'       => '#editEmployee',
                                                'data-title'        => 'Edit '.$employee->user->last_name.' details',
                                                'data-job_title'    => $employee->job_title ? $employee->job_title : '',
                                                'data-responsability'=> $employee->responsability ? $employee->responsability : '',
                                                'data-budget'        => $business->project ? $business->project->budget : '',
                                                'data-salary'       => $employee->salary ? $employee->salary : '',
                                                'data-currency'     => $business->project ? $business->project->currency : '',
                                                )
                                                ) !!}
                                        {!! Form::close() !!}       
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    </div>
                    <div class="p-2">
                        <caption id="user_count">
                                {{ trans_choice('businesses.caption', 1, ['employeescount' => $business->employee->count()]) }}
                        </caption>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>