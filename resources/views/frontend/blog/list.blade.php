@extends('frontend.blog.index')
@section('blog-content')
    <!-- BLOG GRID START -->
    <div class="portfolio-wrap wt-blog-grid-3 row" style="position: relative; height: 852.3px;">

        @foreach ($blogs as $blog)
            <!-- COLUMNS 1 -->
            <div class="post masonry-item col-xl-4 col-lg-6 col-md-6" style="position: absolute; left: 0px; top: 0px;">
                <div class="blog-post blog-grid date-style-3">

                    <div class="wt-post-media wt-img-effect zoom-slow">
                        <a href="{{ route('blog', $blog->slug) }}">
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="">
                        </a>
                    </div>
                    <div class="wt-post-info p-t30 ">
                        <div class="wt-post-title ">
                            <h3 class="post-title"><a href="{{ route('blog', $blog->slug) }}">{{ $blog->title }}</a></h3>
                        </div>
                        <div class="wt-post-meta ">
                            <ul>
                                <li class="post-date"> <i class="fa fa-calendar"></i><strong>20 Dec</strong> <span>
                                        2022</span> </li>
                                <li class="post-author"><i class="fa fa-user"></i><a
                                        href="{{ route('blog', $blog->slug) }}">{{ $blog->user->name }}</a> </li>
                                <li class="post-comment"><i class="fa fa-eye"></i> <a
                                        href="{{ route('blog', $blog->slug) }}">{{ $blog->count }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="wt-post-text">
                            <p>{!! Str::limit($blog->content, 100, '...') !!}</p>
                        </div>
                        <div class="clearfix">
                            <div class="wt-post-readmore pull-left">
                                <a href="{{ route('blog', $blog->slug) }}" title="READ MORE" rel="bookmark"
                                    class="site-button-link">Read
                                    More</a>
                            </div>
                            <div class="widget_social_inks pull-right">
                                <ul class="social-icons social-radius social-dark m-b0">
                                    <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        @endforeach

    </div>
    <!--  BLOG GRID END -->

    <!-- PAGINATION START -->
    <div class="pagination-bx col-lg-12 clearfix ">
        <ul class="custom-pagination pagination-1">
            <li><a href="#">«</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">»</a></li>
        </ul>
    </div>
    <!-- PAGINATION END -->
@endsection
