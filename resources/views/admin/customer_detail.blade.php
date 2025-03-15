@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">My Profile</h3>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">My Profile</span>
                </li>
            </ol>
        </nav>
    </div>
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-lg-6">--}}
{{--            <div class="card bg-primary border-0 rounded-3 welcome-box style-two mb-4 position-relative">--}}
{{--                <div class="card-body py-38 px-4">--}}
{{--                    <div class="mb-5">--}}
{{--                        <h3 class="text-white fw-semibold">Selamat Datang, <span--}}
{{--                                class="text-danger-div">{{ $customer->name }}</span></h3>--}}
{{--                    </div>--}}

{{--                    <div class="d-flex align-items-center flex-wrap gap-4 gap-xxl-5">--}}

{{--                        <div class="d-flex align-items-center welcome-status-item style-two">--}}
{{--                            <div class="flex-shrink-0">--}}
{{--                                <i class="material-symbols-outlined">Target</i>--}}
{{--                            </div>--}}
{{--                            <div class="flex-grow-1 ms-3">--}}
{{--                                <h5 class="text-white fw-semibold mb-0 fs-16">--}}
{{--                                    Rp.{{ number_format($customer->target_sales) }}</h5>--}}
{{--                                <p class="text-light">Target Penjualan</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="d-flex align-items-center welcome-status-item style-two">--}}
{{--                            <div class="flex-shrink-0">--}}
{{--                                <i class="material-symbols-outlined icon-bg two">local_library</i>--}}
{{--                            </div>--}}
{{--                            <div class="flex-grow-1 ms-3">--}}
{{--                                <h5 class="text-white fw-semibold mb-0 fs-16">Rp.{{ number_format($order->total ?? 0) }}--}}
{{--                                </h5>--}}
{{--                                <p class="text-light">Sedang Berjalan</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="d-flex align-items-center welcome-status-item style-two">--}}
{{--                            <div class="flex-shrink-0">--}}
{{--                                <i class="material-symbols-outlined icon-bg two">local_library</i>--}}
{{--                            </div>--}}
{{--                            <div class="flex-grow-1 ms-3">--}}
{{--                                <h5 class="text-white fw-semibold mb-0 fs-16">--}}

{{--                                    %--}}
{{--                                </h5>--}}
{{--                                <p class="text-light">Pencapaian</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-6">--}}
{{--            <div class="row justify-content-center">--}}
{{--                @php--}}
{{--                    $statusColors = [--}}
{{--                        'pending' => 'primary',--}}
{{--                        'process' => 'warning',--}}
{{--                        'success' => 'success',--}}
{{--                        'cancel' => 'danger',--}}
{{--                        'done' => 'success',--}}
{{--                    ];--}}
{{--                @endphp--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-xxl-3">
            <div class="row">
                <div class="col-xxl-12 col-md-6 col-lg-4">
                    <div class="card bg-white border-0 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <h3 class="mb-3 mb-lg-4">Foto Toko</h3>

                            <div class="d-flex align-items-center mb-4">
                                <img src="{{asset('storage/'.$customer->store_photo)}}" alt="" style="max-width: 200px; max-height: 200px;">
                            </div>
                            <h4 class="fw-semibold fs-14 mb-2 pb-1">KTP</h4>

                            <div class="d-flex align-items-center mb-4">
                                <img src="{{asset('storage/'.$customer->owner_photo)}}" class="align-items-center" alt="" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-md-6 col-lg-4">
                    <div class="card bg-white border-0 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <h3 class="mb-3 mb-lg-4">Profile Information</h3>
                            <ul class="ps-0 mb-0 list-unstyled">
                                <li class="d-flex align-items-center mb-2 pb-1">
                                    <span>Nama Lengkap:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $customer->name }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-2 pb-1">
                                    <span>No Whatsapp:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $customer->phone }}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <span>Alamat:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $customer->address }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xxl-9">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-header bg-white border-0 pb-0">
                    <h3>{{$customer->store_name}}</h3>
                    <small>{{$customer->owner_address}}</small>
                </div>
                <div class="row card-body">
                    <div class="col-lg-3 col-sm-3">
                        <div class="card bg-primary border-0 rounded-3 mb-4 text-white">
                            <div class="card-body p-4">
                                <h3 class="mb-0 fs-20 text-white">{{}}</h3>
                                <span>Total Pembelian</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card bg-white border-0 rounded-3 mb-4">

                <div class="card-body p-0">
                    @include('components.order')
                </div>
            </div>

        </div>
    </div>
@endsection
