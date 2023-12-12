<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;
use App\Services\AuthorizationService;

class TopicPolicy
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
     * Determine whether the user can view the topic.
     */
    public function view(User $user): bool
    {
        return $this->authorizationService->hasPermission($user, 'view_topics');
    }

    /**
     * Determine whether the user can create topics.
     */
    public function create(User $user): bool
    {
        return $this->authorizationService->hasPermission($user, 'create_topics');
    }

    /**
     * Determine whether the user can update the topic.
     */
    public function update(User $user, Topic $topic): bool
    {
        return $topic->user_id === $user->id && $this->authorizationService->hasPermission($user, 'update_topics');
    }

    /**
     * Determine whether the user can delete the topic.
     */
    public function delete(User $user, Topic $topic): bool
    {
        return $this->authorizationService->hasPermission($user, 'delete_topics');
    }
}
