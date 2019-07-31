<nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-black">
    <div class="container-fluid"><a class="navbar-brand" href="{{ url('/') }}"><img width="80px" src="{{asset('assets/svg/webill.svg')}}"></a><div class="navbar-brand-line"></div><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul id="main-menu-nav" class="nav navbar-nav mr-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="{{ url('/') }}">{{ __('navigation.overview') }}</a></li>
                <li class="dropdown" role="presentation"><a id="services-dropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('navigation.services') }}<i class="material-icons">keyboard_arrow_down</i></a>
                    <nav class="dropdown-menu menu-drop" aria-labelledby="services-dropdown">
                        <ul id="services-menu">
                            <li>
                                <a href="{{url('services/webill')}}">
                                    <span class="label">Webill Application</span>
                                    <span class="sub">{{ __('navigation.services-sub-webill') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('services/webiz')}}">
                                    <span class="label">Webiz Application</span>
                                    <span class="sub">{{ __('navigation.services-sub-webiz') }}</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#">{{ __('navigation.solutions') }}<i class="material-icons">keyboard_arrow_down</i></a></li>
                <li class="nav-item" role="presentation"><a id="resources-dropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('navigation.resources') }}<i class="material-icons">keyboard_arrow_down</i></a>
                    <nav class="dropdown-menu menu-drop" aria-labelledby="resources-dropdown">
                        <ul id="resources-menu">
                            <li>
                                <a target="_blank" rel="noopener noreferrer" href="{{url('github')}}">
                                    <span class="label">Open Source Code (Github)</span>
                                    <span class="sub">The open source code of our application!</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('services/webiz')}}">
                                    <span class="label">Documentation</span>
                                    <span class="sub">All you need to know about our team and our app!</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#">{{ __('navigation.blog') }}</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#">{{ __('navigation.contact') }}</a></li>
            </ul>
            <ul id="login-menu-nav" class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('wedash') }}">{{ __('navigation.freeaccount') }}<i class="material-icons">keyboard_arrow_right</i></a></li>
            </ul>
        </div>
    </div>
</nav>