<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabs extends Component
{
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($id = null)
    {
        $this->id = $id ?? md5($this->attributes->get('href'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tabs');
    }
}
