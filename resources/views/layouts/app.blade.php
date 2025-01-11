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
    <link rel="icon" href="{{asset('assets')}}/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/favicon.png">

    <!-- PAGE TITLE HERE -->
    <title>Build Template | Home Page Style 2</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/fontawesome/css/font-awesome.min.css"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/flaticon.min.css"><!-- FLATICON STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/animate.min.css"><!-- ANIMATE STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/owl.carousel.min.css"><!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/bootstrap-select.min.css"><!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/magnific-popup.min.css"><!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/loader.min.css"><!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/style.css"><!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" class="skin" href="{{asset('assets')}}/css/skin/skin-1.css"><!-- THEME COLOR CHANGE STYLE SHEET -->

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/plugins/revolution/revolution/css/settings.css">
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/plugins/revolution/revolution/css/navigation.css">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,800italic,800,700italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet">

</head>

<body id="bg">

<div class="page-wraper">
    @include('layouts.header')
    <!-- CONTENT START -->
    <div class="page-content">

        @yield('content')

    </div>
    <!-- CONTENT END -->

    <!-- FOOTER START -->
    <footer class="site-footer footer-light">
        <!-- COLL-TO ACTION START -->
        <div class="call-to-action-wrap call-to-action-skew site-bg-primary bg-no-repeat" style="background-image:url(images/background/bg-4.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="call-to-action-left p-tb20 p-r50">
                            <h4 class="text-uppercase m-b10">We are ready to build your dream tell us more about your project</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-5">
                        <div class="call-to-action-right p-tb30">
                            <a href="contact-1.html" class="site-button-secondry  m-r15 text-uppercase font-weight-600">
                                Contact us  <i class="fa fa-angle-double-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER BLOCKES START -->
        <div class="footer-top overlay-wraper">
            <div class="overlay-main"></div>
            <div class="container">
                <div class="row">
                    <!-- ABOUT COMPANY -->
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_about">
                            <h4 class="widget-title">About Company</h4>
                            <div class="logo-footer clearfix p-b15">
                                <a href="index.html"><img src="{{asset('assets')}}/images/logo-dark.png" width="230" height="67" alt=""></a>
                            </div>
                            <p>Thewebmax ipsum dolor sit amet, interior adipiscing elit,
                                sed diam nonummy nibh is euismod tincidunt ut laoreet dolore agna aliquam erat .
                                wisi enim ad minim veniam, quis tation. sit amet, consec tetuer.
                                ipsum dolor sit amet, consectetuer adipiscing. ipsum dolor sit .
                            </p>
                        </div>
                    </div>
                    <!-- RESENT POST -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget recent-posts-entry-date">
                            <h4 class="widget-title">Resent Post</h4>
                            <div class="widget-post-bx">
                                <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                    <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                        <strong>20</strong>
                                        <span>Mar</span>
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title"><a href="blog-single.html">Blog title first </a></h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                    <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                        <strong>30</strong>
                                        <span>Mar</span>
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title"><a href="blog-single.html">Blog title first </a></h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 29</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                    <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                        <strong>31</strong>
                                        <span>Mar</span>
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title"><a href="blog-single.html">Blog title first </a></h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 30</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- USEFUL LINKS -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget_services">
                            <h4 class="widget-title">Useful links</h4>
                            <ul>
                                <li><a href="about-1.html">About</a></li>
                                <li><a href="faq-1.html">FAQ</a></li>
                                <li><a href="career.html">Career</a></li>
                                <li><a href="our-team.html">Our Team</a></li>
                                <li><a href="services.html">Services</a></li>
                                <li><a href="gallery-grid-1.html">Gallery</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- NEWSLETTER -->
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_newsletter">
                            <h4 class="widget-title">Newsletter</h4>
                            <div class="newsletter-bx">
                                <form role="search" method="post">
                                    <div class="input-group">
                                        <input name="news-letter" class="form-control" placeholder="ENTER YOUR EMAIL" type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" class="site-button"><i class="fa fa-paper-plane-o"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- SOCIAL LINKS -->
                        <div class="widget widget_social_inks">
                            <h4 class="widget-title">Social Links</h4>
                            <ul class="social-icons social-square social-darkest">
                                <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                            <div class="icon-md text-secondry">
                                <span class="iconmoon-travel"></span>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0">Address</h5>
                                <p>No.123 Chalingt Gates, Supper market New York</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix ">
                            <div class="icon-md text-secondry">
                                <span class="iconmoon-smartphone-1"></span>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0">Phone</h5>
                                <p class="m-b0">+41 555 888 9585</p>
                                <p>+41 555 888 9585</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                            <div class="icon-md text-secondry">
                                <span class="iconmoon-fax"></span>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0">Fax</h5>
                                <p class="m-b0">FAX: (123) 123-4567</p>
                                <p>FAX: (123) 123-4567</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                            <div class="icon-md text-secondry">
                                <span class="iconmoon-email"></span>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0">Email</h5>
                                <p class="m-b0">info@demo.com</p>
                                <p>info@demo1234.com</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- FOOTER COPYRIGHT -->
        <div class="footer-bottom overlay-wraper">
            <div class="overlay-main"></div>
            <div class="constrot-strip"></div>
            <div class="container p-t30">
                <div class="row">
                    <div class="wt-footer-bot-left">
                        <span class="copyrights-text">© 2023 Your Company. All Rights Reserved. Designed By thewebmax.</span>
                    </div>
                    <div class="wt-footer-bot-right">
                        <ul class="copyrights-nav pull-right">
                            <li><a href="javascript:void(0);">Terms  & Condition</a></li>
                            <li><a href="javascript:void(0);">Privacy Policy</a></li>
                            <li><a href="contact-1.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->


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
<script   src="{{asset('assets')}}/js/jquery-3.6.1.min.js"></script><!-- JQUERY.MIN JS -->
<script   src="{{asset('assets')}}/js/popper.min.js"></script><!-- POPPER.MIN JS -->
<script   src="{{asset('assets')}}/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script   src="{{asset('assets')}}/js/bootstrap-select.min.js"></script><!-- FORM JS -->
<script   src="{{asset('assets')}}/js/jquery.bootstrap-touchspin.min.js"></script><!-- FORM JS -->
<script   src="{{asset('assets')}}/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script   src="{{asset('assets')}}/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script   src="{{asset('assets')}}/js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script   src="{{asset('assets')}}/js/waypoints-sticky.min.js"></script><!-- COUNTERUP JS -->
<script   src="{{asset('assets')}}/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
<script   src="{{asset('assets')}}/js/imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
<script   src="{{asset('assets')}}/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
<script   src="{{asset('assets')}}/js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   -->
<script   src="{{asset('assets')}}/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script   src="{{asset('assets')}}/js/shortcode.js"></script><!-- SHORTCODE FUCTIONS  -->


<!-- SLIDER REVOLUTION -->
<script  src="{{asset('assets')}}/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
<script  src="{{asset('assets')}}/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script  src="{{asset('assets')}}/plugins/revolution/revolution/js/extensions/revolution-plugin.js"></script>

<!-- REVOLUTION SLIDER SCRIPT FILES -->
<script  src="{{asset('assets')}}/js/rev-script-2.js"></script>



</body>

</html>
