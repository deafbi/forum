<?php

namespace App\Services;

use App\Models\User;

class AuthorizationService
{
    /**
     * Check if the user has a specific role
     */
    public function hasRole(User $user, string $role): bool
    {
        return $user->roles->contains('name', $role);
    }

    /**
     * Check if the user has a specific permission
     */
    public function hasPermission(User $user, string $permission): bool
    {
        foreach ($user->roles as $role) {
            if($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user has a specific permission through their role.
     */
    public function hasPermissionThroughRole(User $user, string $permission): bool
    {
        foreach ($user->role->permissions as $rolePermission) {
            if ($rolePermission->name === $permission) {
                return true;
            }
        }

        return false;
    }
}
