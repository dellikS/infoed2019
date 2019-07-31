<footer id="footer" class="margin-top-40">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>{{__('auth-footer.usefullLinks')}}</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">{{__('auth-footer.link1')}}</a></li>
                        <li><a href="#">{{__('auth-footer.link2')}}</a></li>
                        <li><a href="#">{{__('auth-footer.link3')}}</a></li>
                        <li><a href="#">{{__('auth-footer.link4')}}</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <h4>{{__('auth-footer.discoverLinks')}}</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">{{__('auth-footer.link5')}}</a></li>
                        <li><a href="#">{{__('auth-footer.link6')}}</a></li>
                        <li><a href="#">{{__('auth-footer.link7')}}</a></li>
                        <li><a href="#">{{__('auth-footer.link8')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-closer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{__('auth-footer.followUs')}}</h4>
                    <ul class="list-inline" id="social-media">
                        <li class="list-inline-item"><a href="{{ route('facebook')}}"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="{{ route('github')}}"><i class="fa fa-github"></i></a></li>
                        <li class="list-inline-item"><a href="{{ route('instagram')}}"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="{{ route('youtube')}}"><i class="fa fa-youtube-play"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>{{__('auth-footer.location')}}</h4>
                    <form action="{{ route('language') }}" method="post" >
                        <select name="locale" class="form-control" id="languageSwitcher" onchange="this.form.submit();">
                            @foreach ($translation_array as $translation)
                                <option value="{{ $translation->code }}" {{ App::getLocale() == $translation->code ? ' selected' : '' }}>{{ $translation->name }}</option>;
                            @endforeach
                        </select>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p>{{__('auth-footer.copyright')}}</p>
        </div>
    </div>
</footer>