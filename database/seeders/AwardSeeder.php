<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $awards = [
            [
                'name' => "Flame",
                'description' => "HQ Poster",
                'icon' => "https://i.imgur.com/h3J3vMU.png",
                'created_at' => now(),
            ],
            [
                'name' => "Wealthy",
                'description' => "Private Award.",
                'icon' => "https://i.imgur.com/3er1n7d.png",
                'created_at' => now(),
            ],
            [
                'name' => "Staff",
                'description' => "Official Staff Member",
                'icon' => "https://i.imgur.com/gNFsfmS.png",
                'created_at' => now(),
            ],
        ];

        $now = now();
        $awardData = [];

        foreach ($awards as $award) {
            $imagePath = $this->storeImage($award['icon']);

            $awardData[] = [
                'name' => $award['name'],
                'description' => $award['description'],
                'icon' => $imagePath,
                'created_at' => $now,
            ];
        }

        DB::table('awards')->insert($awardData);
    }

    private function storeImage($imageUrl)
    {
        $imageName = basename($imageUrl);
        $imagePath = 'public/awards/' . $imageName;

        // Check if the image is already cached
        if (Cache::has($imagePath)) {
            return Cache::get($imagePath);
        }

        $imageContent = file_get_contents($imageUrl);

        Storage::put($imagePath, $imageContent);

        // Cache the image path for a specific duration (e.g., 1 day)
        $cacheDuration = 60 * 24;
        Cache::put($imagePath, $imagePath, $cacheDuration);

        return $imagePath;
    }
}
