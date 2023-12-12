<?php

namespace App\Actions;

use App\Models\Post;
use App\Actions\BaseAction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Models\Topic;

final class CreatePost extends BaseAction
{
    private Topic $topic;
    private ?Post $parent;
    private string $content;

    public function __construct(Topic $topic, ?Post $parent, string $content)
    {
        $this->topic = $topic;
        $this->parent = $parent;
        $this->content = $content;
    }

    protected function transact()
    {
        return Post::query()->create(
            attributes: [
                'content' => strip_tags($this->content),
                'user_id' => auth()->id(),
                'topic_id' => $this->topic->id,
                'parent_id' => $this->parent?->id,
                'slug' => Str::random(10),
            ],
        );
    }
}
