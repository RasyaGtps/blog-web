<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.app-layout');
    }
}
