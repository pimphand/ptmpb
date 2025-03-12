<aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
    <ul class="menu-inner">
        <li class="menu-title small text-uppercase">
            <span class="menu-title-text">MAIN</span>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">dashboard</span>
                <span class="title">{{ __('app.dashboard') }}</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('admin.report') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">report</span>
                <span class="title">Report</span>
            </a>
        </li>

        <li class="menu-title small text-uppercase">
            <span class="menu-title-text">Master</span>
        </li>

        @permission(['products-read'])
        <li class="menu-item">
            <a href="{{ route('admin.brands.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">space_dashboard</span>
                <span class="title">Brand</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">widgets</span>
                <span class="title">{{ __('app.categories') }} {{ __('app.product') }}</span>
            </a>
        </li>
        @endpermission

        @permission('products-read')
        <li class="menu-item">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">featured_video</span>
                <span class="title">{{ __('app.product') }}</span>
            </a>
        </li>
        @endpermission

        @permission('blog-categories-read')
        <li class="menu-item">
            <a href="{{ route('admin.blog-categories.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">widgets</span>
                <span class="title">{{ __('app.categories') }} {{ __('app.blog') }}</span>
            </a>
        </li>
        @endpermission

        @permission('blog-read')
        <li class="menu-item">
            <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">auto_stories</span>
                <span class="title">{{ __('app.blog') }}</span>
            </a>
        </li>
        @endpermission

        @permission('order-read')
        <li class="menu-item">
            <a href="{{ route('admin.orders.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">shopping_cart</span>
                <span class="title">Order </span>
                <span class="count" style="display: none"></span>
            </a>
        </li>
        @endpermission

        @permission('users-read')
        <li class="menu-item">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">account_circle</span>
                <span class="title">User</span>
            </a>
        </li>
        @endpermission

        @role(['developer', 'admin'])
        <li class="menu-item">
            <a href="{{ route('admin.sales.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">account_circle</span>
                <span class="title">Sales</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.customers.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">account_circle</span>
                <span class="title">Customer</span>
            </a>
        </li>
        @endpermission

        @role('developer')
        <li class="menu-item">
            <a href="/laratrust/roles-assignment" class="menu-link">
                <span class="material-symbols-outlined menu-icon">lock</span>
                <span class="title">Role & Permission</span>
            </a>
        </li>
        @endrole

        @role(['developer', 'admin'])
        <li class="menu-title small text-uppercase">
            <span class="menu-title-text">{{ __('app.company') }}</span>
        </li>

        <li class="menu-item">
            <a href="{{ route('admin.about-us.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">real_estate_agent</span>
                <span class="title">{{ __('app.about_us') }}</span>
            </a>
        </li>

        {{--            <li class="menu-item">--}}
        {{--                <a href="{{ route('admin.messages.index') }}" class="menu-link">--}}
        {{--                    <span class="material-symbols-outlined menu-icon">handshake</span>--}}
        {{--                    <span class="title">Pesan</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        <li class="menu-item">
            <a href="{{ route('admin.contact.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">map</span>
                <span class="title">Kontak</span>
            </a>
        </li>
        @endrole
        @permission('gallery-read')
        <li class="menu-item">
            <a href="{{ route('admin.galleries.index') }}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">gallery_thumbnail</span>
                <span class="title">{{ __('app.gallery') }}</span>
            </a>
        </li>
        @endpermission

        <li class="menu-item">
            <button href="javascript:void(0)" class="menu-link logout btn btn-info ">
                <span class="material-symbols-outlined menu-icon">logout</span>
                <span class="title">Logout</span>
            </button>
        </li>
    </ul>
</aside>
