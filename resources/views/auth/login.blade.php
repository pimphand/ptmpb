<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/simplebar.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/apexcharts.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/prism.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/rangeslider.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/quill.snow.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/google-icon.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/remixicon.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/fullcalendar.main.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/jsvectormap.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/lightpick.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('admin')}}/assets/images/favicon.png">
    <!-- Title -->
    <title>{{env('APP_NAME')}}</title>
</head>
<body class="boxed-size bg-white">
<!-- Start Preloader Area -->
<div class="preloader" id="preloader">
    <div class="preloader">
        <div class="waviy position-relative">
            <span class="d-inline-block">T</span>
            <span class="d-inline-block">R</span>
            <span class="d-inline-block">E</span>
            <span class="d-inline-block">Z</span>
            <span class="d-inline-block">O</span>
        </div>
    </div>
</div>
<!-- End Preloader Area -->

<!-- Start Main Content Area -->
<div class="container">
    <div class="main-content d-flex flex-column p-0">
        <div class="m-auto m-1230">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{asset('admin')}}/assets/images/login.jpg" class="rounded-3" alt="login">
                </div>
                <div class="col-lg-6">
                    <div class="mw-480 ms-lg-auto">
                        <div class="d-inline-block mb-4">
                            <img src="{{asset('logo.png')}}" class="rounded-3 for-light-logo" alt="login">
                            <img src="{{asset('logo.png')}}" class="rounded-3 for-dark-logo" alt="login">
                        </div>
                        <h3 class="fs-28 mb-2">Selamat Datang di {{env('APP_NAME')}}</h3>

                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Email</label>
                                <input name="email" type="email" class="form-control h-55"
                                       placeholder="example@mandalikaputrabersama.com">
                                @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Password</label>
                                <input name="password" type="password" class="form-control h-55" placeholder="Type password">
                                @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <button href="javascript:void(0)" class="btn btn-primary fw-medium py-2 px-3 w-100">
                                    <div class="d-flex align-items-center justify-content-center py-1">
                                        <i class="material-symbols-outlined text-white fs-20 me-2">login</i>
                                        <span>Login</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Link Of JS File -->
<script src="{{asset('admin')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('admin')}}/assets/js/sidebar-menu.js"></script>
<script src="{{asset('admin')}}/assets/js/dragdrop.js"></script>
<script src="{{asset('admin')}}/assets/js/rangeslider.min.js"></script>
<script src="{{asset('admin')}}/assets/js/quill.min.js"></script>
<script src="{{asset('admin')}}/assets/js/data-table.js"></script>
<script src="{{asset('admin')}}/assets/js/prism.js"></script>
<script src="{{asset('admin')}}/assets/js/clipboard.min.js"></script>
<script src="{{asset('admin')}}/assets/js/feather.min.js"></script>
<script src="{{asset('admin')}}/assets/js/simplebar.min.js"></script>
<script src="{{asset('admin')}}/assets/js/apexcharts.min.js"></script>
<script src="{{asset('admin')}}/assets/js/echarts.js"></script>
<script src="{{asset('admin')}}/assets/js/swiper-bundle.min.js"></script>
<script src="{{asset('admin')}}/assets/js/fullcalendar.main.js"></script>
<script src="{{asset('admin')}}/assets/js/jsvectormap.min.js"></script>
<script src="{{asset('admin')}}/assets/js/world-merc.js"></script>
<script src="{{asset('admin')}}/assets/js/moment.min.js"></script>
<script src="{{asset('admin')}}/assets/js/lightpick.js"></script>
<script src="{{asset('admin')}}/assets/js/custom/apexcharts.js"></script>
<script src="{{asset('admin')}}/assets/js/custom/echarts.js"></script>
<script src="{{asset('admin')}}/assets/js/custom/custom.js"></script>

<script>
    $(document).ready(function () {
        $('.btn-primary').click(function () {
            window.location.href = "{{route('admin.dashboard')}}";
        });
    });
</script>
</body>
</html>
