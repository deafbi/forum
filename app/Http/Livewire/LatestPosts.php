<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class LatestPosts extends Component
{
    use WithPagination;

    public function render()
    {
        $latestPosts = Post::where('is_first_post', 0)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->paginate(10);

        return view('livewire.latest-posts', ['latestPosts' => $latestPosts]);
    }
}
