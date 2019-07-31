@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->first_name }}
@endsection

@section('content')
@include('panels.welcome-panel')
<section class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statistics-box bg-gradient-primary">
                            <div class="p-2">
                                <h3 class="timer" data-refresh-interval="50" data-from="0" data-to="{{ $users->count() }}"></h3>
                                <p>Accounts</p>
                            </div>
                            <div class="icon"><i class="fa fa-users"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statistics-box bg-gradient-info">
                            <div class="p-2">
                                <h3 class="timer" data-refresh-interval="50" data-from="0" data-to="{{ $businesses->count() }}"></h3>
                                <p>Businesses</p>
                            </div>
                            <div class="icon"><i class="fa fa-building"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statistics-box bg-gradient-danger">
                            <div class="p-2">
                                <h3 class="timer" data-refresh-interval="50" data-from="0" data-to="4"></h3>
                                <p>Support Tickets</p>
                            </div>
                            <div class="icon"><i class="fa fa-ticket"></i></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statistics-box bg-gradient-success">
                            <div class="p-2">
                                <h3><users-count></users-count></h3>
                                <p>Online users</p>
                            </div>
                            <div class="icon"><i class="fa fa-users"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 mb-3">
                <div class="card bg-gradient-silver">
                    <div class="card-header border">
                        <div class="float-left">Top 5 Businesses</div>
                        <div class="float-right"><button class="btn p-0" type="button" data-toggle="collapse" data-target="#top5biz" aria-expanded="true" aria-controls="collapseExample"><i class="fa fa-minus"></i></button></div>
                    </div>
                    <div id="top5biz" class="panel-body collapse show">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th class="hidden-md hidden-sm hidden-xs">ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th class="hidden-xs">Hiring</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                @foreach ($latestBusinesses as $business)
                                    <tr>
                                        <td class="hidden-md hidden-sm hidden-xs">{{ $business->id }}</td>
                                    <td><a class="third" href="{{ url('businesses/'.$business->id) }}">{{ $business->name }}</a></td>
                                        <td>{{ $business->type }}</td>
                                        @if ($business->hiring == true)  
                                        <td class="hidden-xs text-success"><i class="fa fa-unlock"></i> Yes</td>
                                        @else
                                        <td class="hidden-xs text-danger"><i class="fa fa-lock"></i> No</td>
                                       @endif
                                        <td>
                                            <star-rating :inline="true" :show-rating="false" :rating="{{ $business->getStarRating() }}" :star-size="16" :read-only="true" :increment="0.1"></star-rating>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-3">
                <div class="card bg-gradient-silver-r">
                    <div class="card-header border">
                        <div class="float-left">Last 5 employees</div>
                        <div class="float-right"><button class="btn p-0" type="button" data-toggle="collapse" data-target="#top5employees" aria-expanded="true" aria-controls="collapseExample"><i class="fa fa-minus"></i></button></div>
                    </div>
                    <div id="top5employees" class="panel-body collapse show">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Business</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td><a class="second" href="{{ url('profile/'.$employee->user->name) }}">{{ $employee->user->first_name." ".$employee->user->last_name }}</a></td>
                                        <td><a class="third" href="{{ url('businesses/'.$employee->business->id) }}">{{ $employee->business->name }}</a></td>
                                        <td>
                                            <span>{{$employee->created_at->diffForHumans()}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        $('.timer').countTo();
    </script>
@endsection