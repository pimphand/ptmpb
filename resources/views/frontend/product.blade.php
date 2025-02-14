@extends('layouts.app')
@section('content')
    <x-banner :title="$title"></x-banner>
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{ route('products') }}">Produk</a></li>
                <li>{{ $product->name }}</li>
                <li>{{ $sku->name }}</li>
            </ul>
        </div>
    </div>
    <div class="section-full p-t80 p-b50">
        <!-- PRODUCT DETAILS -->
        <div class="container woo-entry">
            <div class="row m-b30">
                <div class="col-lg-4 col-md-8 m-b30">
                    <div class="wt-box wt-product-gallery on-show-slider">
                        <div id="sync1" class="owl-carousel owl-theme owl-btn-vertical-center m-b5 owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transition: all; width: 280px;">

                                    <img src="{{ asset('storage/' . $sku->image?->path) }}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="wt-post-title ">
                        <h3 class="post-title"><a href="javascript:void(0);">{{ $sku->product->name }}</a></h3>
                    </div>
                    <h2 class="m-tb10">{{ $sku->name }}</h2>

                    <a class="btn btn-primary site-button-secondry pull-left m-r10" id="order_now">
                        <i class="fa fa-shopping-bag"></i> Beli Sekarang
                    </a>
                    <button class="btn btn-primary site-button pull-left m-r10"><i class="fa fa-cart-plus"></i> Tambah Ke
                        Keranjang
                    </button>
                    @if ($sku->product->file)
                        <a href="{{ asset('storage/' . $sku->product->file) }}"target="_blank"
                            class="btn btn-warning site-button pull-left" style="background-color: #ce2827;"><i
                                class="fa fa-download"></i> Download Katalog
                        </a>
                    @endif
                </div>
            </div>


            <!-- TABS CONTENT START -->
            <div class="row">
                <div class="col-md-12 p-b30">
                    <div class="wt-tabs border border-top bg-tabs">
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#graphic-design-19" aria-selected="false"
                                    tabindex="-1" role="tab">Spesifikasi</a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div id="graphic-design-19" class="tab-pane active" role="tabpanel">
                                <table class="table table-bordered table-striped m-b0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Deskripsi</strong></td>
                                            <td>
                                                <div class="p-a10 text-justify">
                                                    {{ $sku->description }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Minimal Order</strong></td>
                                            <td>{{ $sku->application ?? '-' }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td><strong>Berat</strong></td>
                                            <td>{{ $sku->weight ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lebar</strong></td>
                                            <td>{{ $sku->width ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Panjang</strong></td>
                                            <td>{{ $sku->height ?? '-' }}</td>
                                        </tr> --}}
                                        <tr>
                                            <td><strong>Kemasan</strong></td>
                                            <td>{{ $sku->packaging ?? '-' }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABS CONTENT START -->
            <!-- TITLE START -->
            <div class="p-b10">
                <h2 class="text-uppercase">Realated products</h2>
                <div class="wt-separator-outer  m-b30">
                    <div class="wt-separator style-square">
                        <span class="separator-left site-bg-primary"></span>
                        <span class="separator-right site-bg-primary"></span>
                    </div>
                </div>
            </div>
            <!-- TITLE END -->

            <div class="row m-b30">
                @foreach ($relateds as $related)
                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30">
                        <div class="wt-box wt-product-box">
                            <div class="wt-thum-bx wt-img-overlay1 wt-img-effect zoom">
                                <img src="{{ asset('storage/' . $related?->image?->path) }}" alt="">
                                <div class="overlay-bx">
                                    <div class="overlay-icon">
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-cart-plus wt-icon-box-xs"></i>
                                        </a>
                                        <a class="mfp-link" href="javascript:void(0);">
                                            <i class="fa fa-heart wt-icon-box-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-info  text-center">
                                <div class="p-a10 bg-white">
                                    <h4 class="wt-title">
                                        <a href="javascript:;">{{ $related->name }}</a>
                                    </h4>
                                    <span class="price">
                                        {{ $related->product->name }} <br>
                                        {{ $related->product->category->name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- PRODUCT DETAILS -->

    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#order_now').click(function() {
                // Ambil elemen tombol WhatsApp
                let whatsappButton = $('.whatsapp-button');

                // Ambil URL dari href
                let currentHref = whatsappButton.attr('href');

                // Informasi kategori, produk, dan merek
                let category = encodeURIComponent("Kategori: {{ $sku->product->category->name }}");
                let product = encodeURIComponent("Produk: {{ $sku->name }}");
                let brand = encodeURIComponent("Merek: {{ $sku->product->name }}");
                let greeting = encodeURIComponent("Halo kak, saya mau order");

                // Gabungkan semua teks ke dalam pesan baru
                let newMessage = `${greeting}%0A${category}%0A${product}%0A${brand}`;

                // Ganti teks dalam URL (pastikan format sesuai dengan struktur awal)
                let newHref = currentHref.replace(/(text=).*$/, `text=${newMessage}`);

                // Set ulang href tombol WhatsApp
                whatsappButton.attr('href', newHref);

                // Simulasikan klik pada tombol WhatsApp
                whatsappButton[0].click();
            });

        });
    </script>
@endpush
