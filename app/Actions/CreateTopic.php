<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\Topic;
use App\Actions\BaseAction;
use App\Models\Category;
use Illuminate\Support\Str;

final class CreateTopic extends BaseAction
{
    private Category $category;
    private string $title;
    private string $content;

    public function __construct(Category $category, string $title, string $content)
    {
        $this->category = $category;
        $this->title = $title;
        $this->content = $content;
    }

    protected function transact()
    {
        $topic = Topic::query()->create(
            attributes: [
                'title' => $this->title,
                'user_id' => auth()->id(),
                'category_id' => $this->category->id,
                'slug' => Str::random(10),
            ],
        );


    }
}
