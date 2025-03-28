<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generateSuratJalan($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $order = Order::find(decrypt($id));
        $order->load('orderItems');
        if (!$order->surat_jalan) {
            $suratJalan = 'SJ.' . str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d') . '%')->count() + 1, 3, '0', STR_PAD_LEFT) . '/MPB/' . date('m') . '/' . date('y');
            $invoice = 'IN.' . str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d') . '%')->count() + 1, 3, '0', STR_PAD_LEFT) . '/MPB-GM/' . date('m') . '/' . date('y');

            $order->surat_jalan = $suratJalan;
            $order->invoice = $invoice;
            $order->save();
        }

        return view('admin.pdf.surat_jalan', compact('order'));
    }

    public function invoice($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $order = Order::find(decrypt($id));
        if ($order->surat_jalan) {
            $suratJalan = 'SJ.' . str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d') . '%')->count() + 1, 3, '0', STR_PAD_LEFT) . '/MPB/' . date('m') . '/' . date('y');
            $invoice = 'IN.' . str_pad(Order::whereNotNull('surat_jalan')->where('created_at', 'like', date('Y-m-d') . '%')->count() + 1, 3, '0', STR_PAD_LEFT) . '/MPB-GM/' . date('m') . '/' . date('y');
            $order->surat_jalan = $suratJalan;
            $order->invoice = $invoice;
            $order->invoice_date = now();
            $order->save();
        }
        return view('admin.pdf.invoice', compact('order'));
    }

    public function paymentOrder(Request $request, $id)
    {
        $order = Order::find(decrypt($id));
        if (count($request->date) === 0) {
            return response()->json([
                "message" => "Data pembayaran tidak boleh kosong"
            ], 422);
        }

        foreach ($request->date as $key => $date) {
            $order->payments()->create([
                'method' => $request->metode[$key],
                'date' => Carbon::parse($request->date[$key])->toDateString() . ' ' . now()->toTimeString(),
                'amount' => $request->amount[$key],
                'remaining' => $request->remaining[$key],
                'customer' => $order->customer->name,
                'collector' => $request->collector[$key],
                'admin' => auth()->user()->name,
                'user_id' => $order->user_id,
                'customer_id' => $order->customer_id,
            ]);
        }

        if ($request->paid) {
            $order->paid = $request->paid;
            $order->save();
        }


        return response()->json([
            "message" => "Data berhasil disimpan"
        ]);
    }
}
