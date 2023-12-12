<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeStoreRequest;
use App\Http\Requests\StoreLikeRequest;
use App\Models\Like;
use App\Models\Post;
use App\Policies\LikePolicy;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $user = auth()->user();
        $this->authorize(LikePolicy::CREATE, [$user, $post]);

        $existingLike = $this->findExistingLike($user, $post);
        if ($existingLike) {
            return redirect()->back()->with('error', 'You have already liked this post.');
        }

        $this->createLike($user, $post);

        return redirect()->back()->with('message', 'Post liked successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        $user = auth()->user();
        $this->authorize(LikePolicy::CREATE, $post);

        $existingLike = $this->findExistingLike($user, $post);
        if (!$existingLike) {
            return redirect()->back()->with('error', 'You have not liked this post yet.');
        }

        $existingLike->delete();

        return redirect()->back()->with('message', 'Post unliked successfully.');
    }

    /**
     * Find an existing like.
     */
    private function findExistingLike($user, $post)
    {
        return Like::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();
    }

    /**
     * Create a new like.
     */
    private function createLike($user, $post)
    {
        // TODO Move to an action
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();
    }
}
