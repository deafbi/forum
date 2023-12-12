<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPosts extends Component
{
    use WithPagination;

    public $search = '';
    public $page = 1;
    protected $queryString = ['search'];
    public $category;

    // public function mount($category)
    // {
    //     $this->category = $category;
    // }

    public function resetFilters()
    {
        $this->reset('search');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $topics = $this->search == ''
            ? collect() // Return an empty collection when there's no search term
            : Topic::where('title', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.search-posts', [
            'topics' => $topics,
        ]);
    }
}
