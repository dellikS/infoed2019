@extends('layouts.regular_pages')

@section('pageTitle', __('pagetitles.services-webiz'))

@section('content')
<section class="section-products-1">
    <div class="container">
        <div class="row">
            <div class="col">
                {{ Breadcrumbs::render('webiz') }}
            </div>
        </div>
        <div class="row section-what-is-webill">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col">
                        <h1>What is webiz?</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Microsoft Azure is an ever-expanding set of cloud services to help your organization meet your business challenges. It’s the freedom to build, manage, and deploy applications on a massive, global network using your favorite
                            tools and frameworks!<br /></p>
                    </div>
                </div>
                <div class="row row-3">
                    <div class="col-lg-4"><a href="#" class="btn start-free-btn">Start free</a></div>
                    <div class="col-sm-6 question-answered"><a href="#"><i class="material-icons">arrow_downward</i>Your most popular questions answered</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-products-3">
    <div class="container">
        <p>Save up to 80% with webiz Application Instances and webiz Hybrid Benefit for Windows Server</p>
    </div>
</section>
<section class="section-products-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2>Choose your language, workload, operating system<br /></h2>
                <p>Azure Virtual Machines gives you the flexibility of virtualization for a wide range of computing solution development and testing, running applications, and extending your datacenter. It’s the freedom of open-source software configured
                    the way you need it. It’s as if it was another rack in your datacenter, giving you the power to deploy an application in seconds instead of weeks.<br /></p>
            </div>
            <div class="col-lg-4"><img src="{{asset('assets/img/vm-01.png')}}" class="img-fluid" /></div>
        </div>
    </div>
</section>
<section class="section-products-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/alarm-clock-1.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Get more choice</h3>
                        <p>It’s all about choice for your virtual machines. Choose Linux or Windows. Choose to be on-premises, in the cloud, or both. Choose your own virtual machine image or download a certified pre-configured image in the Azure Marketplace.
                            With Virtual Machines, you’re in control.<br /></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/add-3.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Get more choice</h3>
                        <p>It’s all about choice for your virtual machines. Choose Linux or Windows. Choose to be on-premises, in the cloud, or both. Choose your own virtual machine image or download a certified pre-configured image in the Azure Marketplace.
                            With Virtual Machines, you’re in control.<br /></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/blueprint.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Get more choice</h3>
                        <p>It’s all about choice for your virtual machines. Choose Linux or Windows. Choose to be on-premises, in the cloud, or both. Choose your own virtual machine image or download a certified pre-configured image in the Azure Marketplace.
                            With Virtual Machines, you’re in control.<br /></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/id-card-3.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Get more choice</h3>
                        <p>It’s all about choice for your virtual machines. Choose Linux or Windows. Choose to be on-premises, in the cloud, or both. Choose your own virtual machine image or download a certified pre-configured image in the Azure Marketplace.
                            With Virtual Machines, you’re in control.<br /></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-products-5 text-center">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Create virtual machines in seconds. Choose from our images or images provided by partners and the community.<br /></h2>
            </div>
        </div>
        <div class="row">
            <div class="col" style="margin-top:20px;"><a href="#">Discover more webiz Application images</a></div>
        </div>
        <div class="row">
            <div class="col" style="margin-top:36px;"><img src="{{asset('assets/img/image-panel-webiz.png')}}" class="img-fluid" /></div>
        </div>
    </div>
</section>
<section class="webiz-slider">
    <div id="carouselWebiz" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item item active webiz-slide-1">
                <div class="container separator">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center">
                            <div class="slider-title">
                                <h2>Sed ut perspiciatis unde omnis iste natus error sit voluptatem!<br></h2>
                            </div>
                            <div class="slider-content">
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut &nbsp;fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<br>Neque porro quisquam est, qui dolorem ipsum quia dolor
                                    sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item webiz-slide-2">
                <div class="container separator">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center">
                            <div class="slider-title">
                                <h2>Sed ut perspiciatis unde omnis iste natus error sit voluptatem!<br></h2>
                            </div>
                            <div class="slider-content">
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut &nbsp;fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<br>Neque porro quisquam est, qui dolorem ipsum quia dolor
                                    sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item webiz-slide-3">
                <div class="container separator">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center">
                            <div class="slider-title">
                                <h2>Sed ut perspiciatis unde omnis iste natus error sit voluptatem!<br></h2>
                            </div>
                            <div class="slider-content">
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut &nbsp;fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.<br>Neque porro quisquam est, qui dolorem ipsum quia dolor
                                    sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a href="#carouselWebiz" class="carousel-control-prev" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Inapoi</span></a><a href="#carouselWebiz"
            class="carousel-control-next" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Inainte</span></a></div>
</section>
@endsection
