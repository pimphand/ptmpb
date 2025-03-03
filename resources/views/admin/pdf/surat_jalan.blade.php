<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 16px;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

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
            list-style: none;
            padding: 0;
            margin: 0;
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

        /* Print media query */
        @media print {
            @page {
                size: A4;
                margin: 2px;
            }

            table {
                border-collapse: collapse;
            }

            #printButton, .watermark {
                display: none;
            }
        }
    </style>
</head>
<body>
<!-- Watermark -->
<div class="watermark" style="text-align: center">Asli <br> PT Mandalika Putra Bersama</div>

<div class="header-container">
    <div class="logo">
        <img src="{{asset('logo.webp')}}" alt="Logo">
    </div>
    <div class="header-text" style="font-size: 18px">
        <h1>SURAT JALAN</h1>
        <p>(Delivery Order)</p>
    </div>
</div>

<br><br>

<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td style="text-align: left; vertical-align: top; width: 50%;border:none">
            <p><strong>Kepada Yth.</strong></p>
            <table style="width: 100%;font-size: 12px">
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
            <table style="width: 100%;font-size: 12px">
                <tr>
                    <td style="border:none;text-align: center;">No. SJ / DO</td>
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

<br><br>

<table style="width: 100%; border-collapse: collapse; font-size: 12px">
    <tr style="background-color: #f2f2f2;">
        <th width="5%">NO</th>
        <th width="30%">NAMA BARANG</th>
        <th width="10%">UKURAN</th>
        <th width="10%">JUMLAH</th>
        <th width="10%">UNIT</th>
        <th width="35%">KET.</th>
    </tr>

    @foreach($order->orderItems as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->sku->name }} ({{ $item->sku->product?->name }})</td>
            <td>{{ $item->packaging }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->unit }}</td>
            <td>{{ $item->note }}</td>
        </tr>
    @endforeach
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
<br><br>

<table style="margin-top: 30px; text-align: center; width: 100%;">
    <tr>
        <th width="25%" style="text-align: center;">Diterima oleh,</th>
        <th width="25%" style="text-align: center;">Pengirim,</th>
        <th width="25%" style="text-align: center;">Gudang,</th>
        <th width="25%" style="text-align: center;">Admin,</th>
    </tr>
    <tr>
        <td style="text-align: center;"><br><br><br><br>______________</td>
        <td style="text-align: center;"><br><br><br><br>{{$order->driver->name ?? "Belum Ada Driver"}}</td>
        <td style="text-align: center;"><br><br><br><br>______________</td>
        <td style="text-align: center;"><br><br><br><br>{{Auth::user()->name ?? "Admin"}}</td>
    </tr>
</table>
<div style="text-align: center; margin-top: 50px;">
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{route('generateSuratJalan',encrypt($order->id))}}" alt="QR Code">
</div>
<!-- Print Button -->
<button id="printButton" hidden="" onclick="window.print()">Print Surat Jalan</button>

<script type="text/javascript">
    window.print();
    // window.onmousemove = function () {
    //     window.close();
    // }
</script>
</body>
</html>
