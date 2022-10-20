<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Loge extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $loges = \App\Models\Loge::all();
        return view('components.loge', ['loges' => $loges]);
    }
}
