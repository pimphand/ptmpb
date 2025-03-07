<?php

namespace App\View\Components\Home;

use App\Models\Gallery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $banners = Gallery::where('type', 'slide-banner')->get();

        return view('components.home.slider', compact('banners'));
    }
}
