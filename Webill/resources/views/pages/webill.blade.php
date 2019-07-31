@extends('layouts.regular_pages')

@section('pageTitle', __('pagetitles.services-webill'))

@section('content')
<section class="section-products-1">
    <div class="container">
        <div class="row">
            <div class="col">
                {{ Breadcrumbs::render('services') }}
            </div>
        </div>
        <div class="row section-what-is-webill">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col">
                        <h1>What is Webiz?</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.
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
<section class="section-products-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2>Pellentesque habitant morbi tristique<br /></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam placerat sem at mauris suscipit porta. Cras metus velit, elementum sed pellentesque a, pharetra eu eros. Etiam facilisis placerat euismod. Nam faucibus neque arcu, quis accumsan leo tincidunt varius. In vel diam enim. Sed id ultrices ligula. Maecenas at urna arcu. Sed..<br /></p>
            </div>
            <div class="col-lg-4"><img src="{{asset('assets/img/vm-01.png')}}" class="img-fluid" /></div>
        </div>
    </div>
</section>
<section class="section-products-3" style="background-color: #243A5E">
    <div class="container">
        <p>Save up to 80% with Webiz Application Instances and Webiz Hybrid Benefit for Windows Server</p>
    </div>
</section>
<section class="section-products-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/alarm-clock-1.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Curabitur quis varius</h3>
                        <p>It’s all about choice for your virtual machines. Choose Linux or Windows. Choose to be on-premises, in the cloud, or both. Choose your own virtual machine image or download a certified pre-configured image in the Azure Marketplace.
                            With Virtual Machines, you’re in control.<br /></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/add-3.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Curabitur quis varius</h3>
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
                        <h3>Curabitur quis varius</h3>
                        <p>It’s all about choice for your virtual machines. Choose Linux or Windows. Choose to be on-premises, in the cloud, or both. Choose your own virtual machine image or download a certified pre-configured image in the Azure Marketplace.
                            With Virtual Machines, you’re in control.<br /></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 margin">
                <div class="row">
                    <div class="col-2 pad-0"><img src="{{asset('assets/svg/id-card-3.svg')}}" class="img-fluid" /></div>
                    <div class="col-10">
                        <h3>Curabitur quis varius</h3>
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
                <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit.<br /></h2>
            </div>
        </div>
        <div class="row">
            <div class="col" style="margin-top:20px;"><a href="#">Discover more Webiz Application images</a></div>
        </div>
        <div class="row">
            <div class="col" style="margin-top:36px;"><img src="{{asset('assets/img/image-panel-webiz.png')}}" class="img-fluid" /></div>
        </div>
    </div>
</section>
<section class="section-products-6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 hidden-sm"><span class="icon-size13"><img src="{{asset('assets/svg/windows-2.svg')}}" width="100%" height="100%" class="img-fluid" /></span></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><a href="#" class="btn start-free-btn">Start free</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
