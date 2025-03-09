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

    public function paymentOrder(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $order = Order::find(decrypt($id));
        foreach ($request->date as $key => $date) {
            $order->payments()->create([
                'method' => $request->method[$key],
                'date' => Carbon::parse($request->date[$key])->toDateString() . ' ' . now()->toTimeString(),
                'amount' => $request->amount[$key],
                'remaining' => $request->remaining[$key],
                'customer' => $request->customer[$key],
                'collector' => $request->collector[$key],
                'admin' => $request->admin[$key],
                'user_id' => $order->user_id,
            ]);
        }

        return redirect()->route('invoice', encrypt($order->id));
    }
}
