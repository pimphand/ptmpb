<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .header-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .header-left { text-align: left; }
        .header-right { text-align: right; }
        .invoice-title { font-size: 24px; font-weight: bold; text-align: right; }
        .info-table td { border: none; padding: 5px 0; }
        .product-table th, .product-table td { text-align: center; }
        .note-section { font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>
<div class="header-container">
    <div class="header-left">
        <img src="{{asset('logo.webp')}}" alt="Logo" style="width:100px;">
        <p>Komplek Warga Rahayu Blok E4/E5<br>Kab. Garut Jawa Barat<br>Indonesia</p>
    </div>
    <div class="header-right">
        <p class="invoice-title">Invoice</p>
        <p><strong>Tanggal:</strong> {{ date('d M Y') }}</p>
        <p><strong>No Invoice:</strong> {{$order->invoice_number}}</p>
        <p><strong>Surat Jalan:</strong> {{$order->delivery_note}}</p>
    </div>
</div>
<h3>Kepada : {{$order->customer->store_name}}</h3>
<table class="product-table">
    <tr>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>@Harga</th>
        <th>Diskon</th>
        <th>Total Harga</th>
    </tr>
    @php
        $subTotal = 0;

        function terbilang($angka) {
            $angka = abs($angka);
            $bilangan = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

            if ($angka < 12) {
                return " " . $bilangan[$angka];
            } elseif ($angka < 20) {
                return terbilang($angka - 10) . " belas";
            } elseif ($angka < 100) {
                return terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
            } elseif ($angka < 200) {
                return " seratus" . terbilang($angka - 100);
            } elseif ($angka < 1000) {
                return terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
            } elseif ($angka < 2000) {
                return " seribu" . terbilang($angka - 1000);
            } elseif ($angka < 1000000) {
                return terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
            } elseif ($angka < 1000000000) {
                return terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
            } elseif ($angka < 1000000000000) {
                return terbilang($angka / 1000000000) . " miliar" . terbilang($angka % 1000000000);
            } else {
                return "Angka terlalu besar";
            }
        }

    @endphp
   @foreach($order->orderItems as $item)
        <tr>
            <td>{{$item->sku->product->name}} ({{$item->sku->product->name}})</td>
            <td>{{$item->quantity}}</td>
            <td>Rp. {{number_format($item->price)}}</td>
            <td>Rp. {{$item->discount ? number_format($item->discount) : "0"}}</td>
            <td>Rp. {{number_format((int)$item->quantity*(int)$item->price)}}</td>
        </tr>

        @php
            $subTotal += (int)$item->quantity*(int)$item->price;
        @endphp
   @endforeach
</table>
<br>
<table>
    <tr>
        <td style="width: 30%; text-align: center; border: none;">Customer / Penerima,</td>
        <td style="width: 30%; text-align: center; border: none;">Admin,</td>
        <td><strong>Sub Total</strong></td>
        <td>Rp. {{$subTotal ? number_format($subTotal)  : "0"}}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>Diskon</strong></td>
        <td>Rp. {{$order->discount ? number_format($order->discount)  : "0"}}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>PPN ({{$order->tax_percentage}}%)</strong></td>
        <td>Rp. {{$order->tax_amount? number_format($order->tax_amount) : 0}}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>Biaya Lain-lain</strong></td>
        <td>Rp. {{$order->other_fees? number_format($order->other_fees) : 0}}</td>
    </tr>
    <tr>
        <td style="border: none;"></td>
        <td style="border: none;"></td>
        <td><strong>Total</strong></td>
        <td>Rp. {{number_format($subTotal)}}</td>
    </tr>
</table>
<p><strong>Terbilang : {{ucfirst(trim(terbilang($subTotal))) . " rupiah."}} </strong></p>
<div class="note-section">
    <p><strong>NOTE:</strong></p>
    <ol>
        <li>Pembayaran dianggap sah setelah di transfer ke rekening:<br>Bank Permata a/c. 4175142008 a/n PT Mandalika Putra Bersama</li>
        <li>Pembayaran dengan CEK DAN GIRO dianggap sah setelah Cek/Giro tersebut dapat diuangkan</li>
    </ol>
</div>
<h4>Rincian</h4>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Kas/Trf</th>
        <th>Nominal</th>
        <th>Sisa</th>
        <th>Customer</th>
        <th>Kolektor</th>
        <th>Admin</th>
    </tr>
    <!-- Loop details -->
</table>
</body>
</html>
