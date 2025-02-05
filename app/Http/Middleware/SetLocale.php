<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Cek apakah ada parameter "lang" di URL
        if ($request->has('lang')) {
            $locale = $request->get('lang');

            // Simpan locale ke dalam session
            Session::put('locale', $locale);
        }

        // Gunakan locale dari session atau default ke "en"
        $locale = Session::get('locale', 'en');
        App::setLocale($locale);

        return $next($request);
    }
}
