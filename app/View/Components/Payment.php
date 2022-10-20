<?php

namespace App\View\Components;

use App\Models\PaymentSource;
use Illuminate\View\Component;

class Payment extends Component
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
        $payments=PaymentSource::all();
        return view('components.payment',['payments'=>$payments]);
    }
}
