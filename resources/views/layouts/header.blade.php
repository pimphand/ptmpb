<!-- HEADER START -->
<header class="site-header header-style-1 mobile-sider-drawer-menu">
    <div class="top-bar text-white" style="background-color: #fff;">
        <div class="container">
            <div class="wt-topbar-right">

            </div>
        </div>
    </div>
    <div class="sticky-header main-bar-wraper">
        <div class="main-bar bg-white">
            <div class="container">
                <div class="logo-header">
                    <a href="/">
                        <img src="{{ asset('logo_.png') }}" width="171" height="49" alt="">
                    </a>
                </div>

                <!-- MAIN Vav -->
                <div class="header-nav navbar-collapse collapse ">
                    <ul class=" nav navbar-nav">
                        <li class="{{ request()->routeIs(['home']) ? 'active' : '' }}">
                            <a href="/">{{ __('app.home') }}</a>
                        </li>

                        <li class="{{ request()->routeIs('about_us') ? 'active' : '' }}">
                            <a href="{{ route('about_us') }}">{{ __('app.about_us') }}</a>
                        </li>

                        <li class="{{ request()->routeIs(['products', 'product']) ? 'active' : '' }}">
                            <a href="{{ route('products') }}">{{ __('app.product') }}</a>
                        </li>

                        <li class="{{ request()->routeIs(['blogs', 'blog']) ? 'active' : '' }}">
                            <a href="{{ route('blogs') }}">{{ __('app.blog') }}</a>
                        </li>
                        <li class="{{ request()->routeIs(['gallery']) ? 'active' : '' }}">
                            <a href="{{route('gallery')}}">{{ __('app.gallery') }}</a>
                        </li>
                        <li class="{{ request()->routeIs(['contact']) ? 'active' : '' }}">
                            <a href="{{route('contact')}}">{{ __('app.contact_us') }}</a>
                        </li>
                    </ul>
                </div>


                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button"
                    class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>
                <!-- SITE Search -->
                <div class="extra-nav">
                    <div class="extra-cell"></div>
                    <div class="extra-cell">
                        <a href="javascript:;" class="wt-cart cart-btn dropdown-toggle" title="Your Cart"
                            id="ID-MSG_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="link-inner">
                                <span class="woo-cart-total"> </span>
                                <span class="woo-cart-count">
                                    <span class="shopping-bag wcmenucart-count">0</span>
                                </span>
                            </span>
                        </a>

                        <div class="dropdown-menu cart-dropdown-item-wraper" style="">
                            <div class="nav-cart-content">

                                <div class="nav-cart-items p-a15" id="listCart">

                                </div>

                                <div class="nav-cart-action p-a15 clearfix">
                                    <a class="site-button btn-block" style="width: 100%;"
                                        href="{{ route('checkout') }}" type="button">Checkout</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER END -->
