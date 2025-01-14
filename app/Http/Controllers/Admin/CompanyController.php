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
}
