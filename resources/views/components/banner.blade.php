<div class="wt-bnr-inr overlay-wraper"
    @if ($banner) style="background-image:url({{ asset('storage/' . $banner->path) }});" @ @endif>
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <h1 class="text-white">{{ $title }}</h1>
        </div>
    </div>
</div>
