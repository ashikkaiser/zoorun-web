<?php

namespace App\View\Components;

use App\Models\District;
use Illuminate\View\Component;

class DistrictSelect extends Component
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
        $districts = District::where('status', true)->get();
        return view('components.district-select', compact('districts'));
    }
}
