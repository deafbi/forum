<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Policies\TopicPolicy;
use Illuminate\Support\Facades\Auth;
use App\Jobs\IncrementTopicViewCount;
use App\Http\Requests\StoreTopicRequest;

class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Category $category)
    {
        $pinnedTopics = $category->topics()
            ->whereNull('subcategory_id')
            ->pinned()
            ->latest('created_at')
            ->get();

        $normalTopicsQuery = Topic::query()
            ->whereNull('subcategory_id')
            ->select('id', 'title', 'slug', 'post_count', 'view_count', 'user_id', 'category_id', 'pinned', 'created_at', 'deleted_at', 'is_hidden')
            ->where('category_id', $category->id)
            ->where('pinned', false)
            ->with('user:id,username,avatar')
            ->latest('created_at');
            // The rest of your query...

        $normalTopics = $normalTopicsQuery->paginate(10);

        return view('forum.topics.index', compact('category', 'pinnedTopics', 'normalTopics'));
    }

    public function subcategoryIndex(Category $category, Subcategory $subcategory)
    {
        $pinnedTopics = $subcategory->topics()
            ->pinned()
            ->latest('created_at')
            ->get();

            $normalTopicsQuery = Topic::query()
                ->where('subcategory_id', $subcategory->id)
                ->select('id', 'title', 'slug', 'post_count', 'view_count', 'user_id', 'category_id', 'pinned', 'created_at', 'deleted_at', 'is_hidden')
                ->where('category_id', $category->id)
                ->where('pinned', false)
                ->with('user:id,username,avatar')
                ->latest('created_at');

        if (!(auth()->user() && auth()->user()->hasRole('admin'))) {
            $normalTopicsQuery->where('is_hidden', false);
        }

        $normalTopics = $normalTopicsQuery->paginate(10);

        return view('forum.topics.index', compact('category', 'subcategory', 'pinnedTopics', 'normalTopics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $this->authorize(TopicPolicy::CREATE, Topic::class);

        $tags = Tag::getTags();

        return view('forum.topics.create', compact('category', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSubcategory(Category $category, Subcategory $subcategory)
    {
        $this->authorize(TopicPolicy::CREATE, Topic::class);

        $tags = Tag::getTags();

        return view('forum.topics.create', compact('category', 'subcategory', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $this->authorize(TopicPolicy::CREATE, Topic::class);

        // ! Locked, Pinned, Is_hidden should not be done like this and hasRole should not be hardcoded
        $topic = new Topic([
            'title' => $request->title,
            'locked' => auth()->user()->hasRole('admin') && $request->has('locked'),
            'pinned' => auth()->user()->hasRole('admin') && $request->has('pinned'),
            'is_hidden' => auth()->user()->hasRole('admin') && $request->has('is_hidden'),
        ]);

        if ($request->input('subcategory_id')) {
            $topic->subcategory_id = $request->input('subcategory_id');
        }

        // TODO: Move into action
        $topic->slug = Str::slug($topic->title) . '-' . Str::random(5);
        $topic->category()->associate($request->category_id);
        $topic->user()->associate(auth()->user());
        $topic->save();

        // TODO: Move into action
        $post = new Post([
            'content' => strip_tags($request->content),
        ]);

        $post->is_first_post = true;
        // Random slug with 5 characters
        $post->slug = Str::slug($topic->title) . '-' . Str::random(5);
        $post->user()->associate(auth()->user());
        $post->topic()->associate($topic);
        $post->save();

        if ($request->has('tags') && !empty($request->tags)) {
            // Attach the tag to the topic
            $topic->tags()->attach($request->tags);
        }

        return redirect()->route('topics.show', [$topic->category, $topic])->with('success', 'Topic created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category, Subcategory $subcategory = null, Topic $topic)
    {
        // $this->authorize(TopicPolicy::VIEW, Topic::class);

        // Get the logged in user
        $user = Auth::user();

        // TODO: Make sure that the view count only increment when a user hasn't viewed the topic before
        // Dispatch the job with the topic ID
        IncrementTopicViewCount::dispatch($topic->id, $user->id);

        return view('forum.topics.show', compact('category', 'topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Topic $topic)
    {
        $this->authorize(TopicPolicy::UPDATE, $topic);

        $tags = Tag::query()
            ->select('id', 'name')
            ->get();

        return view('forum.topics.edit', compact('category', 'topic', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, Topic $topic)
    {
        $this->authorize(TopicPolicy::UPDATE, $topic);

        // TODO: Move into a request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // TODO: Move into action
        $topic->title = $request->title;
        $topic->save();

        $post = $topic->posts()->first();
        $post->content = strip_tags($request->content);
        $post->save();

        if ($request->has('tags')) {
            $tags = array_filter($request->tags, function ($tag) {
                return !is_null($tag);
            });

            if (!empty($tags)) {
                $topic->tags()->sync($tags);
            }
        }

        return redirect()->route('topics.show', [$category, $topic]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Topic $topic)
    {
        $this->authorize(TopicPolicy::DELETE, $topic);

        $topic->delete();

        return redirect()->route('topics.index', $category);
    }
}
