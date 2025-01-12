@extends('layouts.app')

@section('content')
    <div class="wt-bnr-inr overlay-wraper" style="background-image:url(images/banner/blog-banner.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <h1 class="text-white">{{$blog->title}}</h1>
            </div>
        </div>
    </div>

    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/blog"> Blog</a></li>
                <li>{{$blog->title}}</li>
            </ul>
        </div>
    </div>

    <div class="section-full p-t80 p-b50">
        <div class="container">
            <div class="row">

                <!-- SIDE BAR START -->
                <div class="col-lg-4 col-md-12">

                    <x-blog.aside></x-blog.aside>

                </div>
                <!-- SIDE BAR END -->

                <!-- RIGHT PART START -->
                <div class="col-lg-8 col-md-12">
                    @yield('blog-content')

                </div>
                <!-- RIGHT PART END -->

            </div>
        </div>
    </div>
@endsection
