<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LikePolicy
{
    const CREATE = 'create';


    /**
     * Determine whether the user can like a post.
     */
    public function create(User $user, Post $post): Response
    {
        return $user->id !== $post->user_id
            ? Response::allow()
            : Response::deny('You cannot like your own post.');
    }
}
