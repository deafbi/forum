<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'shop'],
            ['name' => 'help'],
            ['name' => 'source'],
            ['name' => 'news'],
        ];

        DB::table('tags')->insert($tags);
    }
}
