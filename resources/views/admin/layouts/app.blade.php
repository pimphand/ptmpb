<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/sidebar-menu.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/simplebar.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/apexcharts.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/prism.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/rangeslider.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/quill.snow.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/google-icon.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/remixicon.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/fullcalendar.main.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/jsvectormap.min.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/lightpick.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('admin/assets')}}/images/favicon.png">
    <!-- Title -->
    <title>{{env('APP_NAME')}} - {{$title ?? "Dashboard"}}</title>

    @stack('css')
</head>
<body class="boxed-size">
<!-- Start Preloader Area -->
{{--<div class="preloader" id="preloader">--}}
{{--    <div class="preloader">--}}
{{--        <div class="waviy position-relative">--}}
{{--            <span class="d-inline-block">P</span>--}}
{{--            <span class="d-inline-block">T</span>--}}
{{--            <span class="d-inline-block">E</span>--}}
{{--            <span class="d-inline-block">Z</span>--}}
{{--            <span class="d-inline-block">O</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- End Preloader Area -->

<!-- Start Sidebar Area -->
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="index.html" class="d-block text-decoration-none position-relative">
            <img src="{{asset('admin/assets')}}/images/logo-icon.png" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">{{env('APP_NAME')}}</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    @include('admin.layouts.sidebar')
</div>
<!-- End Sidebar Area -->

<!-- Start Main Content Area -->
<div class="container-fluid">
    <div class="main-content d-flex flex-column">
        <!-- Start Header Area -->
        @include('admin.layouts.header')
        <!-- End Header Area -->

        <div class="main-content-container overflow-hidden">
            @yield('content')
        </div>

        <div class="flex-grow-1"></div>

        <!-- Start Footer Area -->
        <footer class="footer-area bg-white text-center rounded-top-7">
            <p class="fs-14">© <span class="text-primary-div">Trezo</span> is Proudly Owned by <a href="https://envytheme.com/" target="_blank" class="text-decoration-none text-primary">EnvyTheme</a></p>
        </footer>
        <!-- End Footer Area -->
    </div>
</div>
<!-- Start Main Content Area -->

<!-- Link Of JS File -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{asset('admin/assets')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('admin/assets')}}/js/sidebar-menu.js"></script>
<script src="{{asset('admin/assets')}}/js/quill.min.js"></script>
<script src="{{asset('admin/assets')}}/js/prism.js"></script>
<script src="{{asset('admin/assets')}}/js/clipboard.min.js"></script>
<script src="{{asset('admin/assets')}}/js/feather.min.js"></script>
<script src="{{asset('admin/assets')}}/js/simplebar.min.js"></script>
<script src="{{asset('admin/assets')}}/js/swiper-bundle.min.js"></script>
<script src="{{asset('admin/assets')}}/js/moment.min.js"></script>
<script src="{{asset('admin/assets')}}/js/lightpick.js"></script>
{{--<script src="{{asset('admin/assets')}}/js/custom/custom.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var currentUrl = window.location.href;
        $('.menu-item a').each(function() {
            var linkUrl = $(this).attr('href');
            if (linkUrl === currentUrl) {
                $(this).addClass('active');
                $(this).closest('.menu-item').addClass('open');
            }
        });
    });

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

    function formSendData() {
        let formData = new FormData($('#form')[0]);

        //add if format has id
        if ($('[name="id"]').val()) {
            formData.append('_method', 'PUT');
        }

        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: $('#form').attr('action'),
            type: "POST",
            data: formData,
            processData: false, // Jangan memproses data
            contentType: false, // Jangan set tipe konten
            success: function(response) {
                $('#staticBackdrop').modal('hide');
                $('#form')[0].reset();
                getData()
                Toast.fire({
                    icon: "success",
                    title: response.message
                });
            },
            error: function(error) {
                let errors = error.responseJSON.errors;
                // Loop untuk menampilkan pesan error
                $.each(errors, function(key, value) {
                    $(`[name="${key}"]`).addClass('is-invalid');
                    $(`[name="${key}"]`).after(
                        `<span class="error-message text-danger">${value[0]}</span>`
                    );
                });
            }
        });
    }

    function deleteData(url,name='') {
        Swal.fire({
            title: "Apakah Anda Yakin menghapus? " + name,
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        getData();
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });
                    },
                    error: function(error) {
                        Toast.fire({
                            icon: "error",
                            title: error.responseJSON.message
                        });
                    }
                });
            }
        });
    }

    function deleteDataNoRedirect(url,name='') {
        Swal.fire({
            title: "Apakah Anda Yakin menghapus? " + name,
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });
                    },
                    error: function(error) {
                        Toast.fire({
                            icon: "error",
                            title: error.responseJSON.message
                        });
                    }
                });
            }
        });
    }
</script>
@stack('js')
</body>
</html>
