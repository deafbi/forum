<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class LatestTopics extends Component
{
    use WithPagination;

    public $filterSeen = false;

    protected function topicsQuery()
    {
        $query = Topic::where('created_at', '>=', Carbon::now()->subDay());

        if ($this->filterSeen && auth()->user()) {
            $query = $query->whereDoesntHave('views', function ($viewQuery) {
                $viewQuery->where('user_id', auth()->user()->id);
            });
        }

        return $query->with('user')->orderBy('created_at', 'desc');
    }

    public function render()
    {
        return view('livewire.latest-topics', [
            'topics' => $this->topicsQuery()->paginate(10),
        ]);
    }
}
