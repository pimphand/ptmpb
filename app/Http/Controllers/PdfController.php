<?php

namespace App\Http\Controllers;

use App\Models\Order;

class PdfController extends Controller
{
    public function generateSuratJalan($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $order = Order::find(decrypt($id));
        $order->load('orderItems');
        if (! $order->surat_jalan) {
            $suratJalan = 'SJ.'.str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d').'%')->count() + 1, 3, '0', STR_PAD_LEFT).'/MPB/'.date('m').'/'.date('y');
            $invoice = 'IN.'.str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d').'%')->count() + 1, 3, '0', STR_PAD_LEFT).'/MPB-GM/'.date('m').'/'.date('y');

            $order->surat_jalan = $suratJalan;
            $order->invoice = $invoice;
            $order->save();
        }

        return view('admin.pdf.surat_jalan', compact('order'));
    }

    public function invoice($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $order = Order::find(decrypt($id));
        $order->load('orderItems');
        if (! $order->surat_jalan) {
            $suratJalan = 'SJ.'.str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d').'%')->count() + 1, 3, '0', STR_PAD_LEFT).'/MPB/'.date('m').'/'.date('y');
            $invoice = 'IN.'.str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d').'%')->count() + 1, 3, '0', STR_PAD_LEFT).'/MPB-GM/'.date('m').'/'.date('y');

            $order->surat_jalan = $suratJalan;
            $order->invoice = $invoice;
            $order->save();
        }

        return view('admin.pdf.invoice', compact('order'));
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
