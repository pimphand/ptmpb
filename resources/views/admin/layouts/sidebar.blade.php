<aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
    <ul class="menu-inner">
        <li class="menu-title small text-uppercase">
            <span class="menu-title-text">MAIN</span>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">dashboard</span>
                <span class="title">{{__('app.dashboard')}}</span>
            </a>

        </li>

        <li class="menu-title small text-uppercase">
            <span class="menu-title-text">Master</span>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.categories.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">widgets</span>
                <span class="title">{{__('app.categories')}} {{__('app.product')}}</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.products.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">featured_video</span>
                <span class="title">{{__('app.product')}}</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.blog-categories.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">widgets</span>
                <span class="title">{{__('app.categories')}} {{__('app.blog')}}</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.blogs.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">auto_stories</span>
                <span class="title">{{__('app.blog')}}</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.orders.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">shopping_cart</span>
                <span class="title">Order</span>
            </a>
        </li>

        <li class="menu-title small text-uppercase">
            <span class="menu-title-text">{{__('app.company')}}</span>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.about-us.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">real_estate_agent</span>
                <span class="title">{{__('app.about_us')}}</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.messages.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">handshake</span>
                <span class="title">Pesan</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.galleries.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">gallery_thumbnail</span>
                <span class="title">{{__('app.gallery')}}</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.contact.index')}}" class="menu-link">
                <span class="material-symbols-outlined menu-icon">map</span>
                <span class="title">Kontak</span>
            </a>
        </li>

        <li class="menu-item">
            <button href="javascript:void(0)" class="menu-link logout btn btn-info ">
                <span class="material-symbols-outlined menu-icon">logout</span>
                <span class="title">Logout</span>
            </button>
        </li>
    </ul>
</aside>
