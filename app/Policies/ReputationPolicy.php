<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReputationPolicy
{
    const CREATE = 'create';

    /**
     * Determine whether the user can give reputation.
     */
    public function create(User $currentUser, User $otherUser): Response
    {
        return $currentUser->id !== $otherUser->id
            ? Response::allow()
            : Response::deny('You cannot give reputation to yourself.');
    }
}
