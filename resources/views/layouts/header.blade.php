<!-- HEADER START -->
<header class="site-header header-style-1 mobile-sider-drawer-menu">
    <div class="top-bar bg-secondry">
        <div class="container">
            <div class="wt-topbar-right">
                <ul class="list-unstyled e-p-bx">
                    <li><i class="fa fa-envelope"></i>mail@thewebmax.com</li>
                    <li><i class="fa fa-phone"></i>(654) 321-7654</li>
                </ul>
                <ul class="social-bx list-inline">
                    <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                    <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                    <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                    <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>
                    <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>
                    <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                    <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="sticky-header main-bar-wraper">
        <div class="main-bar bg-white">
            <div class="container">
                <div class="logo-header">
                    <a href="/">
                        <img src="{{asset('logo.png')}}" width="171" height="49" alt="" >
                    </a>
                </div>

                <!-- MAIN Vav -->
                <div class="header-nav navbar-collapse collapse ">
                    <ul class=" nav navbar-nav">
                        <li class="">
                            <a href="/">{{__('app.home')}}</a>
                        </li>

                        <li class="{{request()->routeIs('about_us') ? 'active' : ''}}">
                            <a href="{{route('about_us')}}">{{__('app.about_us')}}</a>
                        </li>

                        <li>
                            <a href="javascript:;">{{__('app.product')}}</a>

                        </li>

                        <li>
                            <a href="javascript:;">{{__('app.testimonials')}}</a>
                        </li>

                        <li class="submenu-direction">
                            <a href="javascript:;">{{__('app.blog')}}</a>

                        </li>
                        <li class="submenu-direction">
                            <a href="javascript:;">{{__('app.gallery')}}</a>

                        </li>
                        <li class="has-mega-menu ">
                            <a href="javascript:;">{{__('app.contact_us')}}</a>
                        </li>
                    </ul>
                </div>


                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>
                <!-- SITE Search -->
                <div id="search">
                    <span class="close"></span>
                    <form role="search" id="searchform" action="/search" method="get" class="radius-xl">
                        <div class="input-group">
                            <input value="" name="q" type="search" placeholder="Type to search">
                            <span class="input-group-btn"><button type="button" class="search-btn"><i class="fa fa-search"></i></button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER END -->
