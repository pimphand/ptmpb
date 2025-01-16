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
        <button class="scroltop"><span class=" iconmoon-house relative" id="btn-vibrate"></span>Top</button>

    </div>


    <!-- LOADING AREA START ===== -->
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="loader">
                <span class="block-1"></span>
                <span class="block-2"></span>
                <span class="block-3"></span>
                <span class="block-4"></span>
                <span class="block-5"></span>
                <span class="block-6"></span>
                <span class="block-7"></span>
                <span class="block-8"></span>
                <span class="block-9"></span>
                <span class="block-10"></span>
                <span class="block-11"></span>
                <span class="block-12"></span>
                <span class="block-13"></span>
                <span class="block-14"></span>
                <span class="block-15"></span>
                <span class="block-16"></span>
            </div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->



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


    @stack('js')
</body>

</html>
