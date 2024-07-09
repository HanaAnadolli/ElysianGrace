<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RichTextEditor extends Component
{
    public $id;
    public $name;

    /**
     * Create a new component instance.
     *
     * @param  string  $id
     * @param  string  $name
     * @return void
     */
    public function __construct($id = null, $name = null)
    {
        $this->id = $id ?? 'defaultId';
        $this->name = $name ?? 'defaultName';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rich-text-editor');
    }
}

