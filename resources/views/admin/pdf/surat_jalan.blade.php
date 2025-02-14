<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Jalan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .header img {
            max-width: 100px;
            height: auto;
        }

        .header .title-container {
            flex: 1;
            text-align: center;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            font-style: italic;
        }

        .divider {
            border-bottom: 2px solid black;
            margin: 10px 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
        }

        .info-table td:first-child {
            width: 20%;
        }

        .info-table td:nth-child(2),
        .info-table td:nth-child(4) {
            width: 30%;
        }

        .info-table td:nth-child(3) {
            width: 20%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .notes {
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }

        .signature div {
            display: inline-block;
            width: 30%;
        }

        .signature .signature-line {
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <img src="{{ $logo }}" alt="Logo Perusahaan">
            <div>
                <div class="title">SURAT JALAN</div>
                <div class="subtitle">(Delivery Order)</div>
            </div>
        </div>

        <div class="divider"></div>

        <table class="info-table">
            <tr>
                <td><strong>Kepada Yth.</strong></td>
                <td></td>
                <td>No. SJ / DO :</td>
                <td>{{ $data['no_sj'] }}</td>
            </tr>
            <tr>
                <td>Customer :</td>
                <td>{{ $data['customer'] }}</td>
                <td>Tanggal :</td>
                <td>{{ $data['tanggal'] }}</td>
            </tr>
            <tr>
                <td>No HP/Telp :</td>
                <td>___________</td>
                <td>No. PO :</td>
                <td>{{ $data['no_po'] }}</td>
            </tr>
            <tr>
                <td>Alamat :</td>
                <td colspan="3">{{ $data['alamat'] }}</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA BARANG</th>
                    <th>UKURAN</th>
                    <th>JUMLAH</th>
                    <th>UNIT</th>
                    <th>KET.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td>{{ $item['no'] }}</td>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['ukuran'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>{{ $item['unit'] }}</td>
                        <td>{{ $item['keterangan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="notes">
            <p><strong>Perhatian:</strong></p>
            <ul>
                <li>Surat Jalan ini merupakan bukti resmi penerimaan barang.</li>
                <li>Surat Jalan ini akan dilengkapi invoice sebagai bukti penjualan.</li>
            </ul>
        </div>

        <div class="footer">
            <p>BARANG SUDAH DITERIMA DALAM KEADAAN BAIK DAN SESUAI DENGAN PESANAN.</p>
            <p><i>(Tanda tangan dan cap (stempel) perusahaan)</i></p>
        </div>

        <div class="signature">
            <div>
                <p>Diterima oleh,</p>
                <div class="signature-line"></div>
                <p>____________________</p>
            </div>
            <div>
                <p>Pengirim,</p>
                <div class="signature-line"></div>
                <p>____________________</p>
            </div>
            <div>
                <p>Dibuat oleh,</p>
                <div class="signature-line"></div>
                <p>____________________</p>
            </div>
        </div>
    </div>
</body>

</html>
