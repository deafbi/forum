<?php

namespace App\Http\Livewire;

use App\Models\Tab;
use Livewire\Component;
use App\Models\Category;

class ForumTabs extends Component
{
    public $tabs;
    public $activeTab;

    public function mount()
    {
        $this->tabs = $this->getTabsWithSectionsAndCategories();
        $this->activeTab = $this->tabs->first()->slug;
    }

    public function updateContainerHeight($height)
    {
        $this->emit('updateContainerHeight', $height);
    }

    // TODO fix this, it looks ugly.
    private function getTabsWithSectionsAndCategories()
    {
        return Tab::query()
            ->with([
                'sections.categories' => function ($query) {
                    $query->whereNull('parent_id')
                        ->with([
                            'subcategories',
                            'topics' => function ($query) {
                                $query->select('id', 'title', 'slug', 'user_id', 'category_id', 'pinned', 'created_at', 'deleted_at', 'is_hidden')
                                    ->with([
                                        'posts' => function ($query) {
                                            $query->latest('created_at')
                                                ->select('id', 'topic_id', 'user_id', 'created_at');
                                        },
                                        'posts.user' => function ($query) {
                                            $query->select('id', 'username', 'avatar', 'username_color', 'created_at', 'is_banned')
                                                ->with(['roles']); // Include the user's roles here
                                        },
                                    ]);
                            },
                        ]);
                },
            ])
            ->get();
    }

    public function setActiveTab($tabSlug)
    {
        $this->activeTab = $tabSlug;
    }

    public function render()
    {
        return view('livewire.forum-tabs');
    }
}
