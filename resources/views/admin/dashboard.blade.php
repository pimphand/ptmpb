@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Dashboard</h3>
    </div>

    <div class="main-content-container overflow-hidden">
        <div class="card bg-white border-0 rounded-3 p-4 pb-0 mb-4">
            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
                <h3 class="fs-24 fw-normal mb-0">Selamat datang, <span
                        class="text-primary">{{auth()->user()->name}}</span></h3>
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="range_datepicker"
                               style="width: 230px; height: 36px; padding-left: 35px;"
                               placeholder="29/10/2024 - 28/11/2024"/>
                        <i class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y ps-3"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xxl-3">
                    <div class="card border bg-white rounded-3 overflow-hidden mb-4">
                        <div class="d-flex align-items-center p-4 pb-3 mb-1">
                            <div class="flex-shrink-0">
                                <div class="wh-55 bg-primary bg-opacity-25 text-center rounded-2"
                                     style="line-height: 55px;">
                                    <i class="ri-shopping-cart-line fs-22 bg-primary text-white rounded-2 p-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="fs-24 fw-medium mb-0" id="total_item">{{$total_item}}</h3>
                                <span>Total Item Terjual</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xxl-3">
                    <div class="card border bg-white rounded-3 overflow-hidden mb-4">
                        <div class="d-flex align-items-center p-4 pb-3 mb-1">
                            <div class="flex-shrink-0">
                                <div class="wh-55 bg-primary bg-opacity-25 text-center rounded-2"
                                     style="line-height: 55px;">
                                    <i class="ri-shopping-bag-3-line fs-22 bg-primary text-white rounded-2 p-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="fs-24 fw-medium mb-0" id="total_order">{{$total_order }}</h3>
                                <span>Total Penjualan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xxl-3">
                    <div class="card border bg-white rounded-3 overflow-hidden mb-4">
                        <div class="d-flex align-items-center p-4 pb-3 mb-1">
                            <div class="flex-shrink-0">
                                <div class="wh-55 bg-primary bg-opacity-25 text-center rounded-2"
                                     style="line-height: 55px;">
                                    <i class="ri-cake-3-line fs-22 bg-primary text-white rounded-2 p-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="fs-24 fw-medium mb-0" id="total_order">{{$total_pending }}</h3>
                                <span>Total Order Pending</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xxl-3">
                    <div class="card border bg-white rounded-3 overflow-hidden mb-4">
                        <div class="d-flex align-items-center p-4 pb-3 mb-1">
                            <div class="flex-shrink-0">
                                <div class="wh-55 bg-primary bg-opacity-25 text-center rounded-2"
                                     style="line-height: 55px;">
                                    <i class="ri-open-arm-line fs-22 bg-primary text-white rounded-2 p-2"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="fs-24 fw-medium mb-0" id="total_order">Rp. {{number_format($omzet) }}</h3>
                                <span>Total Omzet</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xl-6 col-xxl-6 col-lg-6">
                    <h3>Sales</h3>
                    <div class="card bg-white border rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="default-table-area recent-orders recent-style-two">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Total Penjualan</th>
                                            <th scope="col">Target</th>
                                            <th scope="col">On Going</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sales as $key=> $sale)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$sale->name}}</td>
                                                <td>{{$sale->success_orders_count}} Penjualan</td>
                                                <td>Rp. {{number_format($sale->target_sales)}}</td>
                                                <td>Rp. {{number_format($sale->achieved_sales)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-6 col-lg-6">
                    <h3>Order Terbaru</h3>
                    <div class="card bg-white border rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="default-table-area recent-orders recent-style-two">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                         $status = [
                                             'pending'=> 'primary',
                                            'process'=> 'warning',
                                            'success'=> 'success',
                                            'cancel'=> 'danger',
                                            'done'=> 'success'
                                        ];
                                        @endphp
                                        @foreach($new_orders as $new_order)
                                        <tr style="cursor: pointer" class="order" data-id="{{$new_order->id}}">
                                            <td>#{{$new_order->id}}</td>
                                            <td>
                                                <div class="ms-2 ps-1">
                                                    <h6 class="fw-medium fs-14">{{$new_order->customer->name}} ({{$new_order->customer->store_name}})</h6>
                                                </div>
                                            </td>
                                            <td>{{date('d M Y', strtotime($new_order->created_at))}}</td>
                                            <td>{{$new_order->order_items_sum_quantity}}</td>
                                            <td>
                                            <span
                                                class="badge bg-{{$status[$new_order->status]}} text-white p-2 fs-12 fw-normal">{{$new_order->status}}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.order').click(function () {
                let id = $(this).data('id');
                window.location.href = '/admin/orders/' + id;
            });
        });
    </script>
@endpush
