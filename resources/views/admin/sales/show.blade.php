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
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-primary border-0 rounded-3 welcome-box style-two mb-4 position-relative">
                <div class="card-body py-38 px-4">
                    <div class="mb-5">
                        <h3 class="text-white fw-semibold">Selamat Datang, <span
                                class="text-danger-div">{{ $user->name }}</span></h3>
                    </div>

                    <div class="d-flex align-items-center flex-wrap gap-4 gap-xxl-5">

                        <div class="d-flex align-items-center welcome-status-item style-two">
                            <div class="flex-shrink-0">
                                <i class="material-symbols-outlined">Target</i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="text-white fw-semibold mb-0 fs-16">
                                    Rp.{{ number_format($user->target_sales) }}</h5>
                                <p class="text-light">Target Penjualan</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center welcome-status-item style-two">
                            <div class="flex-shrink-0">
                                <i class="material-symbols-outlined icon-bg two">local_library</i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="text-white fw-semibold mb-0 fs-16">Rp.{{ number_format($order->total ?? 0) }}
                                </h5>
                                <p class="text-light">Sedang Berjalan</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center welcome-status-item style-two">
                            <div class="flex-shrink-0">
                                <i class="material-symbols-outlined icon-bg two">local_library</i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="text-white fw-semibold mb-0 fs-16">
                                    @if ($order && $order->total > 0 && $user->target_sales > 0)
                                        {{ number_format(($order->total / $user->target_sales) * 100, 2) }}
                                    @else
                                        0
                                    @endif
                                    %
                                </h5>
                                <p class="text-light">Pencapaian</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row justify-content-center">
                @php
                    $statusColors = [
                        'pending' => 'primary',
                        'process' => 'warning',
                        'success' => 'success',
                        'cancel' => 'danger',
                        'done' => 'success',
                    ];
                @endphp

                @foreach ($status as $s)
                    @php
                        $bgColor = $statusColors[$s->status] ?? 'secondary';
                    @endphp
                    <div class="col-lg-6 col-sm-6">
                        <div class="card bg-{{ $bgColor }} border-0 rounded-3 mb-4 text-white">
                            <div class="card-body p-4">
                                <h3 class="mb-0 fs-20 text-white">{{ $s->total }}</h3>
                                <span>Total {{ ucfirst($s->status) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3">
            <div class="row">
                <div class="col-xxl-12 col-md-6 col-lg-4">
                    <div class="card bg-white border-0 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <h3 class="mb-3 mb-lg-4">Profile Intro</h3>

                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ $user->photo ? $user->photo : asset('admin/assets/images/user-42.jpg') }}"
                                        class="rounded-circle border border-2 wh-75" alt="user">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="fs-17 mb-1 fw-semibold">{{ $user->name }}</h4>
                                    <span class="fs-14">{{ $user->roles[0]->display_name }}</span>
                                </div>
                            </div>
                            <h4 class="fw-semibold fs-14 mb-2 pb-1">Social Profile</h4>
                            <ul class="ps-0 mb-0 list-unstyled d-flex flex-wrap gap-2">
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank"
                                        class="text-decoration-none wh-30 d-inline-block lh-30 text-center rounded-circle text-white transition-y"
                                        style="background-color: #3a559f;">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.twitter.com/" target="_blank"
                                        class="text-decoration-none wh-30 d-inline-block lh-30 text-center rounded-circle text-white transition-y"
                                        style="background-color: #03a9f4;">
                                        <i class="ri-twitter-x-line"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/" target="_blank"
                                        class="text-decoration-none wh-30 d-inline-block lh-30 text-center rounded-circle text-white transition-y"
                                        style="background-color: #007ab9;">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.google.com/" target="_blank"
                                        class="text-decoration-none wh-30 d-inline-block lh-30 text-center rounded-circle text-white transition-y"
                                        style="background-color: #2196f3;">
                                        <i class="ri-mail-line"></i>
                                    </a>
                                </li>
                            </ul>
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
                                    <span class="text-secondary fw-medium ms-1">{{ $user->name }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-2 pb-1">
                                    <span>Email:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $user->email }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-2 pb-1">
                                    <span>Role:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $user->roles[0]->display_name }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-2 pb-1">
                                    <span>No Whatsapp:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $user->phone }}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <span>Alamat:</span>
                                    <span class="text-secondary fw-medium ms-1">{{ $user->address }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xxl-9">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-0">
                    <x-order :user_id="$user->id" />
                </div>
            </div>
        </div>
    </div>
@endsection
