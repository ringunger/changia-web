<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BeemCheckout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $amount = null;
    public $number = null;
    public $reference = null;
    public function __construct($amount = null, $number = null, $reference = null)
    {
        $this->amount = $amount;
        $this->number = $number;
        $this->reference = $reference;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.beem-checkout');
    }
}
