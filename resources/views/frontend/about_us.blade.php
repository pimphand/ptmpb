@extends('layouts.app')
@section('content')
    <!-- INNER PAGE BANNER -->
    <x-banner :title="$title"></x-banner>
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb10">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
    </div>
    <!-- BREADCRUMB ROW END -->

    <!-- ABOUT COMPANY SECTION START -->
    <div class="section-full p-t80 p-b50">
        <div class="container">
            <!-- TITTLE START -->
            <div class="section-head text-center">
                <h2 class="text-uppercase">{{ $title }}</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator style-square">
                        <span class="separator-left site-bg-primary"></span>
                        <span class="separator-right site-bg-primary"></span>
                    </div>
                </div>

            </div>
            @if($about)
                <div class="section-head text-justify">
                    <p style="text-align: center !important;">{!! $about->content !!}</p>
                    <a href="{{ asset('storage/' . $about->data['profile']) }}" target="_blank" class=" site-button m-r15"
                       type="button">Download Profile Perusahaan</a>
                </div>

            <!-- TITLE END -->
            <h4 class="section-head text-center "> Legalitas Perusahaan</h4>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 m-b30 animate bounce animated" data-animate="bounce" data-duration="1.0s"
                    data-delay="0.1s" data-offset="100"
                    style="animation-duration: 1s; animation-delay: 0.1s; visibility: visible;">
                    <div class="wt-icon-box-wraper left p-a30 bg-white">
                        <div class="wt-icon-box-md site-text-primary radius bdr-3">
                            <span class="icon-cell">
                                <img src="{{ asset('certificate-svgrepo-com.svg') }}" width="60px"
                                    alt="{{ env('APP_NAME') }}">
                            </span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase">Akte Pendirian.</h5>
                            <h4>{{ $about->data['deed_of_establishment'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 m-b30 animate bounce animated" data-animate="bounce" data-duration="1.0s"
                    data-delay="0.1s" data-offset="100"
                    style="animation-duration: 1s; animation-delay: 0.1s; visibility: visible;">
                    <div class="wt-icon-box-wraper left p-a30 bg-white">
                        <div class="wt-icon-box-md site-text-primary radius bdr-3">
                            <span class="icon-cell">
                                <img src="{{ asset('law-auction-svgrepo-com.svg') }}" width="60px"
                                    alt="{{ env('APP_NAME') }}">
                            </span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase">SK Kumham RI.</h5>
                            <h4>{{ $about->data['kumham_decree'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 m-b30 animate bounce animated" data-animate="bounce" data-duration="1.0s"
                    data-delay="0.1s" data-offset="100"
                    style="animation-duration: 1s; animation-delay: 0.1s; visibility: visible;">
                    <div class="wt-icon-box-wraper left p-a30 bg-white">
                        <div class="wt-icon-box-md site-text-primary radius bdr-3">
                            <span class="icon-cell">
                                <img src="{{ asset('taxes-svgrepo-com.svg') }}" width="60px" alt="{{ env('APP_NAME') }}">
                            </span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase">NPWP.</h5>
                            <h4>{{ $about->data['npwp'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 m-b30 animate bounce animated" data-animate="bounce" data-duration="1.0s"
                    data-delay="0.1s" data-offset="100"
                    style="animation-duration: 1s; animation-delay: 0.1s; visibility: visible;">
                    <div class="wt-icon-box-wraper left p-a30 bg-white">
                        <div class="wt-icon-box-md site-text-primary radius bdr-3">
                            <span class="icon-cell">
                                <img src="{{ asset('building-2-svgrepo-com.svg') }}" width="60px"
                                    alt="{{ env('APP_NAME') }}">
                            </span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase">NIB.</h5>
                            <h4>{{ $about->data['nib'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 m-b30">
                    <!--Fade slider-->
                    <h2 class="text-uppercase">VISI PERUSAHAAN</h2>

                    <h5>
                        Menjadi distributor terkemuka di
                        bidang oli dan pelumas yang
                        menyediakan solusi pelumasan terbaik
                        bagi berbagai sektor industri dan
                        kendaraan di Indonesia.
                    </h5>
                    <!--fade slider END-->
                </div>
                <div class="col-lg-6 col-md-12 m-b30">
                    <!-- ACCORDIAN  BG DARK -->
                    <h2 class="text-uppercase">MISI PERUSAHAAN</h2>
                    <ul>
                        <li>
                            <h5>Menyediakan produk berkualitas
                                dengan harga yang kompetitif.</h5>
                        </li>
                        <li>
                            <h5>Memberikan pelayanan pelanggan
                                yang unggul melalui kerja sama yang
                                berkesinambungan.</h5>
                        </li>
                        <li>
                            <h5>Memperkuat kemitraan dengan
                                produsen oli ternama untuk menjaga
                                kualitas produk dan inovasi terkini.</h5>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
