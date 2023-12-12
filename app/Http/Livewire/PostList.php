<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Topic;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PostList extends Component
{
    use WithPagination;

    public $topicId;

    protected $listeners = ['setReplyTo', 'PostCreated' => 'updatePosts'];

    public function mount($topicId)
    {
        $this->topicId = $topicId;
    }

    public function isFirstPost(Post $post)
    {
        return $post->id === Topic::find($this->topicId)->posts()->oldest('created_at')->first()->id;
    }

    public function updatePosts()
    {
        $this->resetPage();
    }

    public function setReplyTo($username)
    {
        $this->emit('setReplyTo', $username);
    }

    protected function postsQuery()
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID

        return Post::query()
            ->where('topic_id', $this->topicId)
            ->with([
                'user:id,username,avatar,avatar_bg,post_count,topic_count,title,signature,username_color,credit,created_at,show_displayed_group,display_group_id,is_banned',
                'user.roles',
                'user.displayedGroup',
                'user.awards',
                'user.groups',
                'user.reputations',
                'user.vouches',
                'topic:id,slug,category_id',
                'likes' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])
            ->withCount('likes')
            ->orderBy('created_at', 'asc')
            ->paginate(10);
    }

    public function render()
    {
        $posts = $this->postsQuery();
        $currentPage = $posts->currentPage();
        $perPage = 10;

        $category = Category::query()
            ->select('id', 'name', 'slug', 'created_at')
            ->find($this->topicId);

        $topic = Topic::query()
            ->select('id', 'title', 'slug', 'user_id', 'category_id', 'pinned', 'created_at', 'deleted_at', 'is_hidden')
            ->find($this->topicId);

        return view('livewire.post-list', [
            'replies' => $posts,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'category' => $category,
            'topic' => $topic,
        ])->with('category', $category);
    }
}
