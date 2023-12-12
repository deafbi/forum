<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Make a icon svg array from https://heroicons.com/
        $icon = [
            'academic-cap' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l-9 5 9 5 9-5-9-5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12h20v8H2v-8z" />
            </svg>',
            'adjustments' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7M5 9l7 7 7-7" />
            </svg>',
        ];

        $slug = Str::random(10);

        return [
            'slug' => $slug,
            'icon' => $icon[array_rand($icon)],
            'name' => $this->faker->word,
            'tab' => $this->faker->word,
        ];
    }
}
