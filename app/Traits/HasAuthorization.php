<?php

namespace App\Traits;

trait HasAuthorization
{
    /**
     * Check if the user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    /**
     * Check if the user has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user has a specific permission through their role.
     */
    public function hasPermissionThroughRole(string $permission): bool
    {
        foreach ($this->role->permissions as $rolePermission) {
            if ($rolePermission->name === $permission) {
                return true;
            }
        }

        return false;
    }
}
