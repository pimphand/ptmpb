@extends('frontend.blog.index')
@section('blog-content')
    <div class="blog-post date-style-3 blog-post-single">
        <div class="wt-post-media wt-img-effect">
            <img src="{{asset('storage/'.$blog->thumbnail)}}" alt="{{$blog->title}}">
        </div>
        <div class="post-description-area p-t30">
            <div class="wt-post-title ">
                <h3 class="post-title">{{$blog->title}}</h3>
            </div>
            <div class="wt-post-meta ">
                <ul>
                    <li class="post-date"> <i class="fa fa-calendar"></i><strong>{{date('D M',strtotime($blog->created_at))}}</strong> <span> {{date('Y',strtotime($blog->created_at))}}</span> </li>
                    <li class="post-author"><i class="fa fa-user"></i><span>{{$blog->user->name}}</span></li>
                    <li class="post-comment"><i class="fa fa-eye"></i> {{$blog->count}}</li>
                </ul>
            </div>
            <div class="wt-post-text">
                {!! $blog->content !!}
            </div>
            <div class="widget bg-white  widget_tag_cloud">
                <h4 class="tagcloud">Tags</h4>
{{--                <div class="tagcloud">--}}
{{--                    <a href="about-1.html">First tag</a>--}}
{{--                    <a href="about-1.html">Second tag</a>--}}
{{--                    <a href="about-1.html">Three tag</a>--}}
{{--                    <a href="about-1.html">Four tag</a>--}}
{{--                    <a href="about-1.html">Five tag</a>--}}
{{--                </div>--}}
            </div>
            <div class="wt-divider bg-gray-dark"><i class="icon-dot c-square"></i></div>
            <div class="wt-box">

{{--                <div class="b-detail-social d-flex justify-content-between">--}}
{{--                    <h4 class="tagcloud pull-left m-t5 m-b10">Share this Post:</h4>--}}
{{--                    <div class="widget_social_inks">--}}
{{--                        <ul class="social-icons social-md social-square social-dark m-b0">--}}
{{--                            <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>--}}
{{--                            <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>--}}
{{--                            <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>--}}
{{--                            <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>--}}
{{--                            <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
            <div class="wt-divider bg-gray-dark"><i class="icon-dot c-square"></i></div>
        </div>
    </div>
@endsection
