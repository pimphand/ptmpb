@extends('layouts.app')
@section('content')
    @php
      $blogs =   \App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get();
    @endphp

    <!-- SLIDER START -->
    <x-home.slider></x-home.slider>
    <!-- SLIDER END -->

    <!-- OUR VALUE SECTION START -->
    <div class="section-full site-bg-primary p-t40 p-b10">
        <div class="container our-value">
            <div class="row">
                <div class="col-lg-8 col-md-8 our-value-left">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 m-b30">
                            <div class="wt-icon-box-wraper left ">
                                <div class="icon-md">
                                    <div class="icon-cell text-white">
                                        <span class="iconmoon-buildings"></span>
                                    </div>
                                </div>
                                <div class="icon-content text-secondry">
                                    <h5 class="wt-tilte text-uppercase m-b5">Kualitas Terbaik</h5>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 m-b30">
                            <div class="wt-icon-box-wraper left">
                                <div class="icon-md site-text-primary">
                                    <div class="icon-cell text-white">
                                        <span class="iconmoon-hours"></span>
                                    </div>
                                </div>
                                <div class="icon-content text-secondry">
                                    <h5 class="wt-tilte text-uppercase m-b0">24 hour support</h5>
                                    <p>Kami siap membantu Anda kapan saja, sepanjang hari tanpa henti.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 our-value-right m-b30">
                    <div class="pull-right">
                        <a href="/contact" class="site-button-secondry text-uppercase font-weight-600">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OUR VALUE SECTION  END -->

    <!-- WHY CHOOSE US SECTION START  -->
    <x-home.choose></x-home.choose>

    <!-- WHY CHOOSE US SECTION END  -->

    <!-- COMPANY DETAIL SECTION START -->
{{--    <div class="section-full p-t50 p-b50 overlay-wraper bg-parallax"  data-stellar-background-ratio="0.5" style="background-image:url(images/background/bg-5.jpg);">--}}
{{--        <div class="overlay-main opacity-07 bg-black"></div>--}}
{{--        <div class="container ">--}}
{{--            <div class="row d-flex justify-content-end">--}}

{{--                <div class="col-lg-8 col-md-12">--}}

{{--                    <div class="text-right text-white">--}}
{{--                        <h3 class="font-24">The Construction Company</h3>--}}
{{--                        <h1 class="font-60">AWESOME FACTS</h1>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a metus pellentesque, scelerisque ex sed, volutpat nisi. Curabitur tortor mi, eleifend ornare lobortis non. Nulla porta purus quis iaculis ultrices. Proin aliquam sem at nibh hendrerit sagittis. Nullam ornare odio eu lacus tincidunt malesuada.</p>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-lg-4 col-md-4">--}}
{{--                            <div class="status-marks  text-white m-b30">--}}
{{--                                <div class="status-value text-right">--}}
{{--                                    <span class="counter">1150</span>--}}
{{--                                    <i class="fa fa-building font-26 m-l15"></i>--}}
{{--                                </div>--}}
{{--                                <h6 class="text-uppercase text-white text-right">PROJECT COMPLETED</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-4">--}}
{{--                            <div class="status-marks  text-white m-b30">--}}
{{--                                <div class="status-value text-right">--}}
{{--                                    <span class="counter">5223</span>--}}
{{--                                    <i class="fa fa-users font-26 m-l15"></i>--}}
{{--                                </div>--}}
{{--                                <h6 class="text-uppercase text-white text-right">HAPPY CLIENTS</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-4">--}}
{{--                            <div class="status-marks  text-white m-b30">--}}
{{--                                <div class="status-value text-right">--}}
{{--                                    <span class="counter">4522</span>--}}
{{--                                    <i class="fa fa-user-plus font-26 m-l15"></i>--}}
{{--                                </div>--}}
{{--                                <h6 class="text-uppercase text-white text-right">WORKERS EMPLOYED</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- COMPANY DETAIL SECTION End -->

    <!-- ABOUT COMPANY SECTION START -->
    <x-home.about></x-home.about>

    <!-- ABOUT COMPANY SECTION END -->

    <!-- LATEST PROJECT SECTION START -->

    <!-- LATEST PROJECT SECTION END -->

    <!-- OUR TEAM MEMBER SECTION START -->
    <div class="section-full text-center wt-our-team bg-white p-t80 bg-no-repeat bg-bottom-center" style="background-image:url(images/background/bg-8.jpg);">
        <div class="container">

            <!-- TITTLE START -->
            <div class="section-head text-center">
                <h2 class="text-uppercase">Team Kami</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator style-square">
                        <span class="separator-left site-bg-primary"></span>
                        <span class="separator-right site-bg-primary"></span>
                    </div>
                </div>
                <p></p>
            </div>
            <!-- TITLE END -->

            <div class="section-content">
                <div class="wt-team-five-warper clearfix" id="teams">

                </div>
            </div>

        </div>
    </div>
    <!-- OUR TEAM MEMBER SECTIO`N END -->

    <!-- LATEST BLOG SECTION START -->
    <div class="section-full latest-blog bg-gray p-t80 p-b50">
        <div class="container">
            <!-- TITLE -->
            <div class="section-head text-center">
                <h2 class="text-uppercase">BLog Terbaru</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator style-square">
                        <span class="separator-left site-bg-primary"></span>
                        <span class="separator-right site-bg-primary"></span>
                    </div>
                </div>
                <p></p>
            </div>
            <!-- TITLE -->

            <div class="section-content ">
                <div class="row">

                    @foreach($blogs as $blog)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="blog-post latest-blog-1 date-style-3">
                                <div class="wt-post-media wt-img-effect zoom-slow">
                                    <a href="{{route('blog',$blog->slug)}}"><img src="{{asset('storage/'.$blog->thumbnail)}}?t={{time()}}" alt="{{$blog->title}}"></a>
                                </div>
                                <div class="wt-post-info p-a30 p-b20 bg-white">
                                    <div class="wt-post-title ">
                                        <h3 class="post-title"><a href="{{route('blog',$blog->slug)}}">{{$blog->title}}</a></h3>
                                    </div>
                                    <div class="wt-post-meta ">
                                        <ul>
                                            <li class="post-date"><i class="fa fa-calendar"></i><strong>{{date('d M', strtotime($blog->created_at))}}</strong>
                                                <span> {{date('Y', strtotime($blog->created_at))}}</span></li>
                                            <li class="post-author"><i class="fa fa-user"></i><a href="{{route('blog', $blog->slug)}}">By <span>{{$blog->user->name}}</span></a>
                                            </li>
                                            <li class="post-comment"><i class="fa fa-comments"></i> <a href="{{route('blog', $blog->slug)}}">0</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-text">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- LATEST BLOG SECTION END -->
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{route('home-teams')}}',
                type: 'GET',
                success: function (data) {
                    $('#teams').html(data);
                }
            });
        });
    </script>
@endpush
