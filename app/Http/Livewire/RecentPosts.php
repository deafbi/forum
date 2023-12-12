<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;

class RecentPosts extends Component
{
    public function render()
    {
        // TODO Don't hardcode the take
        $recentPosts = Post::with('user')
            ->where('is_first_post', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('livewire.recent-posts', compact('recentPosts'));
    }
}
