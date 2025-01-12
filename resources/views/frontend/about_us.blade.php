@extends('layouts.app')
@section('content')
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper" style="background-image:url({{$about->data['banner']}});">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <h1 class="text-white">{{$title}}</h1>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li>{{$title}}</li>
            </ul>
        </div>
    </div>
    <!-- BREADCRUMB ROW END -->

    <!-- ABOUT COMPANY SECTION START -->
    <div class="section-full p-t80 p-b50">
        <div class="container">
            <!-- TITTLE START -->
            <div class="section-head text-center">
                <h2 class="text-uppercase">{{$title}}</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator style-square">
                        <span class="separator-left site-bg-primary"></span>
                        <span class="separator-right site-bg-primary"></span>
                    </div>
                </div>

            </div>
            <div class="section-head text-justify">
                <p style="text-align: center !important;">{!! $about->content !!}</p>
            </div>
            <!-- TITLE END -->
            <h4 class="section-head text-center "> Legalitas Perusahaan</h4>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 m-b30 animate bounce animated" data-animate="bounce" data-duration="1.0s" data-delay="0.1s" data-offset="100" style="animation-duration: 1s; animation-delay: 0.1s; visibility: visible;">
                    <div class="wt-icon-box-wraper left p-a30 bg-white">
                        <div class="wt-icon-box-md site-text-primary radius bdr-3">
                            <span class="icon-cell"><i class="fa fa-chrome"></i></span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase">bounce</h5>
                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet  .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
