<?php

namespace App\View\Components;

use App\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CitiesDropdown extends Component
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
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.cities-dropdown',  ['cities' => City::orderBy('name', 'asc')->get()]);
    }
}
