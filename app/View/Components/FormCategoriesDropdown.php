<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCategoriesDropdown extends Component
{

    public $subcat_id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cat=0)
    {
        $this->subcat_id = $cat;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.form-categories-dropdown',
            ['categories' => Category::with('subcategories')->orderBy('name', 'asc')->get()]);
    }
}
