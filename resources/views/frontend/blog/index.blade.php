@extends('layouts.app')

@section('content')
    <x-banner :title="$title"></x-banner>

    <div class="section-full p-t80 p-b50">
        <div class="container">
            <div class="row">

                <!-- LEFT PART START -->
                <div class="col-lg-8 col-md-12">
                    @yield('blog-content')
                </div>
                <!-- LEFT PART END -->

                <!-- SIDE BAR START -->
                <div class="col-lg-4 col-md-12">

                    @include('components.blog.aside')

                </div>
                <!-- SIDE BAR END -->

            </div>
        </div>
    </div>
@endsection
