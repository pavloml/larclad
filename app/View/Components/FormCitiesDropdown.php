<?php

namespace App\View\Components;

use App\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCitiesDropdown extends Component
{

    public $city_id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($city=0)
    {
        $this->city_id = $city;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.form-cities-dropdown', ['cities' => City::orderBy('name', 'asc')->get()]);
    }
}
