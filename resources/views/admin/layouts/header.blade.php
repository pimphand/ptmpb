<header class="header-area bg-white mb-4 rounded-bottom-15" id="header-area">
    <div class="row align-items-center">
        <div class="col-lg-4 col-sm-6">
            <div class="left-header-content">
                <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">

                </ul>
            </div>
        </div>

        <div class="col-lg-8 col-sm-6">
            <div class="right-header-content mt-2 mt-sm-0">
                <ul class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">

                    <li class="header-right-item">
                        <div class="dropdown admin-profile">
                            <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor" data-bs-toggle="dropdown">
                                <div class="flex-shrink-0">
                                    <img class="rounded-circle wh-40 administrator" src="{{asset('admin/assets')}}/images/administrator.jpg" alt="admin">
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-none d-xxl-block">
                                            <div class="d-flex align-content-center">
                                                <h3>{{auth()->user()->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                <div class="d-flex align-items-center info">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-circle wh-30 administrator" src="{{asset('admin/assets')}}/images/administrator.jpg" alt="admin">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h3 class="fw-medium">{{auth()->user()->name}}</h3>
                                        <span class="fs-12">{{auth()->user()->roles[0]->display_name}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
