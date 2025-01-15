@extends('frontend.blog.index')
@section('blog-content')
    <div class="portfolio-wrap wt-blog-grid-3 row" style="position: relative; height: 853.3px;">
        @forelse($blogs as $blog)
            <div class="post masonry-item col-xl-4 col-lg-6 col-md-6" style="position: absolute; left: 0px; top: 0px;">
                <div class="blog-post blog-grid date-style-3">

                    <div class="wt-post-media wt-img-effect zoom-slow">
                        <a href="{{ route('blog', $blog->slug) }}"><img src="{{ asset('storage/' . $blog->thumbnail) }}"
                                alt=""></a>
                    </div>
                    <div class="wt-post-info p-t30 ">
                        <div class="wt-post-title ">
                            <h3 class="post-title"><a href="{{ route('blog', $blog->slug) }}">{{ $blog->title }}</a></h3>
                        </div>
                        <div class="wt-post-meta ">
                            <ul>
                                <li class="post-date"><i
                                        class="fa fa-calendar"></i><strong>{{ date('d M', strtotime($blog->created_at)) }}</strong>
                                    <span> {{ date('Y', strtotime($blog->created_at)) }}</span>
                                </li>
                                <li class="post-author"><i class="fa fa-user"></i><a
                                        href="{{ route('blog', $blog->slug) }}">By <span>{{ $blog->user->name }}</span></a>
                                </li>
                                <li class="post-comment"><i class="fa fa-comments"></i> <a
                                        href="{{ route('blog', $blog->slug) }}">{{ $blog->count }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="clearfix">
                            <div class="wt-post-readmore pull-left">
                                <a href="{{ route('blog', $blog->slug) }}" title="READ MORE" rel="bookmark"
                                    class="site-button-link">
                                    Baca Selengkapnya
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-lg-12">
                <div class="alert alert-warning">
                    Tidak ada data.
                </div>
            </div>
        @endforelse

    </div>
@endsection
