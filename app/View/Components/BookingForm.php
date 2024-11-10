<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookingForm extends Component
{
    /**
     * Create a new component instance.
     */

    public $car;

    public function __construct($car)
    {
        $this->car = $car;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.booking-form');
    }
}
