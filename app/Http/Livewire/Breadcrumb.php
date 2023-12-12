<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $category;
    public $subcategory;
    public $topic;

    public function render()
    {
        return view('livewire.breadcrumb');
    }
}
