@extends('frontend.blog.index')
@section('blog-content')
    <div class="blog-post date-style-3 blog-post-single">
        <div class="wt-post-media wt-img-effect">
            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}">
        </div>
        <div class="post-description-area p-t30">
            <div class="wt-post-title ">
                <h3 class="post-title">{{ $blog->title }}</h3>
            </div>
            <div class="wt-post-meta ">
                <ul>
                    <li class="post-date"> <i
                            class="fa fa-calendar"></i><strong>{{ date('D M', strtotime($blog->created_at)) }}</strong>
                        <span>
                            {{ date('Y', strtotime($blog->created_at)) }}</span>
                    </li>
                    <li class="post-author"><i class="fa fa-user"></i><span>{{ $blog->user->name }}</span></li>
                    <li class="post-comment"><i class="fa fa-eye"></i> {{ $blog->count }}</li>
                </ul>
            </div>
            <div class="wt-post-text">
                {!! $blog->content !!}
            </div>
            <div class="widget bg-white  widget_tag_cloud">
                <h4 class="tagcloud">Tags</h4>
            </div>
            <div class="wt-divider bg-gray-dark"><i class="icon-dot c-square"></i></div>
            <div class="wt-box"></div>
            <div class="wt-divider bg-gray-dark"><i class="icon-dot c-square"></i></div>
        </div>
    </div>
@endsection

@push('meta')
    <title>{{ $blog->title }}</title>
    <meta name="description" content="{{ $blog->description }}">
    <meta name="keywords" content="{{ $blog->keywords }}">
    <meta name="author" content="{{ $blog->user->name }}">
    <meta name="date" content="{{ $blog->created_at }}">
    <meta name="image" content="{{ asset('storage/' . $blog->thumbnail) }}">
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blog->description }}">
    <meta property="og:image" content="{{ asset('storage/' . $blog->thumbnail) }}">
    <meta property="og:url" content="{{ route('blog', $blog->slug) }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $blog->created_at }}">
    <meta property="article:modified_time" content="{{ $blog->updated_at }}">
    <meta property="article:author" content="{{ $blog->user->name }}">
    <meta property="article:section" content="{{ $blog->category->name }}">
    <meta property="article:tag" content="{{ $blog->keywords }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ config('app.name') }}">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description" content="{{ $blog->description }}">
    <meta name="twitter:image" content="{{ asset('storage/' . $blog->thumbnail) }}">
    <meta name="twitter:creator" content="{{ $blog->user->name }}">
    <meta name="twitter:label1" content="Written by">
    <meta name="twitter:data1" content="{{ $blog->user->name }}">
    <meta name="twitter:label2" content="Filed under">
    <meta name="twitter:data2" content="{{ $blog->category->name }}">
    <meta name="twitter:domain" content="{{ config('app.url') }}">
    <link rel="canonical" href="{{ route('blog', $blog->slug) }}">
@endpush
