<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles and their permissions
        $rolesAndPermissions = [
            'admin' => [
                'manage_forum',
                'manage_topics',
                'manage_posts',
                'update_users',
                'edit_users',
                'delete_users',
                'manage_roles',
                'manage_permissions',
                'create_topics',
                'create_posts',
                'edit_own_topics',
                'edit_own_posts',
            ],
            'moderator' => [
                'manage_topics',
                'manage_posts',
                'update_users',
                'edit_users',
                'create_topics',
                'create_posts',
                'edit_own_topics',
                'edit_own_posts',
            ],
            'member' => [
                'create_topics',
                'create_posts',
                'edit_own_topics',
                'edit_own_posts',
            ],
        ];

        // Create permissions
        $permissions = collect($rolesAndPermissions)->flatten()->unique();
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Create roles and attach permissions
        foreach ($rolesAndPermissions as $roleName => $permissions) {
            $role = Role::create([
                'name' => $roleName,
                'display_name' => ucfirst($roleName),
                'description' => ucfirst($roleName) . ' role',
            ]);

            $permissionIds = Permission::whereIn('name', $permissions)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }
    }
}
