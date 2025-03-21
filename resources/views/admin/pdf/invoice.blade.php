<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            text-align: left;
        }

        .header-right {
            text-align: right;
        }

        .invoice-title {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        .info-table td {
            border: none;
            padding: 5px 0;
        }

        .product-table th,
        .product-table td {
            text-align: left;
        }

        .note-section {
            font-size: 12px;
            margin-top: 10px;
        }

        .btn-info-custom {
            background-color: #17a2b8;
            /* Warna default Bootstrap btn-info */
            border-color: #17a2b8;
            color: #fff;
            /* Warna teks putih */
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            /* Membuat sudut tombol lebih membulat */
            transition: all 0.3s ease-in-out;
        }

        .btn-info-custom:hover {
            background-color: #138496;
            /* Warna lebih gelap saat hover */
            border-color: #117a8b;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-info-custom:active {
            background-color: #117a8b;
            border-color: #0f6c75;
        }

        .form-control-custom {
            border-radius: 8px;
            /* Membuat sudut input lebih membulat */
            border: 2px solid;
            /* Warna border biru */
            padding: 5px 10px;
            font-size: 12px;
            transition: all 0.3s ease-in-out;
        }

        .form-control-custom-required {
            border-radius: 8px;
            /* Membuat sudut input lebih membulat */
            border: 2px solid #b83517;
            /* Warna border biru */
            padding: 5px 10px;
            font-size: 12px;
            transition: all 0.3s ease-in-out;
        }

        .form-control-custom:focus {
            border-color: #138496;
            /* Warna border saat fokus */
            box-shadow: 0 0 8px rgba(23, 162, 184, 0.5);
            /* Efek glow */
            outline: none;
        }

        @media print {
            @page {
                size: landscape;
                margin: 20mm;
                /* Atur margin agar sesuai */
            }

            body {
                font-size: 12px;
                /* Sesuaikan ukuran font */
            }

            .form {
                display: none !important;
                /* Sembunyikan elemen dengan id="form" */
            }
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.1);
            font-weight: bold;
            z-index: -1;
            user-select: none;
            pointer-events: none;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
<div class="watermark" style="text-align: center">Asli <br> PT Mandalika Putra Bersama</div>

<div class="header-container">
    <div class="header-left">
        <img src="{{ asset('logo.webp') }}" alt="Logo" style="width:100px;">
        <p>Komplek Warga Rahayu Blok E4/E5<br>Kab. Garut Jawa Barat<br>Indonesia</p>
    </div>
    <div class="header-right">
        <p class="invoice-title">Invoice</p>
        <p><strong>Tanggal:</strong> {{ date('d M Y') }}</p>
        <p><strong>No Invoice:</strong> {{ $order->invoice }}</p>
        <p><strong>Surat Jalan:</strong> {{ $order->surat_jalan }}</p>
    </div>
</div>
<h3>Kepada : {{ $order->customer->store_name }}</h3>
<table class="product-table">
    <tr>
        <th class="text-start">Nama Barang</th>
        <th>Qty</th>
        <th>Retur</th>
        <th>@Harga</th>
        <th>Total Retur</th>
        <th>Total Harga</th>
    </tr>
    @php
        $subTotal = 0;
        $totalRetur = 0;
        function terbilang($angka)
        {
            $angka = abs($angka);
            $bilangan = [
                '',
                'satu',
                'dua',
                'tiga',
                'empat',
                'lima',
                'enam',
                'tujuh',
                'delapan',
                'sembilan',
                'sepuluh',
                'sebelas',
            ];

            if ($angka < 12) {
                return ' ' . $bilangan[$angka];
            } elseif ($angka < 20) {
                return terbilang($angka - 10) . ' belas';
            } elseif ($angka < 100) {
                return terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
            } elseif ($angka < 200) {
                return ' seratus' . terbilang($angka - 100);
            } elseif ($angka < 1000) {
                return terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
            } elseif ($angka < 2000) {
                return ' seribu' . terbilang($angka - 1000);
            } elseif ($angka < 1000000) {
                return terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
            } elseif ($angka < 1000000000) {
                return terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
            } elseif ($angka < 1000000000000) {
                return terbilang($angka / 1000000000) . ' miliar' . terbilang($angka % 1000000000);
            } else {
                return 'Angka terlalu besar';
            }
        }
    @endphp
    @foreach ($order->orderItems as $item)
        <tr>
            <td class="text-start">{{ $item->sku->product->name }} ({{ $item->sku->name }} {{ $item->sku->packaging }}
                )
            </td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->returns }}</td>
            <td>Rp. {{ number_format($item->price) }}</td>
            <td>Rp. {{ number_format((int) $item->returns * (int) $item->price) }}</td>
            <td>Rp. {{ number_format((int) $item->quantity * (int) $item->price) }}</td>
        </tr>

        @php
            $subTotal += (int) $item->quantity * (int) $item->price;
            $totalRetur += (int) $item->returns * (int) $item->price;
        @endphp
    @endforeach
</table>
<br>
<table>
    <tr>
        <td style="width: 30%; text-align: center; border: none;">Customer / Penerima,
        </td>
        <td style="width: 30%; text-align: center; border: none;">Admin,</td>
        <td><strong>Sub Total</strong></td>
        <td>Rp. {{ $subTotal ? number_format($subTotal) : '0' }}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>Diskon</strong></td>
        <td>Rp. {{ $order->discount ? number_format($order->discount) : '0' }}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>Retur</strong></td>
        <td>Rp. {{ $totalRetur ? '-' . number_format($totalRetur) : '0' }}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>PPN ({{ $order->tax_percentage }}%)</strong></td>
        <td>Rp. {{ $order->tax_amount ? number_format($order->tax_amount) : 0 }}</td>
    </tr>
    <tr>
        <td style="width: 30%; text-align: center; border: none;">___________________
        </td>
        <td style="width: 30%; text-align: center; border: none;">___________________</td>
        <td><strong>Biaya Lain-lain</strong></td>
        <td>Rp. {{ $order->other_fees ? number_format($order->other_fees) : 0 }}</td>
    </tr>

    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>Total</strong></td>
        <td>Rp. {{ number_format($subTotal - $totalRetur - $order->discount) }}</td>
    </tr>
</table>
<p><strong>Terbilang : {{ ucfirst(trim(terbilang($subTotal))) . ' rupiah.' }} </strong></p>
<div class="note-section">
    <p><strong>NOTE:</strong></p>
    <ol>
        <li>Pembayaran dianggap sah setelah di transfer ke rekening:<br>Bank Permata a/c. 4175142008 a/n PT
            Mandalika
            Putra Bersama
        </li>
        <li>Pembayaran dengan CEK DAN GIRO dianggap sah setelah Cek/Giro tersebut dapat diuangkan</li>
    </ol>
</div>
<h4>Rincian</h4>
<table>
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
    @php
        $paid = 0;
    @endphp
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
</table>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
