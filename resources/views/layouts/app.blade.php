<!DOCTYPE html>

<html lang="en">

<head>

    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="description" content="">

    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">

    <!-- PAGE TITLE HERE -->
    <title>{{ env('APP_NAME') }} - {{ $title ?? 'Halaman Utama' }}</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/fontawesome/css/font-awesome.min.css">
    <!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/flaticon.min.css">
    <!-- FLATICON STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/animate.min.css"><!-- ANIMATE STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/owl.carousel.min.css">
    <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap-select.min.css">
    <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/magnific-popup.min.css">
    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/loader.min.css"><!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css"><!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" class="skin" href="{{ asset('assets') }}/css/skin/skin-1.css">
    <!-- THEME COLOR CHANGE STYLE SHEET -->

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/plugins/revolution/revolution/css/settings.css">
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/plugins/revolution/revolution/css/navigation.css">

    <!-- GOOGLE FONTS -->
    <link
        href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic,400italic,500,500italic,700,700italic,900italic,900'
        rel='stylesheet' type='text/css'>
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,800italic,800,700italic'
        rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet">
    <style>
        #listCart {
            max-height: 400px;
            /* Sesuaikan tinggi yang diinginkan */
            overflow-y: auto;
            /* Membuat scroll vertikal */
            padding-right: 10px;
            /* Menambahkan ruang untuk scrollbar */
        }

        .pagination-1 {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
        }

        .pagination-1 li {
            margin: 0 5px;
        }

        .pagination-1 li a,
        .pagination-1 li span {
            display: block;
            padding: 5px 10px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
        }

        .pagination-1 li.active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination-1 li.disabled span {
            color: #999;
            pointer-events: none;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px; /* Jarak dari bawah */
            right: 20px; /* Jarak dari kanan */
            z-index: 1000; /* Pastikan tombol berada di atas elemen lain */
            background-color: #25d366; /* Warna hijau khas WhatsApp */
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .whatsapp-button img {
            width: 40px;
            height: 40px;
        }

        .whatsapp-button:hover {
            transform: scale(1.1); /* Sedikit pembesaran saat hover */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

    </style>

</head>

<body id="bg">

    <div class="page-wraper">
        @include('layouts.header')
        <!-- CONTENT START -->
        <div class="page-content">

            @yield('content')

        </div>
        <!-- CONTENT END -->

        <x-footer></x-footer>
        <!-- SCROLL TOP BUTTON -->

    </div>

    <!-- JAVASCRIPT  FILES ========================================= -->
    <script src="{{ asset('assets') }}/js/jquery-3.6.1.min.js"></script><!-- JQUERY.MIN JS -->
    <script src="{{ asset('assets') }}/js/popper.min.js"></script><!-- POPPER.MIN JS -->
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
    <script src="{{ asset('assets') }}/js/bootstrap-select.min.js"></script><!-- FORM JS -->
    <script src="{{ asset('assets') }}/js/jquery.bootstrap-touchspin.min.js"></script><!-- FORM JS -->
    <script src="{{ asset('assets') }}/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
    <script src="{{ asset('assets') }}/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
    <script src="{{ asset('assets') }}/js/counterup.min.js"></script><!-- COUNTERUP JS -->
    <script src="{{ asset('assets') }}/js/waypoints-sticky.min.js"></script><!-- COUNTERUP JS -->
    <script src="{{ asset('assets') }}/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
    <script src="{{ asset('assets') }}/js/imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
    <script src="{{ asset('assets') }}/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
    <script src="{{ asset('assets') }}/js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   -->
    <script src="{{ asset('assets') }}/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
    <script src="{{ asset('assets') }}/js/shortcode.js"></script><!-- SHORTCODE FUCTIONS  -->


    <!-- SLIDER REVOLUTION -->
    <script src="{{ asset('assets') }}/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/revolution/revolution/js/extensions/revolution-plugin.js"></script>

    <!-- REVOLUTION SLIDER SCRIPT FILES -->
    <script src="{{ asset('assets') }}/js/rev-script-2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        const cartKey = "shoppingCart";

        // Fungsi untuk mengambil keranjang belanja dari localStorage
        function getCart() {
            const cart = localStorage.getItem(cartKey);
            return cart ? JSON.parse(cart) : [];
        }

        // Fungsi untuk menampilkan keranjang belanja di halaman
        function renderCart() {
            const cart = getCart();
            const $listCart = $("#listCart");
            $listCart.empty();

            let totalQty = 0;

            cart.forEach((item) => {
                totalQty += item.qty;

                $listCart.append(`
                <div class="nav-cart-item clearfix" data-id="${item.id}">
                    <div class="nav-cart-item-image">
                        <a href="#"><img src="${item.image}" alt="${item.name}"></a>
                    </div>
                    <div class="nav-cart-item-desc">
                        <a href="#">${item.name}</a>
                        <div>Merk: ${item.brand}</div>
                        <div>Kategori: ${item.category}</div>
                        <button class="delete-item btn btn-danger btn-sm" style="width:100%;">Hapus</button>
                    </div>
                </div>
            `);
            });

            $(".wcmenucart-count").text(cart.length);
        }

        // Pasang event listener untuk tombol hapus
        $(".delete-item").on("click", function() {
            const id = $(this).closest(".nav-cart-item").data("id");
            deleteCartItem(id);
        });

        function deleteCartItem(id) {
            let cart = getCart();
            cart = cart.filter((item) => item.id !== id);
            saveCart(cart);
            renderCart();
        }

        function saveCart(cart) {
            localStorage.setItem(cartKey, JSON.stringify(cart));
        }

        // Fungsi untuk menambahkan item ke keranjang
        function addToCart(item) {
            const cart = getCart();
            const existingItem = cart.find((cartItem) => cartItem.id === item.id);

            if (existingItem) {
                // Jika item sudah ada, tambahkan qty
                existingItem.qty += item.qty;
            } else {
                // Jika item belum ada, tambahkan ke keranjang
                cart.push(item);
            }

            saveCart(cart);
            renderCart();

            Toast.fire({
                icon: "success",
                title: "Data berhasil disimpan"
            });
        }

        // Render keranjang belanja saat halaman dimuat
        renderCart();
    </script>

    @stack('js')

</body>

</html>
