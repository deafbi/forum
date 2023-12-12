<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // public function view(User $user): bool
    // {
    //     return $user->can('view users') || $user->can('manage users');
    // }

    public function create(User $user): bool
    {
        return $user->can('create users');
    }

    public function update(User $user, $subject): bool
    {
        return $user->can('update users');
    }

    public function delete(User $user, $subject): bool
    {
        return $user->can('delete users');
    }
}
