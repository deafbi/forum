<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Services\AuthorizationService;

class PostPolicy
{
    private $authorizationService;

    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    /**
     * Create a new policy instance.
     */
    public function __construct(AuthorizationService $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }

    // /**
    //  * Perform checks before any other policy methods
    //  */
    // public function before(User $user, $ability): ?bool
    // {
    //     if ($this->authorizationService->hasRole($user, 'admin')) {
    //         return true;
    //     }
    // }

    /**
     * Determine whether the user can view the post.
     */
    public function create(User $user): bool
    {
        return $this->authorizationService->hasPermission($user, 'create_posts');
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $post->user_id === $user->id && $this->authorizationService->hasPermission($user, 'update_posts');
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        $hasPermission = $this->authorizationService->hasPermission($user, 'delete_posts');
        return $hasPermission;
    }
}
