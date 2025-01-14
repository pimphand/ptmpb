<aside class="side-bar">
    @php
        $populers = \App\Models\Blog::orderBy('count', 'desc')->limit(3)->get();
        $old = \App\Models\Blog::orderBy('created_at', 'asc')->limit(3)->get();
        $galleries = \App\Models\Image::whereHas('gallery', function ($q) {
            $q->where('type', 'gallery');
        })->limit(10)->get();
    @endphp
    <!-- 13. SEARCH -->
    <div class="widget bg-white ">
        <h4 class="widget-title">Search</h4>
        <div class="search-bx">
            <form role="search" method="get" action="{{route('blogs')}}">
                <div class="input-group">
                    <input name="search" type="text" class="form-control" placeholder="Write your text"
                           value="{{request()->search}}">
                    <span class="input-group-btn">
                        <button type="submit" class="site-button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <!-- 2. RECENT POSTS -->
    <div class="widget bg-white  recent-posts-entry">
        <h4 class="widget-title">Posts</h4>
        <div class="section-content">
            <div class="wt-tabs tabs-default border">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active"
                           data-bs-toggle="tab"
                           href="#web-design-1" aria-selected="true" role="tab">Berita Lama</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab"
                           href="#graphic-design-1" aria-selected="false"
                           tabindex="-1" role="tab">Popular</a></li>
                </ul>
                <div class="tab-content">

                    <div id="web-design-1" class="tab-pane active " role="tabpanel">
                        <div class="widget-post-bx">
                            @foreach($old as $ol)
                                <div class="widget-post clearfix bg-gray">
                                    <div class="wt-post-media">
                                        <img src="{{asset('storage/'.$ol->thumbnail)}}" alt="{{$ol->title}}" class="radius-bx">
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title">{{$ol->title}}</h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author">{{date('d M', strtotime($ol->created_at))}}</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> {{$ol->count}} baca</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>

                    <div id="graphic-design-1" class="tab-pane" role="tabpanel">
                        <div class="widget-post-bx">

                            @foreach($populers as $populer)
                                <div class="widget-post clearfix bg-gray">
                                    <div class="wt-post-media">
                                        <img src="{{asset('storage/'.$populer->thumbnail)}}" alt="" class="radius-bx">
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title">{{$populer->title}}</h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author">{{date('d M', strtotime($ol->created_at))}}</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> {{$populer->count}} Baca</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- 4. OUR GALLERY  -->
    <div class="widget widget_gallery mfp-gallery">
        <h4 class="widget-title">Our Gallery</h4>
        <ul>
            @foreach($galleries as $gallery)
                <li>
                    <div class="wt-post-thum">
                        <a href="{{asset('storage/'.$gallery->path)}}" class="mfp-link"><img src="{{asset('storage/'.$gallery->path)}}" alt="">
                        </a>
                    </div>
                </li>
            @endforeach

        </ul>

    </div>


</aside>
