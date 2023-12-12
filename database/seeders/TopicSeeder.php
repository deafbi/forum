<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Models\Category::all() as $category) {
            for ($i = 0; $i < 10; $i++) {
                $topic = \App\Models\Topic::factory()->create([
                    'category_id' => $category->id,
                    'user_id' => \App\Models\User::all()->random()->id,
                ]);

                for ($i = 0; $i < 11; $i++) {
                    \App\Models\Post::factory()->create([
                        'topic_id' => $topic->id,
                        'user_id' => \App\Models\User::all()->random()->id,
                    ]);
                }
            }
        }
    }
}
