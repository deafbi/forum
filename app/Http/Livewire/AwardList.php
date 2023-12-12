<?php

namespace App\Http\Livewire;

use App\Models\Award;
use Livewire\Component;
use Livewire\WithPagination;

class AwardList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.award-list', [
            'awards' => Award::paginate(20),
        ]);
    }
}
