<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner()
    {
        $banners = Gallery::with('image')
            ->where('type', 'slide-banner')
            ->get();
        return response()->json($banners);
    }
}
