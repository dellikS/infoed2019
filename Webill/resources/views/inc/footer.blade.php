<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-lg-left">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{url('legal')}}">{{ __('footer.legal') }}</a></li>
                        <li class="list-inline-item"><a href="{{url('legal/privacy')}}">{{ __('footer.privacy') }}</a></li>
                        <li class="list-inline-item"><a href="{{url('legal/cookies')}}">{{ __('footer.cookies') }}</a></li>
                    </ul>
                    <div id="license-footer">
                        <p class="footer-license">{{ __('footer.license_one') }}</p>
                        <p class="footer-license">{{ __('footer.license_two') }}</p>
                    </div>
                </div>
                <div class="col-md-4 text-lg-right">
                    <form action="{{ route('language') }}" method="post" >
                            <label for="language-switcher"><strong>{{ __('footer.language') }}</strong></label>
                            <select class="language-switcher" name="locale" id="language-switcher" onchange="this.form.submit();">
                                    <option value="en" {{ App::getLocale() == 'en' ? ' selected' : '' }}>{{ __('footer.english') }}</option>
                                    <option value="ro" {{ App::getLocale() == 'ro' ? ' selected' : '' }}>{{ __('footer.romanian') }}</option>
                            </select>
                            {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
</footer>