@extends('layouts.regular_pages')

@section('pageTitle', __('pagetitles.home'))


@section('content')
<section class="section-padding bg-1">
    <div class="container">
        <div class="col-12 col-sm-10 col-md-8">
            <div class="intro-text">
                <h1 class="thin" style="margin: initial">{{ __('homepages.welcome') }}</h1>
                <h1>{{config('app.name', 'Webiz')}} Application</h1>
            </div>
            <div class="middle-text">
                <h2>{{ __('homepages.middle-heading') }}<br></h2>
                <p>{{ __('homepages.middle-paragraph') }}</p>
            </div>
            <div class="buttons-action"><button class="btn btn-success grow" id="btn-sign-in" type="button">{{ __('homepages.sign-in') }}</button><button class="btn btn-success grow" type="button" id="btn-create-account">{{ __('homepages.create-account') }}</button></div>
        </div>
    </div>
</section>
<section class="afterIntro">
    <div class="container width-100-container">
        <div class="row">
            <div class="col-sm-7 float-left">
                <h4>{{ __('homepages.solution-heading') }}</h4>
                <p>{{ __('homepages.solution-paragraph') }}</p>
            </div>
            <div class="col-sm-5 float-right">
                <h4>{{ __('homepages.newuser-heading') }}</h4>
                <p>{{ __('homepages.newuser-paragraph') }}</p><button class="btn btn-success new-user-button" type="button">{{ __('homepages.create-account') }}</button><button class="btn btn-success new-user-button" type="button">{{ __('homepages.contact') }}</button></div>
        </div>
    </div>
</section>
<section class="features">
    <div class="container width-100-container section-bg">
        <div class="row">
            <div class="col-md-4 pad-0">
                <div class="item item-1">
                    <h3 style="color:white;">{{ __('homepages.item-1-title') }}</h3>
                    <ul class="none-list text-left features-list">
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 pad-0">
                <div class="item item-2">
                    <h3 style="color:white;">{{ __('homepages.item-2-title') }}</h3>
                    <ul class="none-list text-left features-list">
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 pad-0">
                <div class="item item-3">
                    <h3 style="color:white;">{{ __('homepages.item-3-title') }}</h3>
                    <ul class="none-list text-left features-list">
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div data-aos="flip-up">
            <h2 class="middle-title text-center">Lorem ipsum dolor&nbsp;<span>sit amet consecteur?</span><br></h2>
            <p class="middle-sub-title text-center">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.<br></p>
        </div>
        <div>
            <div class="row">
                <div class="col-lg-4">
                    <ul class="nav nav-tabs">
                        <li data-aos="fade-right" class="active"><a href="#tab1" role="tab" data-toggle="tab" aria-expanded="true"><span class="title">{{ __('homepages.tab-1-title') }}</span><span class="title2">{{ __('homepages.tab-1-subtitle') }}</span><span class="paragraph">{{ __('homepages.tab-1-paragraph') }}</span></a></li>
                        <li data-aos="fade-right"><a href="#tab2" role="tab" data-toggle="tab" aria-expanded="true"><span class="title">{{ __('homepages.tab-2-title') }}</span><span class="title2">{{ __('homepages.tab-2-subtitle') }}</span><span class="paragraph">{{ __('homepages.tab-2-paragraph') }}</span></a></li>
                        <li data-aos="fade-right"><a href="#tab3" role="tab" data-toggle="tab" aria-expanded="true"><span class="title">{{ __('homepages.tab-3-title') }}</span><span class="title2">{{ __('homepages.tab-3-subtitle') }}</span><span class="paragraph">{{ __('homepages.tab-3-paragraph') }}</span></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 tab-content col-md-push-1">
                    <div id="tab1" class="tab-pane active"><img src="{{asset('assets/img/laptop-1.png')}}"></div>
                    <div id="tab2" class="tab-pane"><img src="{{asset('assets/img/laptop-2.png')}}"></div>
                    <div id="tab3" class="tab-pane"><img src="{{asset('assets/img/laptop-3.png')}}"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about">
    <div class="container width-100-container section-bg">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="header" data-aos="flip-up">
                    <hr align="left">
                    <h2 class="middle-title"><span>{{ __('homepages.about-title') }}</span>&nbsp;<br>Webiz Application?</h2>
                </div>
                <div class="row content">
                    <div class="col-md-12 col-lg-7">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/alarm.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.<br></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/bookmark-1.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/archive.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.<br></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/success.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/archive-1.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.<br></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/paper-plane.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/calculator.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus. Curabitur.<br></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/folder-12.svg')}}" class="img-fluid"></div>
                                    <div class="col-10">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br></h3>
                                        <p>Nam eu neque vulputate diam rhoncus faucibus.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 hidden-md">
                        <img class="img-fluid" src="{{asset('assets/img/tableta_lp.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item item active bg-carousel">
                <div class="container separator">
                    <div class="row">
                        <div class="col-lg-5 text-center-mobile"><img src="{{asset('assets/img/av2018-slider-logo.png')}}"></div>
                        <div class="col-lg-7 text-center-mobile">
                            <div class="slider-title">
                                <h2>Sed ut perspiciatis unde omnis iste natus error sit voluptatem!<br></h2>
                            </div>
                            <div class="slider-content">
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut &nbsp;fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<br>Neque porro quisquam est, qui dolorem ipsum quia dolor
                                    sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.<br><br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item bg-carousel">
                <div class="container separator">
                    <div class="row">
                        <div class="col-lg-5 text-center-mobile"><img src="{{asset('assets/img/av2018-slider-logo.png')}}"></div>
                        <div class="col-lg-7 text-center-mobile">
                            <div class="slider-title">
                                <h2>Lorem ipsum dolor sit amet, donsectetur adipiscing elit, sed do eiusmod tempor!<br></h2>
                            </div>
                            <div class="slider-content">
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item bg-carousel">
                <div class="container separator">
                    <div class="row">
                        <div class="col-lg-5 text-center-mobile"><img src="{{asset('assets/img/av2018-slider-logo.png')}}"></div>
                        <div class="col-lg-7 text-center-mobile">
                            <div class="slider-title">
                                <h2>Lorem ipsum dolor sit amet, donsectetur adipiscing elit, sed do eiusmod tempor!<br></h2>
                            </div>
                            <div class="slider-content">
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a href="#carouselExampleIndicators" class="carousel-control-prev" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Inapoi</span></a><a href="#carouselExampleIndicators"
            class="carousel-control-next" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Inainte</span></a></div>
</section>
@endsection
