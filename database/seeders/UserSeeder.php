<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'is_banned' => 0,
                'role' => 'admin',
            ],
            [
                'username' => 'member',
                'password' => Hash::make('member'),
                'is_banned' => 0,
                'role' => 'member',
            ],
            [
                'username' => 'banned',
                'password' => Hash::make('banned'),
                'is_banned' => 1,
                'role' => 'member',
            ],
        ];

        $userData = [];
        $now = now();

        foreach ($users as $user) {
            $createdUser = User::create([
                'username' => $user['username'],
                'password' => $user['password'],
                'is_banned' => $user['is_banned'],
            ]);

            $role = Role::where('name', $user['role'])->first();
            $createdUser->roles()->attach($role);
        }

        DB::table('users')->insert($userData);

        \App\Models\User::factory()->count(500)->create();
    }
}
