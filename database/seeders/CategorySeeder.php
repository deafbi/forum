<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tabs = [
            [
                'name' => 'General',
                'sections' => [
                    [
                        'name' => 'Site News & Information',
                        'categories' => [
                            [
                                'name' => 'Announcements',
                                'subcategories' => [
                                    'Important',
                                    'Events',
                                ],
                            ],
                            [
                                'name' => 'Updates',
                                'subcategories' => [
                                    'New Features',
                                    'Bug Fixes',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'General Discussion',
                        'categories' => [
                            [
                                'name' => 'Discussion',
                                'subcategories' => [
                                    'Happy',
                                    'Sad',
                                ],
                            ],
                            [
                                'name' => 'Ideas',
                                'subcategories' => [
                                    'Approved',
                                    'Rejected',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Programming',
                'sections' => [
                    [
                        'name' => 'Languages',
                        'categories' => [
                            [
                                'name' => 'Python',
                                'subcategories' => [
                                    'Web Frameworks',
                                    'Data Science',
                                    'Machine Learning',
                                ],
                            ],
                            [
                                'name' => 'JavaScript',
                                'subcategories' => [
                                    'Frontend Frameworks',
                                    'Backend Frameworks',
                                    'Libraries',
                                ],
                            ],
                            [
                                'name' => 'Java',
                                'subcategories' => [
                                    'Android Development',
                                    'Enterprise Applications',
                                    'Desktop Applications',
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'Tools & Technologies',
                        'categories' => [
                            [
                                'name' => 'Version Control',
                                'subcategories' => [
                                    'Git',
                                    'Mercurial',
                                    'Subversion',
                                ],
                            ],
                            [
                                'name' => 'Databases',
                                'subcategories' => [
                                    'SQL',
                                    'NoSQL',
                                    'NewSQL',
                                ],
                            ],
                            [
                                'name' => 'DevOps',
                                'subcategories' => [
                                    'CI/CD',
                                    'Infrastructure as Code',
                                    'Monitoring & Logging',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $now = now();

        foreach ($tabs as $tabData) {
            $tabId = DB::table('tabs')->insertGetId([
                'name' => $tabData['name'],
                'slug' => $this->generateSlug($tabData['name']),
                'created_at' => $now,
            ]);

            foreach ($tabData['sections'] as $sectionData) {
                $sectionId = DB::table('sections')->insertGetId([
                    'name' => $sectionData['name'],
                    'slug' => $this->generateSlug($sectionData['name']),
                    'tab_id' => $tabId,
                    'created_at' => $now,
                ]);

                foreach ($sectionData['categories'] as $categoryData) {
                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $categoryData['name'],
                        'slug' => $this->generateSlug($categoryData['name']),
                        'icon' => $categoryData['icon'] ?? null,
                        'section_id' => $sectionId,
                        'created_at' => $now,
                    ]);

                    foreach ($categoryData['subcategories'] as $subcategoryName) {
                        DB::table('subcategories')->insert([
                            'name' => $subcategoryName,
                            'slug' => $this->generateSlug($subcategoryName),
                            'category_id' => $categoryId,
                            'created_at' => $now,
                        ]);
                    }
                }
            }
        }
    }

    private function generateSlug($name)
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
