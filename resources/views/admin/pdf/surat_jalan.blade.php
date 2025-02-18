<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-text {
            text-align: right;
        }
        .header-text h1, .header-text p {
            margin: 0;
        }
        .logo img {
            filter: grayscale(100%);
            width: 150px;
        }
        ul {
            list-style: none; /* Menghapus dot pada list */
            padding: 0; /* Menghilangkan padding default */
            margin: 0; /* Menghilangkan margin default */
        }
        /* Print media query to hide the print button */
        @media print {
            #printButton {
                display: none;
            }
        }
    </style>
</head>
<body>
<br>
<div class="header-container">
    <div class="logo">
        <img src="{{asset('logo.webp')}}" alt="Logo">
    </div>
    <div class="header-text" style="font-size: 18px">
        <h1>SURAT JALAN</h1>
        <p>(Delivery Order)</p>
    </div>
</div>
<br>
<br>
<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td style="text-align: left; vertical-align: top; width: 50%;border:none">
            <p><strong>Kepada Yth.</strong></p>
            <table style="width: 100%;">
                <tr>
                    <td style="border:none">Customer</td>
                    <td style="border:none">:</td>
                    <td style="border:none">{{$order->customer->name}} ({{$order->customer->store_name}})</td>
                </tr>
                <tr>
                    <td style="border:none">No HP/Telp</td>
                    <td style="border:none">:</td>
                    <td style="border:none">{{$order->customer->phone}}</td>
                </tr>
                <tr>
                    <td style="border:none">Alamat</td>
                    <td style="border:none">:</td>
                    <td style="border:none">{{$order->customer->address}}</td>
                </tr>
            </table>
        </td>

        <td style="text-align: right; vertical-align: top; width: 50%;border:none">
            <p><strong>Detail Pengiriman</strong></p>
            <table style="width: 100%;">
                <tr>
                    <td style="border:none;text-align: center; ">No. SJ / DO</td>
                    <td style="border:none">:</td>
                    <td style="border:none">{{$order->surat_jalan}}</td>
                </tr>
                <tr>
                    <td style="border:none;text-align: center;">Tanggal</td>
                    <td style="border:none">:</td>
                    <td style="border:none">{{ date('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td style="border:none;text-align: center;">No. PO</td>
                    <td style="border:none">:</td>
                    <td style="border:none">#{{str_pad($order->id,4,'0', STR_PAD_LEFT)}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br>
<br>

<table style="width: 100%; border-collapse: collapse;">
    <tr style="background-color: #f2f2f2;">
        <th>NO</th>
        <th>NAMA BARANG</th>
        <th>UKURAN</th>
        <th>JUMLAH</th>
        <th>UNIT</th>
        <th>KET.</th>
    </tr>
    <tr style="border: #0A0E19">
        @foreach($order->orderItems as $item)
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->sku->name }} ({{ $item->sku->product?->name }})</td>
            <td>{{ $item->packaging }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->unit }}</td>
            <td>{{ $item->note }}</td>
        @endforeach
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td style="text-align: left; vertical-align: top; width: 50%;border:none">
            <table style="width: 100%;">
                <tr>
                    <td style="border:none;text-align: left; ">
                        <b>Total : </b>
                    </td>
                </tr>
                <tr>
                    <td style="border:none;text-align: left; ">
                        <b>Catatan :</b>
                    </td>
                </tr>
            </table>
        </td>

        <td style="text-align: right; vertical-align: top; width: 50%;border:none">
            <table style="width: 100%;">
                <tr>
                    <td style="border:none;text-align: left; ">
                        <p><strong>Perhatian:</strong></p>
                        <ul style="font-size: 16px;">
                            <li>1. Surat Jalan ini merupakan bukti resmi penerimaan barang</li>
                            <li>2. Surat Jalan ini akan dilengkapi invoice sebagai bukti penjualan</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<p style="text-align: center">BARANG SUDAH DITERIMA DALAM KEADAAN BAIK DAN SESUAI DENGAN PESANAN.</p>
<br>
<br>

<table style="margin-top: 30px; text-align: center; width: 100%;">
    <tr>
        <th style="text-align: center;border: none">Diterima oleh,</th>
        <th style="text-align: center;border: none">Pengirim,</th>
        <th style="text-align: center;border: none">Dibuat oleh,</th>
    </tr>
    <tr>
        <td style="text-align: center;border: none"><br><br>______________</td>
        <td style="text-align: center;border: none"><br><br>{{$order->driver->name ?? "Belum Ada Driver"}}</td>
        <td style="text-align: center;border: none"><br><br>{{Auth::user()->name}}</td>
    </tr>
</table>

<!-- Print Button (This will not appear in the printout) -->
<button id="printButton" onclick="window.print()">Print Surat Jalan</button>
<script type="text/javascript">
    window.print();
    window.onmousemove = function() {
        window.close();
    }
</script>
</body>
</html>
