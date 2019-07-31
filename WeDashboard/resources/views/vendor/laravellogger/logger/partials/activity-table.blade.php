@php

$drilldownStatus = config('LaravelLogger.enableDrillDown');
$prependUrl = '/activity/log/';

if (isset($hoverable) && $hoverable === true) {
    $hoverable = true;
} else {
    $hoverable = false;
}

if (Request::is('activity/cleared')) {
    $prependUrl = '/activity/cleared/log/';
}

@endphp

<div class="table-responsive activity-table">
    <table class="table table-striped  table-condensed data-table">
        <thead>
            <tr>
                <th>
                    <i class="fa fa-database fa-fw" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">
                        {!! trans('LaravelLogger::laravel-logger.dashboard.labels.id') !!}
                    </span>
                </th>
                <th>
                    <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.time') !!}
                </th>
                <th>
                    <i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.description') !!}
                </th>
                <th>
                    <i class="fa fa-user-o fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.user') !!}
                </th>
                <th>
                    <i class="fa fa-truck fa-fw" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">
                        {!! trans('LaravelLogger::laravel-logger.dashboard.labels.method') !!}
                    </span>
                </th>
                <th>
                    <i class="fa fa-map-o fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.route') !!}
                </th>
                <th>
                    <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.ipAddress') !!}
                </th>
                <th>
                    <i class="fa fa-laptop fa-fw" aria-hidden="true"></i>
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.agent') !!}
                </th>
                @if(Request::is('activity/cleared'))
                    <th>
                        <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                        {!! trans('LaravelLogger::laravel-logger.dashboard.labels.deleteDate') !!}
                    </th>
                @endif
                <th>
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    {!! trans('Details') !!}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr >
                    <td>
                        <small>
                            {{ $activity->id }}
                        </small>
                    </td>
                    <td>
                        {{ $activity->timePassed }}
                    </td>
                    <td>
                        {{ $activity->description }}
                    </td>
                    <td>
                        @php
                            switch ($activity->userType) {
                                case trans('LaravelLogger::laravel-logger.userTypes.registered'):
                                    $userTypeClass = 'info';
                                    $userType = 'Registered';
                                    $userLabel = $activity->userDetails['name'];
                                    break;

                                case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
                                    $userTypeClass = 'danger';
                                    $userType = 'Crawler';
                                    $userLabel = $activity->userType;
                                    break;

                                case trans('LaravelLogger::laravel-logger.userTypes.guest'):
                                default:
                                    $userTypeClass = 'dark';
                                    $userType = 'Guest';
                                    $userLabel = $activity->userType;
                                    break;
                            }

                        @endphp
                        @if ($activity->userType == trans('LaravelLogger::laravel-logger.userTypes.registered'))
                        <a href="{{ url('profile/'.$userLabel)}}">
                            <span class="text-{{$userTypeClass}}">
                                {{$userLabel}} <small>({{$userType}})</small>
                            </span>
                        </a>
                        @else
                        <span class="text-{{$userTypeClass}}">
                            {{$userType}}</small>
                        </span>
                        @endif
                    </td>
                    <td>
                        @php
                            switch (strtolower($activity->methodType)) {
                                case 'get':
                                    $methodClass = 'info';
                                    break;

                                case 'post':
                                    $methodClass = 'warning';
                                    break;

                                case 'put':
                                    $methodClass = 'warning';
                                    break;

                                case 'delete':
                                    $methodClass = 'danger';
                                    break;

                                default:
                                    $methodClass = 'info';
                                    break;
                            }
                        @endphp
                        <span class="badge badge-{{ $methodClass }}">
                            {{ $activity->methodType }}
                        </span>
                    </td>
                    <td class="ellipsis">
                        @if($hoverable)
                            {{ showCleanRoutUrl($activity->route) }}
                        @else
                            <a href="{{ $activity->route }}">
                                {{$activity->route}}
                            </a>
                        @endif
                    </td>
                    <td>
                        {{ $activity->ipAddress }}
                    </td>
                    <td>
                        @php
                            $platform       = $activity->userAgentDetails['platform'];
                            $browser        = $activity->userAgentDetails['browser'];
                            $browserVersion = $activity->userAgentDetails['version'];

                            switch ($platform) {

                                case 'Windows':
                                    $platformIcon = 'fa-windows';
                                    break;

                                case 'iPad':
                                    $platformIcon = 'fa-';
                                    break;

                                case 'iPhone':
                                    $platformIcon = 'fa-';
                                    break;

                                case 'Macintosh':
                                    $platformIcon = 'fa-apple';
                                    break;

                                case 'Android':
                                    $platformIcon = 'fa-android';
                                    break;

                                case 'BlackBerry':
                                    $platformIcon = 'fa-';
                                    break;

                                case 'Unix':
                                case 'Linux':
                                    $platformIcon = 'fa-linux';
                                    break;

                                default:
                                    $platformIcon = 'fa-';
                                    break;
                            }

                            switch ($browser) {

                                case 'Chrome':
                                    $browserIcon  = 'fa-chrome';
                                    break;

                                case 'Firefox':
                                    $browserIcon  = 'fa-firefox';
                                    break;

                                case 'Opera':
                                    $browserIcon  = 'fa-opera';
                                    break;

                                case 'Safari':
                                    $browserIcon  = 'fa-safari';
                                    break;

                                case 'Internet Explorer':
                                    $browserIcon  = 'fa-edge';
                                    break;

                                default:
                                    $browserIcon  = 'fa-';
                                    break;
                            }
                        @endphp
                        <i class="fa {{ $browserIcon }} fa-fw" aria-hidden="true">
                            <span class="sr-only">
                                {{ $browser }}
                            </span>
                        </i>
                        <sup>
                            <small>
                                {{ $browserVersion }}
                            </small>
                        </sup>
                        <i class="fa {{ $platformIcon }} fa-fw" aria-hidden="true">
                            <span class="sr-only">
                                {{ $platform }}
                            </span>
                        </i>
                        <sup>
                            <small>
                                {{ $activity->langDetails }}
                            </small>
                        </sup>
                    </td>
                    @if(Request::is('activity/cleared'))
                        <td>
                            {{ $activity->deleted_at }}
                        </td>
                    @endif
                    <td>
                        <a href="{{$prependUrl . $activity->id}}">View log</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if(config('LaravelLogger.loggerPaginationEnabled'))
    <div class="text-center">
        <div>
            {!! $activities->render() !!}
        </div>
        <p>
            {!! trans('LaravelLogger::laravel-logger.pagination.countText', ['firstItem' => $activities->firstItem(), 'lastItem' => $activities->lastItem(), 'total' => $activities->total(), 'perPage' => $activities->perPage()]) !!}
        </p>
    </div>
@endif
