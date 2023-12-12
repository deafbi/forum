<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => "Upgrade 1",
                'slug' => "upgrade-1",
                'description' => "Upgrade 1",
                'group_avatar' => 'https://i.imgur.com/8432ixT.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Upgrade 2",
                'slug' => "upgrade-2",
                'description' => "Upgrade 2",
                'group_avatar' => 'https://i.imgur.com/TsefHNq.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Jungle",
                'slug' => "jungle",
                'description' => "Jungle",
                'group_avatar' => 'https://i.imgur.com/qcoFVWb.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "CyberPunk",
                'slug' => "cyberpunk",
                'description' => "CyberPunk",
                'group_avatar' => 'https://i.imgur.com/DhQtL5K.gif',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Crypto",
                'slug' => "crypto",
                'description' => "Crypto",
                'group_avatar' => 'https://i.imgur.com/wxaFRkb.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Wealty",
                'slug' => "wealthy",
                'description' => "Wealty",
                'group_avatar' => 'https://i.imgur.com/pjyqsCa.gif',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Void",
                'slug' => "void",
                'description' => "void",
                'group_avatar' => 'https://i.imgur.com/Wm6up9C.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Solar",
                'slug' => "solar",
                'description' => "Solar",
                'group_avatar' => 'https://i.imgur.com/zWGHozE.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "EXCLUSIVE",
                'slug' => "exclusive",
                'description' => "EXCLUSIVE",
                'group_avatar' => 'https://i.imgur.com/HcbbBEH.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Verified",
                'slug' => "verified",
                'description' => "Crypto",
                'group_avatar' => 'https://i.imgur.com/x1Icu16.png',
                'owner_id' => '1',
                'created_at' => now(),
            ],
            [
                'name' => "Trusted",
                'slug' => "trusted",
                'description' => "trusted",
                'group_avatar' => 'https://i.imgur.com/unaajKI.png',
                'owner_id' => '1',
                'created_at' => now(),
            ]
        ];
        foreach ($groups as $group) {
            $imagePath = $this->storeGroupAvatar($group['group_avatar']);

            DB::table('groups')->insert([
                'name' => $group['name'],
                'slug' => $group['slug'],
                'description' => $group['description'],
                'group_avatar' => $imagePath,
                'owner_id' => $group['owner_id'],
                'created_at' => now(),
            ]);
        }
    }

    private function storeGroupAvatar($imageUrl)
    {
        $imageName = basename($imageUrl);
        $imagePath = 'public/groups/' . $imageName;

        // Check if the image is already cached
        if (Cache::has($imagePath)) {
            return Cache::get($imagePath);
        }

        $imageContent = file_get_contents($imageUrl);

        // Save the image to the public storage folder
        Storage::disk('public')->put($imagePath, $imageContent);

        // Cache the image path for a specific duration
        $cacheDuration = 60 * 24;
        Cache::put($imagePath, $imagePath, $cacheDuration);

        return $imagePath;
    }
}
