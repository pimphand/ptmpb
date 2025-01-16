@extends('layouts.app')

@section('content')
    <style>
        .category.active,
        .merk.active {
            font-weight: bold;
            color: #ffffff;
            background-color: rgb(24, 203, 54);
            /* Warna sesuai tema Anda */
            border-radius: 5px;
            padding: 2px 5px;
        }
    </style>

    <x-banner :title="$title"></x-banner>
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
                <li>Product</li>
            </ul>
        </div>
    </div>
    <div class="container mt-3">

        <div class="section-content">
            <div class="row">
                <!-- SIDE BAR START -->
                <div class="col-lg-4 col-md-12">

                    <aside class="side-bar">

                        <!-- 13. SEARCH -->
                        <div class="widget bg-white ">
                            <h4 class="widget-title">Search</h4>
                            <div class="search-bx">
                                <div class="input-group">
                                    <input name="news-letter" type="text" class="form-control search"
                                        placeholder="Write your text">
                                </div>

                            </div>
                            <button class="reset-filters mt-3 site-button-secondry">Reset Filters</button>
                        </div>

                        <div class="widget bg-white  widget_tag_cloud">
                            <h4 class="widget-title">Merek Produk</h4>
                            <div class="tagcloud">
                                @foreach ($merks as $merk)
                                    <a href="javascript:void(0);" class="merk"
                                        data-name="{{ $merk->name }}">{{ $merk->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- 12. TAGS -->
                        <div class="widget bg-white  widget_tag_cloud">
                            <h4 class="widget-title">Kategori</h4>
                            <div class="tagcloud">
                                @foreach ($categories as $category)
                                    <a href="javascript:void(0);" class="category"
                                        data-id="{{ $category->id }}">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>

                    </aside>

                </div>
                <!-- SIDE BAR END -->
                <div class="col-lg-8 col-md-12">
                    <!-- ADD BLOCK -->
                    {{-- <div class="tw-ad-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 m-b30">
                                <div class="wt-box pro-banner bg-cover" style="background-image: url(images/add/pic1.jpg);">
                                    <div class="pro-banner-disc p-a20 text-white">
                                        <h2 class="text-uppercase m-a0 m-b10">Best time to buy</h2>
                                        <h4 class="m-a0 m-b10">Our Product</h4>
                                        <h3 class="text-uppercase m-a0 m-b10">UP TO</h3>
                                        <h5 class="text-uppercase m-a0 m-b10">10% Cashback</h5>
                                        <a href="#" class="site-button ">ADD TO CART <i
                                                class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 m-b30">
                                <div class="wt-box pro-banner bg-cover" style="background-image: url(images/add/pic2.jpg);">
                                    <div class="pro-banner-disc p-a20 text-white">
                                        <h2 class="text-uppercase m-a0 m-b10">Best time to buy</h2>
                                        <h4 class="m-a0 m-b10">Our Product</h4>
                                        <h3 class="text-uppercase m-a0 m-b10">UP TO</h3>
                                        <h5 class="text-uppercase m-a0 m-b10">10% Cashback</h5>
                                        <a href="#" class="site-button ">ADD TO CART <i
                                                class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- ADD BLOCK -->

                    <!-- TITLE START -->
                    <div class="p-b10">
                        <h2 class="text-uppercase">Produk Kami</h2>
                        <div class="wt-separator-outer m-b30">
                            <div class="wt-separator style-square">
                                <span class="separator-left site-bg-primary"></span>
                                <span class="separator-right site-bg-primary"></span>
                            </div>
                        </div>
                    </div>
                    <!-- TITLE END -->

                    <div class="row" id="product-list"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Fungsi untuk menyimpan filter ke localStorage
        function saveFilters(filters) {
            localStorage.setItem('productFilters', JSON.stringify(filters));
        }

        // Fungsi untuk mengambil filter dari localStorage
        function getSavedFilters() {
            const savedFilters = localStorage.getItem('productFilters');
            return savedFilters ? JSON.parse(savedFilters) : {
                page: 1,
                search: '',
                category: '',
                merk: ''
            };
        }

        // Fungsi untuk mereset semua filter dan menghapus dari localStorage
        function resetFilters() {
            localStorage.removeItem('productFilters');
            getProducts(); // Panggil tanpa parameter untuk reset
        }

        // Fungsi utama untuk memuat produk
        function getProducts(page = 1, search = '', category = '', merk = '') {
            const filters = {
                page,
                search,
                category,
                merk
            };

            // Simpan filter saat memuat produk
            saveFilters(filters);

            // AJAX request untuk mengambil produk berdasarkan parameter
            $.ajax({
                type: "get",
                url: "{{ route('listProduct') }}?page=" + page + "&search=" + search + "&category=" + category +
                    "&merk=" + merk,
                success: function(response) {
                    // Menyisipkan respons ke elemen #product-list
                    $('#product-list').html(response);

                    // Ubah href menjadi data-url untuk pagination setelah memuat konten
                    $('#product-list .pagination a').each(function() {
                        const hrefValue = $(this).attr('href');
                        $(this).attr('data-url', hrefValue).removeAttr('href');
                    });

                    // Pasang event handler untuk klik pagination (dinamis)
                    $('#product-list .pagination a').off('click').on('click', function(e) {
                        e.preventDefault();
                        const url = $(this).data('url');
                        if (url) {
                            const params = new URLSearchParams(url.split('?')[1]);
                            const page = params.get('page') || 1;
                            const currentFilters = getSavedFilters();
                            getProducts(page, currentFilters.search, currentFilters.category,
                                currentFilters.merk);
                        }
                    });

                    // Pasang event handler untuk klik tombol "add_to_cart"
                    $('#product-list .add_to_cart').off('click').on('click', function(e) {
                        e.preventDefault();
                        const id = $(this).data('id');
                        const name = $(this).data('name');
                        const category = $(this).data('category');
                        const image = $(this).data('image');
                        const brand = $(this).data('product');
                        addToCart({
                            id,
                            name,
                            category,
                            image,
                            brand,
                            qty: 1
                        });
                    });
                }
            });
        }

        // Fungsi untuk memuat filter yang tersimpan saat halaman dimuat
        function loadFilters() {
            const savedFilters = getSavedFilters();
            $('.search').val(savedFilters.search); // Set nilai input pencarian
            getProducts(savedFilters.page, savedFilters.search, savedFilters.category, savedFilters.merk);
        }

        // Event handler untuk klik kategori
        $('.category').on('click', function() {
            const category = $(this).data('id');
            const currentFilters = getSavedFilters();

            if ($(this).hasClass('active')) {
                // Jika sudah aktif, hapus class dan reset kategori
                $(this).removeClass('active');
                getProducts(1, currentFilters.search, '', currentFilters.merk);
            } else {
                // Jika belum aktif, tambahkan class active
                $('.category').removeClass('active'); // Hapus class active dari elemen lainnya
                $(this).addClass('active'); // Tambahkan class active ke elemen yang diklik
                getProducts(1, currentFilters.search, category, currentFilters.merk);
            }
        });

        // Event handler untuk klik merk
        $('.merk').on('click', function() {
            const merk = $(this).data('name');
            const currentFilters = getSavedFilters();

            if ($(this).hasClass('active')) {
                // Jika sudah aktif, hapus class dan reset merek
                $(this).removeClass('active');
                getProducts(1, currentFilters.search, currentFilters.category, '');
            } else {
                // Jika belum aktif, tambahkan class active
                $('.merk').removeClass('active'); // Hapus class active dari elemen lainnya
                $(this).addClass('active'); // Tambahkan class active ke elemen yang diklik
                getProducts(1, currentFilters.search, currentFilters.category, merk);
            }
        });


        // Event handler untuk pencarian
        $('.search').on('keyup', function() {
            const search = $(this).val();
            const currentFilters = getSavedFilters();
            getProducts(1, search, currentFilters.category, currentFilters.merk);
        });

        // Event handler untuk reset filter
        $('.reset-filters').on('click', function() {
            resetFilters();
        });

        // Muat filter yang tersimpan saat halaman di-load
        $(document).ready(function() {
            loadFilters();
        });
    </script>
@endpush
