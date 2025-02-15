@extends('admin.layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Invoice Details</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Invoice</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Invoice Details</span>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="mb-4">
                            <p class="mb-4">Invoice: <span class="text-secondary">#{{$order->id}}</span></p>
                            <p class="mb-1">Invoice Ke:</p>
                            <p class="mb-1 text-secondary">{{$order->customer->name}} ({{$order->customer->store_name}})</p>
                            <p class="mb-1 text-secondary">{{$order->customer->address}}</p>
                            <p class="mb-1 text-secondary">{{$order->customer->phone}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
{{--                        <div class="mb-4 text-center">--}}
{{--                            <img src="assets/images/qr-code.svg" class="wh-150" alt="qr-code">--}}
{{--                        </div>--}}
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="mb-4 text-sm-end">
                            <p class="mb-4">Tanggal: <span class="text-secondary">{{date('d M Y',strtotime($order->created_at))}}</span></p>
                            <p class="mb-1">Sales:</p>
                            <p class="mb-1">{{$order->user->name}} ({{$order->user->phone}})</p>

                           @if($order->driver)
                                <p class="mb-1">Pengirim: </p>
                                <p class="mb-1">{{$order->driver->name}} ({{$order->driver->phone}})</p>
                           @endif
                        </div>
                    </div>
                </div>

                <div class="default-table-area all-products">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            <form action="{{route('admin.orders.update',$order->id)}}" method="post" id="form">
                                @csrf
                                @method('PUT')
                                <input hidden class=" form-control" name="id" value="{{$order->id}}">

                            @foreach($order->orderItems as $key=>$item)
                                @php
                                    $total += $item->quantity * $item->price;
                                @endphp
                                <tr>
                                    <td class="text-body">{{$key+1}}</td>
                                    <td class="text-secondary fw-medium">
                                        {{$item->sku->name}} ({{$item->sku->product->name}})
                                    </td>
                                    <td class="text-body"><span class="price">{{$item->quantity}} Item</span>
                                        <input class="form-control mb-2 form-show" style="display: none" name="quantity[]" value="{{$item->quantity}}">
                                    </td>
                                    <td class="text-body"><span class="price">Rp. {{number_format($item->price,0,',','.')}}</span>
                                        <input class="form-control mb-2 form-show" style="display: none" name="value[]" value="{{$item->price}}">
                                        <input hidden class=" form-control" name="id[]" value="{{$item->id}}">
                                        <textarea class="form-control form-show" style="display: none" name="note[]" placeholder="Tambah Catatan">{{$item->note}}</textarea>
                                        <p class="price">{{$item->note}}</p>
                                    </td>
                                    <td class="text-body">Rp. {{number_format($item->quantity * $item->price,0,',','.')}}</td>
                                </tr>
                            @endforeach

{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td>Sub total:</td>--}}
{{--                                <td class="text-body">$1,171</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td>Tax (5%)</td>--}}
{{--                                <td class="text-body">$58.55</td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="fw-medium text-secondary">Grand Total</td>
                                <td class="text-secondary">Rp. {{number_format($total,0,',','.')}}</td>
                            </tr>
                            <tr class="form-show" style="display: none;background-color: #fd5812;color: #fff;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="fw-medium text-white">Pilih Pengirim</td>
                                <td>
                                    <select class="form-select" name="driver_id">
                                        <option value="">Pilih Pengirim</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{$driver->id}}" {{$order->driver_id == $driver->id ? 'selected' : ''}}>{{$driver->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
                    <button class="btn btn-success py-2 px-4 fw-medium fs-16 text-white" id="edit"><i class="ri-pencil-fill text-white fw-medium"></i>Edit</button>
                    <button class="btn btn-success py-2 px-4 fw-medium fs-16 text-white" style="display: none" id="save"><i class="ri-save-2-fill text-white fw-medium" ></i>Simpan</button>
                    <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" style="display: none" id="cancel"><i class="ri-xrp-line"></i>Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $('#save').click(function(e) {
        e.preventDefault();
        formSendData();
    });

    $('#edit').click(function(e) {
        e.preventDefault();
        $('#save').show();
        $('#cancel').show();
        $('.form-show').show();
        $('.price').hide();
        $(this).hide();
    });

    $('#cancel').click(function(e) {
        e.preventDefault();
        $('#save').hide();
        $('#cancel').hide();
        $('.form-show').hide();
        $('.price').show();

        $('#edit').show();
    });

    function getData(){
        //reload halaman delay 1 detik
        setTimeout(function(){
            location.reload();
        }, 1000);
    }
</script>
@endpush
