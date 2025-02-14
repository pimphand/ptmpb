<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    public function generateSuratJalan()
    {
        $data = [
            'customer' => 'Nama Customer',
            'no_sj' => 'SJ.001/MPB/2/25',
            'tanggal' => now()->format('d F Y'),
            'alamat' => 'Alamat Customer',
            'no_po' => 'PO001',
            'items' => [
                ['no' => 1, 'nama_barang' => 'Barang A', 'ukuran' => 'M', 'jumlah' => 10, 'unit' => 'pcs', 'keterangan' => '-'],
            ],
        ];
        $logo = $this->getImage('logo.png');
        $options = new Options;
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // dd($pdf);

        return $pdf->stream('surat_jalan.pdf');
    }

    public function getImage($path)
    {
        $filePath = public_path($path);
        if (! file_exists($filePath)) {
            return ''; // Jika file tidak ditemukan, hindari error
        }
        $type = pathinfo($filePath, PATHINFO_EXTENSION);
        $data = file_get_contents($filePath);

        return 'data:image/'.$type.';base64,'.base64_encode($data);
    }
}
