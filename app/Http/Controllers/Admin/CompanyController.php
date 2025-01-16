<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function contact()
    {
        return view('admin.company.contact', [
            'title' => 'Kontak',
            'contact' => About::where('type', 'contact')->first()
        ]);
    }

    public function storeContact(Request $request)
    {
        $data = [
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];

        About::updateOrCreate(['type' => 'contact'], [
            'data' => $data,
            'content' => $request->map,
            'title' => "Kontak",
            'type' => 'contact'
        ]);

        return [
            'message' => 'Data berhasil disimpan'
        ];
    }
}
