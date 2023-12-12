<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    const CREATE = 'create';

    /**
     * Determine whether the user can give reputation.
     */
    public function create(User $currentUser, User $otherUser): Response
    {
        return $currentUser->id !== $otherUser->id
            ? Response::allow()
            : Response::deny('You cannot send a message to yourself.');
    }
}
