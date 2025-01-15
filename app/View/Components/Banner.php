<?php

namespace App\View\Components;

use App\Models\Gallery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{

    protected $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title = "Home")
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $banner = Gallery::where("title", $this->title)->first();
        return view('components.banner', [
            'title' => $this->title,
            'banner' => $banner ?? []
        ]);
    }
}
