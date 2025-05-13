@extends('admin.layouts.app')
@section('content')
    <style>
        tr.return {
            background-color: #22b1c2;
        }

        tr.return label,
        tr.return a,
        tr.return p,
        tr.return span {
            color: #fff !important;
        }
    </style>
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
                            <p class="mb-4">Invoice: <span class="text-secondary">#{{ $order->id }}</span></p>
                            <p class="mb-1">Invoice Ke:</p>
                            <p class="mb-1 text-secondary">{{ $order?->customer?->name }}
                                ({{ $order?->customer?->store_name }}
                                )</p>
                            <p class="mb-1 text-secondary">{{ $order?->customer?->address }}</p>
                            <p class="mb-1 text-secondary">{{ $order?->customer?->phone }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="mb-4 text-center">
                            <br>
                            <br>
                            <br>
                            @if ($order->date_delivery)
                                <h4>Dikirim : {{ date('d M Y', strtotime($order->date_delivery)) }}</h4>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="mb-4 text-sm-end">
                            <p class="mb-4">Tanggal: <span
                                    class="text-secondary">{{ date('d M Y', strtotime($order->created_at)) }}</span></p>
                            <p class="mb-1">Sales:</p>
                            <p class="mb-1">{{ $order->user?->name }} ({{ $order->user?->phone }})</p>

                            @if ($order->driver)
                                <p class="mb-1">Pengirim: </p>
                                <p class="mb-1">{{ $order->driver->name }} ({{ $order->driver->phone }})</p>
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
                                    $subTotal = 0;
                                    $totalRetur = 0;
                                    $paid = 0;
                                @endphp
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="post" id="form">
                                    @csrf
                                    @method('PUT')
                                    <input hidden class=" form-control" name="id" value="{{ $order->id }}">

                                    @foreach ($order->orderItems as $key => $item)
                                        @php
                                            $total += $item->quantity * $item->price;
                                            $subTotal += (int) $item->quantity * (int) $item->price;
                                            $totalRetur += (int) $item->returns * (int) $item->price;
                                        @endphp
                                        <tr class="{{ $item->returns ? 'return' : '' }}">
                                            <td class="text-body"><span>{{ $key + 1 }}</span></td>
                                            <td class="text-secondary fw-medium">
                                                <span>{{ $item->sku->name }} ({{ $item->sku->product->name }})</span>
                                            </td>
                                            <td class="text-body"><span class="price">{{ $item->quantity }} Item</span>
                                                <input class="form-control mb-2 form-show" style="display: none"
                                                    name="quantity[]" value="{{ $item->quantity }}">
                                            </td>
                                            <td class="text-body">
                                                <span class="price">Rp. {{ number_format($item->price, 0, ',', '.') }}</span>
                                                <br>
                                                @if ($item->returns > 0)
                                                    <span class="price">Retur : {{ $item->returns }} @if ($item->file)
                                                            <a href="javascript:viod(0)"
                                                                data-url="{{ asset('storage/' . $item->file) }}"
                                                                class="text-white fw-semibold" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModallg"><i
                                                                    class="ri-image-2-fill"></i></a>
                                                        @endif
                                                    </span> <br>
                                                    <p class="price">{{ $item->return_reason }}</p>
                                                @endif
                                                <input class="form-control mb-2 form-show" style="display: none"
                                                    name="value[]" value="{{ $item->price }}">
                                                <input hidden class=" form-control" name="id[]"
                                                    value="{{ $item->id }}">
                                                <textarea class="form-control form-show" style="display: none" name="note[]" placeholder="Tambah Catatan">{{ $item->note }}</textarea>
                                                <p class="price">{{ $item->note }}</p>
                                            </td>
                                            <td class="text-body">
                                                <p>Rp. {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-medium text-secondary">
                                            <span class="_label_discount">Diskon (-)</span>
                                            <div class="form-check" id="is_persent" style="display: none">
                                                <input class="form-check-input" type="checkbox" value="persen"
                                                    name="type_discount" id="discountPersen">
                                                <label class="form-check-label" for="discountPersen">
                                                    Diskon Persen
                                                </label>
                                            </div>
                                        <td class="text-secondary">
                                            <span class="_label_discount">Rp.
                                                {{ number_format($order->discount, 0, ',', '.') }}</span>
                                            <input class="form-control" id="discount" name="discount"
                                                value="{{ $order->discount }}" style="display: none">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-medium text-secondary">Grand Total</td>
                                        <td class="text-secondary">
                                            <span>Rp. {{ number_format($total - $order->discount, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                    <tr class="form-show" style="display: none;background-color: #fd5812;color: #fff;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-medium text-white">Pilih Pengirim</td>
                                        <td>
                                            <select class="form-select" name="driver_id">
                                                <option value="">Pilih Pengirim</option>
                                                @foreach ($drivers as $driver)
                                                    <option value="{{ $driver->id }}"
                                                        {{ $order->driver_id == $driver->id ? 'selected' : '' }}>
                                                        {{ $driver->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="form-show" style="display: none;background-color: #fd5812;color: #fff;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-medium text-white">Pilih Kolektor</td>
                                        <td>
                                            <select class="form-select" name="collector_id">
                                                <option value="">Pilih Kolektor</option>
                                                @foreach ($collectors as $collector)
                                                    <option value="{{ $collector->id }}"
                                                        {{ $order->collector_id === $collector->id ? 'selected' : '' }}>
                                                        {{ $collector->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="form-show" style="display: none;background-color: #fd5812;color: #fff;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-medium text-white">Pilih Tanggal Pengiriman</td>
                                        <td>
                                            <input type="date" class="form-control" name="delivery_date"
                                                value="{{ $order->date_delivery }}">
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
                    @if ($order->status != 'cancel')
                        <a target="_blank" href="{{ route('generateSuratJalan', encrypt($order->id)) }}"
                            class="btn btn-success py-2 px-4 fw-medium fs-16 text-white"><i
                                class="ri-truck-fill text-white fw-medium"></i> Surat Jalan
                        </a>
                        <a target="_blank" href="{{ route('invoice', encrypt($order->id)) }}"
                            class="btn btn-success py-2 px-4 fw-medium fs-16 text-white"><i
                                class="ri-file-paper-2-fill text-white fw-medium"></i> Invoice
                        </a>

                        @if ($order->status == 'process' || $order->status == 'pending' || request()->get('status') == 'pending')
                            <button class="btn btn-success py-2 px-4 fw-medium fs-16 text-white" id="edit"><i
                                    class="ri-pencil-fill text-white fw-medium"></i>Edit
                            </button>
                        @endif

                        <button class="btn btn-success py-2 px-4 fw-medium fs-16 text-white" style="display: none"
                            id="save"><i class="ri-save-2-fill text-white fw-medium"></i>Simpan
                        </button>
                        <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" style="display: none"
                            id="cancel"><i class="ri-xrp-line"></i>Cancel
                        </button>
                    @endif
                </div>
            </div>

        </div>

        <div class="card bg-white border-0 rounded-3 mb-4" style="font-size: 10px">
            <div class="card-body p-4">
                <div class="row">
                    <h4>Rincian</h4>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th width="10%">Tanggal</th>
                                <th width="10%">Kas/Trf</th>
                                <th width="10%">Jatuh Tempo</th>
                                <th width="10%">Nominal</th>
                                <th width="10%">Sisa (-)</th>
                                <th width="10%">Customer</th>
                                <th width="10%">Kolektor</th>
                                <th width="10%">Admin</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($order->payments as $payment)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($payment->date)) }}</td>
                                    <td>{{ $payment->method }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->invoice_date)->addMonth()->format('Y-m-d') }}</td>

                                    <td>Rp. {{ number_format($payment->amount) }}</td>
                                    <td>Rp. {{ number_format($payment->remaining) }}</td>
                                    <td>{{ $payment->customer }}</td>
                                    <td>{{ $payment->collector }}</td>
                                    <td>{{ $payment->admin }}</td>
                                </tr>
                                @php
                                    $paid += $payment->amount;
                                @endphp
                            @endforeach
                            </tbody>

                            <tbody class="form" id="_form">
                            </tbody>
                            <tbody class="form">
                            <tr>
                                <td colspan="8" class="text-center">
                                    {{-- @if ($sisa > 0) --}}
                                    <button type="button" class="btn btn-info text-white add">Tambah Pembayaran</button>
                                    {{-- @endif --}}
                                    <button type="button" class="btn btn-info text-white save" style="display: none">
                                        Simpan
                                    </button>
                                </td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModallg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Large modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hello Modal Center
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white">Save changes</button>
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
            $('._label_discount').hide();
            $('.form-show').show();
            $('.price').hide();
            $('#discount').show();
            $(this).hide();
            $('#is_persent').show()
        });

        $('#cancel').click(function(e) {
            e.preventDefault();
            $('#save').hide();
            $('#cancel').hide();
            $('.form-show').hide();
            $('.price').show();
            $('#discount').hide();
            $('#edit').show();
            $('._label_discount').show();
            $('#is_persent').hide()
        });

        function getData() {
            //reload halaman delay 1 detik
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    </script>

    <script>
        $(document).ready(function () {
            let maxAmount = {{ $subTotal - $totalRetur - $order->discount - $paid }}; // Batas jumlah maksimal
            let totalAmount = 0;
            let sisa = {{ isset($order->payments) && $order->payments->first() && $order->payments->first()->remaining
                ? $order->payments->first()->remaining - $totalRetur - $order->discount
                : $subTotal - $totalRetur - $order->discount - $paid  }};

            $(".add").click(function (e) {
                e.preventDefault();
                $("#_form").append(`
                <tr>
                    <td><input placeholder="Masukkan tanggal" type="date" class="form-control-custom-required" name="date[]" required></td>
                    <td><input placeholder="Masukkan metode" type="text" class="form-control-custom-required" name="method[]" required></td>
                    <td>{{ \Carbon\Carbon::parse($order->invoice_date)->addMonth()->format('Y-m-d') }}</td>
                    <td><input placeholder="Masukkan jumlah" type="number" class="form-control-custom-required amount" name="amount[]" required></td>
                    <td><span class="sisa">${formatRupiah(sisa)}</span>
                    <input placeholder="Masukkan sisa" value="${sisa}" type="number" class="form-control-custom remaining" readonly name="remaining[]" hidden></td>
                    <td>{{ $order->customer->store_name }}</td>
                    <td><input placeholder="Masukkan collector" type="text" class="form-control-custom-required" name="collector[]"></td>
                    <td>{{ auth()->user()->name }}</td>
                    <td><button type="button" class="btn btn-danger text-white remove">Hapus</button></td>
                </tr>
            `);
                checkSaveButton();
            });

            // Hapus baris
            $(document).on("click", ".remove", function () {
                let row = $(this).closest("tr");
                let amountValue = parseFloat(row.find(".amount").val()) || 0;
                totalAmount -= amountValue;
                row.remove();
                checkSaveButton();
            });

            // Validasi jumlah input
            $(document).on("change", ".amount", function () {

                let row = $(this).closest("tr");
                let amount = parseFloat(row.find(".amount").val()) || 0;

                totalAmount = 0;
                $(".amount").each(function () {
                    totalAmount += parseFloat($(this).val()) || 0;
                });

                if (totalAmount > maxAmount) {
                    Toast.fire({
                        icon: "error",
                        title: `Jumlah tidak boleh melebihi batas Rp${maxAmount}`
                    });
                    $(this).val("");
                }
                $('.remaining').val(maxAmount - totalAmount);
                $('.sisa').text(formatRupiah(maxAmount - totalAmount));
                if (totalAmount > maxAmount) {
                    Toast.fire({
                        icon: "error",
                        title: `Jumlah tidak boleh melebihi batas Rp${maxAmount}`
                    });
                    $(this).val("");
                    $('.sisa').text(formatRupiah(maxAmount));
                }
                checkSaveButton();
            });

            // Cek apakah tombol simpan harus ditampilkan
            function checkSaveButton() {
                if ($("#_form tr").length > 0) {
                    $(".save").show();
                    $(".add").hide();
                } else {
                    $(".save").hide();
                    $(".add").show();
                }
            }

            // Simpan data
            $(".save").click(function () {
                const data = {
                    _token: "{{ csrf_token() }}",
                    date: [],
                    metode: [],
                    amount: [],
                    remaining: [],
                    collector: [],
                };

                let isValid = true;

                // Validasi input date
                $("input[name='date[]']").each(function () {
                    const value = $(this).val();
                    if (!value) {
                        Toast.fire({
                            icon: "error",
                            title: "Tanggal pembayaran wajib diisi."
                        });
                        isValid = false;
                        return false; // Hentikan iterasi
                    }
                    data.date.push(value);
                });

                // Validasi input metode pembayaran
                $("input[name='method[]']").each(function () {
                    const value = $(this).val();
                    if (!value) {
                        Toast.fire({
                            icon: "error",
                            title: "Metode pembayaran wajib diisi."
                        });
                        isValid = false;
                        return false;
                    }
                    data.metode.push(value);
                });

                // Validasi input jumlah pembayaran
                $("input[name='amount[]']").each(function () {
                    const value = parseFloat($(this).val()) || 0;
                    if (value <= 0) {
                        Toast.fire({
                            icon: "error",
                            title: "Jumlah pembayaran wajib diisi dan lebih dari 0."
                        });
                        isValid = false;
                        return false;
                    }
                    data.amount.push(value);
                });

                // Validasi input sisa pembayaran
                $("input[name='remaining[]']").each(function () {
                    const value = parseFloat($(this).val()) || 0;
                    if (value < 0) {
                        Toast.fire({
                            icon: "error",
                            title: "Sisa pembayaran tidak boleh negatif."
                        });
                        isValid = false;
                        return false;
                    }
                    data.remaining.push(value);
                });

                // Validasi input collector
                $("input[name='collector[]']").each(function () {
                    const value = $(this).val();
                    if (!value) {
                        Toast.fire({
                            icon: "error",
                            title: "Collector wajib diisi."
                        });
                        isValid = false;
                        return false;
                    }
                    data.collector.push(value);
                });


                // Validasi total amount agar tidak melebihi batas
                const totalAmount = data.amount.reduce((acc, val) => acc + val, 0);
                if (totalAmount > maxAmount) {
                    Toast.fire({
                        icon: "error",
                        title: `Total pembayaran tidak boleh melebihi Rp${maxAmount}`
                    });
                    isValid = false;
                }

                // Jika semua valid, kirim data ke server
                if (isValid) {
                    $.post("{{ route('admin.order.payment.store', encrypt($order->id)) }}", data)
                        .done(function (response) {
                            window.location.reload();
                        })
                        .fail(function (xhr) {
                            Toast.fire({
                                icon: "error",
                                title: "Data gagal disimpan"
                            });
                        });
                }
            });


        });
    </script>

@endpush
