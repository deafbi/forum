<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use App\Models\Category;
use App\Actions\CreatePost;
use Illuminate\Support\Str;
use App\Policies\PostPolicy;
use App\Http\Requests\StorePostRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Category $category, Topic $topic)
    {
        $this->authorize(PostPolicy::CREATE, Post::class);

        if ($topic->locked) {
            return back()->with('error', 'This topic is locked and you cannot post in it.');
        }

        $topic = Topic::findOrFail($request->input('topic_id'));

        // TODO Move to an action
        $post = new Post([
            'content' => strip_tags($request->content),
        ]);

        $post->slug = Str::slug($topic->title) . '-' . Str::random(5);
        $post->is_first_post = false;
        $post->user()->associate(auth()->user());
        $post->topic()->associate($topic);
        $post->save();

        $this->notifyMentionedUsers($post);

        $perPage = 10; // Items per page (use the same value as in your PostList component)
        $totalPosts = $topic->posts()->count();
        $newPostPage = ceil($totalPosts / $perPage);

        // return redirect()->route('topics.show', ['category' => $topic->category->slug, 'topic' => $topic->slug, 'page' => $newPostPage]) . '#post-' . $post->id;

        return Redirect::to(route('topics.show', ['category' => $topic->category->slug, 'topic' => $topic->slug, 'page' => $newPostPage]) . '#post-' . $post->id)->with('message', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic, Post $post)
    {
        $this->authorize(PostPolicy::UPDATE, $post);

        $isFirstPost = $post->id === $topic->posts()->oldest('created_at')->first()->id;

        return view('forum.posts.edit', [
            'post' => $post,
            'topic' => $topic,
            'category' => $topic->category,
            'isFirstPost' => $isFirstPost,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showPost(Topic $topic, Post $post)
    {
        // $this->authorize(PostPolicy::VIEW, Post::class);

        $topic->load('posts.user', 'tags');

        $position = $topic->posts->search(function ($item) use ($post) {
            return $item->id == $post->id;
        });

        $postsPerPage = 10;
        $page = ceil(($position + 1) / $postsPerPage);

        return view('forum.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize(PostPolicy::UPDATE, $post);

        $this->updatePostContent($request, $post);

        if ($request->input('is_first_post') === "1" && auth()->user()->hasRole('admin')) {
            $this->updateTopicAttributes($request, $post->topic);
        }

        return redirect()->route('topics.show', [$post->topic->category, $post->topic])->with('success', 'Your post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize(PostPolicy::DELETE, $post);

        $post->delete();

        return redirect()->route('topics.show', ['category' => $post->topic->category->slug, 'topic' => $post->topic->slug])->with('success', 'Your post has been deleted.');
    }

    /**
     * Notify mentioned users.
     */
    private function notifyMentionedUsers($post)
    {
        preg_match_all('/@([a-zA-Z0-9_-]+)/', $post->content, $matches);

        if (!empty($matches[1])) {
            $mentionedUsernames = $matches[1];
            $mentionedUsers = User::whereIn('username', $mentionedUsernames)->get();

            // TODO move to an action
            foreach ($mentionedUsers as $mentionedUser) {
                $notification = new Notification();
                $notification->user_id = $mentionedUser->id;
                $notification->post_id = $post->id;
                $notification->content = 'You were mentioned in a post.';
                $notification->save();
            }
        }
    }


    private function updatePostContent($request, $post)
    {
        // TODO move to its own request
        $request->validate([
            'content' => 'required|min:3',
        ]);

        // TODO move to an action
        $post->content = strip_tags($request->content);
        $post->save();
    }

    private function updateTopicAttributes($request, $topic)
    {
        // TODO move to an action
        $topic->title = $request->input('title');
        $topic->is_hidden = $request->input('is_hidden') === "1";
        $topic->locked = $request->input('locked') === "1";
        $topic->pinned = $request->input('pinned') === "1";
        $topic->save();
    }
}
