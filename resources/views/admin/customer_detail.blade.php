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

    <div class="row">
        <div class="col-xxl-3">
            <div class="row">
                <div class="col-xxl-12 col-md-6 col-lg-4">
                    <div class="card bg-white border-0 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <h3 class="mb-3 mb-lg-4">Foto Toko</h3>
                            <div class="d-flex align-items-center mb-4">
                                <img src="{{ asset('storage/' . $customer->store_photo) }}" alt=""
                                     style="max-width: 200px; max-height: 200px;">
                            </div>
                            <h4 class="fw-semibold fs-14 mb-2 pb-1">KTP</h4>
                            <div class="d-flex align-items-center mb-4">
                                <img src="{{ asset('storage/' . $customer->owner_photo) }}" class="align-items-center"
                                     alt="" style="max-width: 200px; max-height: 200px;">
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
                                @php
                                    $phone = preg_replace('/\D/', '', $customer->phone);
                                    if (strpos($phone, '62') === 0) {
                                        $formattedPhone = $phone;
                                    } elseif (strpos($phone, '0') === 0) {
                                        $formattedPhone = '62' . substr($phone, 1);
                                    } elseif (strpos($phone, '8') === 0) {
                                        $formattedPhone = '62' . $phone;
                                    } elseif (strpos($phone, '+62') === 0) {
                                        $formattedPhone = substr($phone, 1);
                                    } else {
                                        $formattedPhone = $phone;
                                    }
                                @endphp
                                <li class="d-flex align-items-center mb-2 pb-1">
                                    <span>No Whatsapp:</span>
                                    <span class="text-secondary fw-medium ms-1">
                                        <a target="_blank" href="https://wa.me/{{ $formattedPhone }}">{{ $formattedPhone }}</a>
                                    </span>
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
                <div class="card-header bg-white border-0 pb-0 d-flex justify-content-between">
                    <div>
                        <h3>{{ $customer->store_name }}</h3>
                        <small>{{ $customer->owner_address }}</small>
                    </div>
                    <div>
                        <h6 class="hover-bg btn btn-outline-success text-success text-start">
                            {{ optional($order)->total_produk_retur ?? 0 }} Total Produk
                            <br>{{ optional($order)->total_produk_retur ?? 0 }} Total Retur
                        </h6>
                    </div>
                </div>

                <div class="row card-body">
                    <div class="col-lg-4 col-sm-3">
                        <div class="card bg-primary border-0 rounded-3 mb-4 text-white">
                            <div class="card-body p-4">
                                <h3 class="mb-0 fs-20 text-white">
                                    Rp. {{ number_format(optional($order)->total_pembelian ?? 0 - optional($order)->total_discount ?? 0 - optional($order)->total_retur ?? 0) }}
                                </h3>
                                <span>Total Pembelian</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-3">
                        <div class="card bg-primary border-0 rounded-3 mb-4 text-white">
                            <div class="card-body p-4">
                                <h3 class="mb-0 fs-20 text-white">
                                    @if(isset($order->total_remaining_payment))
                                        Rp. {{ number_format($order->total_pembelian- $order?->total_remaining_payment) }}
                                    @else
                                        Rp. 0
                                    @endif

                                </h3>
                                <span>Total Pembayaran</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-3">
                        <div class="card bg-primary border-0 rounded-3 mb-4 text-white">
                            <div class="card-body p-4">
                                <h3 class="mb-0 fs-20 text-white">
                                    Rp. {{ number_format(optional($order)->total_remaining_payment ?? 0) }}
                                </h3>
                                <span>Total Sisa Pembayaran</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-0">
                    <x-order :customer_id="$customer->id" />
                </div>
            </div>
        </div>
    </div>
@endsection
