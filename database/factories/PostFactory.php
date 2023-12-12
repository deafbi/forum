<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random hex key for slug
        $slug = Str::random(10);

        return [
            'slug' => $slug,
            'content' => $this->faker->paragraph,
            'user_id' => \App\Models\User::factory(),
            'topic_id' => \App\Models\Topic::factory(),
        ];
    }
}
