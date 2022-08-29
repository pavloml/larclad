<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Type of alert
     * @var string
     */
    public string $type;


    /**
     * An alert message
     * @var string
     */
    public string $message;


    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function __construct($type,  $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.alert');
    }
}
