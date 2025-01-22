@php
    $banner = \App\Models\Image::where('gallery_type', 'banner')->first();
@endphp

<div class="wt-bnr-inr overlay-wraper"
    @if ($banner) style="background-image:url({{ asset('storage/' . $banner->path) }}?t={{ time() }});" @ @endif>
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <h1 class="text-white">{{ $title }}</h1>
        </div>
    </div>
</div>
