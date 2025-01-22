<?php

namespace App\View\Components;

use App\Models\Gallery;
use App\Models\Image;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{

    protected $title;
    protected $banner;
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
        return view('components.banner', [
            'title' => $this->title,
        ]);
    }
}
