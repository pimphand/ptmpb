@extends('layouts.app')

@section('content')
    <x-banner></x-banner>
    <div class="container">
        <div class="filter-wrap p-tb15">
            <ul class="masonry-filter link-style  text-uppercase">
                <li class=""><a data-filter="*" href="#">All</a></li>
                <li class=""><a data-filter=".cat-1" href="#">House</a></li>
                <li class=""><a data-filter=".cat-2" href="#">Building</a></li>
                <li class=""><a data-filter=".cat-3" href="#">Office</a></li>
                <li class=""><a data-filter=".cat-4" href="#">Garden</a></li>
                <li class="active"><a data-filter=".cat-5" href="#">Interior</a></li>
            </ul>
        </div>

        <div class="portfolio-wrap mfp-gallery no-col-gap row" style="position: relative; height: 388.666px;">
            <!-- COLUMNS 1 -->
            @foreach($galleries as $gallery)
                <div class="masonry-item cat-1 col-lg-3 col-md-3 col-sm-6 col-xs-6" style="position: absolute; left: 0px; top: 0px;">
                    <div class="wt-gallery-bx p-a15">
                        <div class="wt-thum-bx wt-img-overlay5 wt-img-effect blurr">
                            <a href="{{$gallery->url ?? 'javascript:void(0)'}}">
                                <img src="{{asset('storage/'.$gallery->path)}}" alt="">
                            </a>
                            <div class="overlay-bx">
                                <div class="overlay-icon">
                                    @if($gallery->url)
                                        <a href="{{$gallery->url}}">
                                            <i class="fa fa-external-link wt-icon-box-xs"></i>
                                        </a>
                                    @endif
                                    <a href="{{asset('storage/'.$gallery->path)}}" class="mfp-link">
                                        <i class="fa fa-arrows-alt wt-icon-box-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
