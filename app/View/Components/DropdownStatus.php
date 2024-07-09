<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownStatus extends Component
{
    public $selected;

    public function __construct($selected = null)
    {
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.dropdown-status');
    }
}
