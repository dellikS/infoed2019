<!--<nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img width="80px" src="{{asset('assets/svg/webill.svg')}}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto">
                @role('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {!! trans('titles.adminDropdownNav') !!}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/users') }}">
                                {!! trans('titles.adminUserList') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('users/create') ? 'active' : null }}" href="{{ url('/users/create') }}">
                                {!! trans('titles.adminNewUser') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                                {!! trans('titles.adminLogs') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}">
                                {!! trans('titles.adminActivity') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('phpinfo') ? 'active' : null }}" href="{{ url('/phpinfo') }}">
                                {!! trans('titles.adminPHP') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('routes') ? 'active' : null }}" href="{{ url('/routes') }}">
                                {!! trans('titles.adminRoutes') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                @endrole
            </ul>
            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto">
                {{-- Authentication Links --}}
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ trans('titles.login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ trans('titles.register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}">
                                {!! trans('titles.profile') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>-->
<nav class="dashboard-nav">
    <div class="row margin-0">
        @auth
        @if (Auth::user()->activated == true)
        <div id="is-auth">
            <div id="toggle-nav col-auto" class="toggle-nav">
                <button type="button" id="sidebar-collapse" class="hamburger hamburger--3dx">
                    <div class="hamburger-box">
                      <div class="hamburger-inner"></div>
                    </div>
                </button>
            </div>
        </div>
        @endif
        @endauth
        <div @auth @if (Auth::user()->activated == true) id="is-auth" @else id="is-guest" @endif @else id="is-guest"  @endauth  class="logo-part navbar-brand">
            <a href="{{ url('/') }}">
                <img src="{{asset('assets/svg/webill.svg')}}" class="logo">
            </a>
        </div>
        <div class="user-zone" style="color:#fff">
            @auth
            <div id="is-auth">
                <div id="user-options" class="navbar-item">
                    <div class="user-name-container">
                        <div class="user-name">
                            <span>{{ Auth::user()->name }}</span>    
                        </div>
                    </div>	
                    <div class="navbar-item">
                        <div class="content">
                            <img class="user-avatar-nav" src="@if (Auth::user()->profile->avatar_status == 1) {{ Auth::user()->profile->avatar }} @else {{ Gravatar::get(Auth::user()->email) }} @endif" alt="{{ Auth::user()->name }}">
                        </div>
                    </div>		
                </div>	
                <div id="notification-toggle" class="navbar-item">
                    <div class="content">
                        <i class="fa fa-bell-o"></i>
                    </div>
                    @if (Auth::User()->unReadNotifications->count() > 0)
                    <div id="notifications-counter" class="circle">{{ Auth::User()->unReadNotifications->count() }}</div>
                    @endif
                </div>
            </div>
            @else
            <div id="is-guest">
                <div class="navbar-item">
                    <div class="content">
                        <a href="{{ route('login') }}" class="link">{{ trans('titles.login') }}</a>
                    </div>
                </div>	
                <div class="navbar-item">
                    <div class="content">
                        <a href="{{ route('register') }}" class="link">{{ trans('titles.register') }}</a>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>

@auth
<div id="is-auth">
    @if (Auth::user()->activated == true)
    <nav id="sidebar" class="sidebar-left">
        <div class="content-menu">
            <ul class="list-unstyled">
                <li class="real-item"><a href="{{ url('/home') }}" class="{{ Request::is('home') ? 'active' : null }}"><i class="fa fa-dashboard sidebar-left-icon"></i>Dashboard</a></li>
                <li class="real-item"><a href="{{ url('/businesses') }}" class="{{ Request::is('businesses') ? 'active' : null }}"><i class="fa fa-users sidebar-left-icon"></i>Businesses</a></li>
                <li class="real-item disabled"><a href="#"><i class="fa fa-building sidebar-left-icon"></i>Human Resources</a></li>
                <li class="real-item disabled"><a href="#"><i class="fa fa-line-chart sidebar-left-icon"></i>Polls</a></li>
                <li><div class="line"></div></li>
                <li class="real-item disabled"><a href="#"><i class="fa fa-gear sidebar-left-icon"></i>General Settings</a></li>
                @role('admin', true)
                <li id="admin-area" class="real-item">
                    <a id="admin-options-toggle" class="dropdown-toggle no-text-selection" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-exclamation-triangle sidebar-left-icon"></i>Admin Tools</a>
                    <div id="admin-options-list" class="dropdown-container">
                        <a class="{{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/users') }}">{!! trans('titles.adminUserList') !!}</a>
                        <a class="{{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                            {!! trans('titles.adminLogs') !!}</a>
                        <a class="{{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}">
                            {!! trans('titles.adminActivity') !!}</a>
                        <a class="{{ Request::is('phpinfo') ? 'active' : null }}" href="{{ url('/phpinfo') }}">
                            {!! trans('titles.adminPHP') !!} </a>
                        <a class="{{ Request::is('routes') ? 'active' : null }}" href="{{ url('/routes') }}">
                            {!! trans('titles.adminRoutes') !!} </a>
                    </div>
                </li>
                @else
                <li class="real-item disabled">
                    <a href="#"><i class="fa fa-question-circle sidebar-left-icon"></i>Support</a>
                </li>
                @endrole
            </ul>
            <div class="footer no-text-selection">
                <div class="miscelaneous">
                    <a class="mr-2" href="#">Politica de confidentialitate </a>
                    <a href="" id="changeLanguages" data-toggle="modal" data-target="#changeLng">
                    <img width="12px" alt="{{ App::getLocale() }}_flag" src="{{asset('assets/svg/flags/'.App::getLocale().'.svg')}}">
                        <span class="text-uppercase">{{ App::getLocale() }}</span>
                    </a>
                </div>
                <span class="copyright">© 2019 Webiz Application<br></span>
                <div>Online Users: <users-count></users-count></div>
            </div>
        </div>
    </nav>
    @endif
    <div id="user-menu" class="user-menu-container">
        <div id="user-sidebar" class="sidebar">
            <div class="user-info">
                <h4>{{ Auth::user()->first_name}}</h4>
                <span>{{ Auth::user()->email}}</span><br>
            </div>
            <div class="user-options">
                @php $employee = Auth::user()->employee @endphp
                @if ($employee)
                    @if ($employee->business->motd)
                        <div class="attention border-0"><span style="color: #666"><b>MOTD:</b> {{ $employee->business->motd}}</span></div>
                    @endif
                @endif
                <ul class="list-unstyled">
                    <li><a class="{{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}"><i class="fa fa-user"></i>{!! trans('titles.profile') !!}</a></li>
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="notification-menu" class="notification-menu-container">
        <div id="notification-sidebar" class="sidebar">
            <div class="notification-title">
                <h3 class="float-left">Notifications</h3>
                @if (Auth::User()->unReadNotifications->count() > 0 || Auth::User()->notifications->count() > 0)
                <div class="dropdown">
                    <button class="btn p-0 float-right" data-toggle="dropdown" aria-expanded="true" type="button"><i class="fa fa-chevron-down"></i></button>
                    <div class="dropdown-menu">
                        @if (Auth::User()->unReadNotifications->count() > 0)
                        <a class="dropdown-item text-warning" href="{{route('read-all')}}">Mark all as read</a>
                        @endif 
                        @if  (Auth::User()->notifications->count() > 0)
                        <a class="dropdown-item text-danger" href="{{route('delete-all')}}">Clear all notifications</a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            <div class="notifications-list">
                @forelse(Auth::user()->notifications as $notification)
                    @include('partials.notification.'.snake_case(class_basename($notification->type)))
                    @empty  
                    <div class="notifications-empty">
                        <div class="area">
                            <i  class="fa fa-bell-o"></i>
                            <br><br>
                            <span>You have no notifications</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>   

    <div class="overlay"></div>
</div>
@include('modals.modal-changeLng')
@endauth
