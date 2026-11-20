<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Specialized Tour Package',
                'icon' => 'assets/images/cat-specialized.webp',
                'description' => 'Customized specialized travel programs tailored for enthusiasts, researchers, and special interest groups.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Festival Packages',
                'icon' => 'assets/images/cat-festival.webp',
                'description' => 'Experience the color, rhythm, and vibrant cultural traditions of festivals across Bengal and beyond.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Ancestral Tours',
                'icon' => 'assets/images/cat-ancestral.webp',
                'description' => 'Trace your roots and reconnect with heritage villages, historical homesteads, and lineage milestones.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Family Packages',
                'icon' => 'assets/images/cat-family.webp',
                'description' => 'Relaxed, child-friendly, and multigenerational holidays with premium comfort and seamless transport.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Trekking Packages',
                'icon' => 'assets/images/cat-trekking.webp',
                'description' => 'Challenging peak expeditions and rainforest trail trekking through Bandarban and Rangamati hill tracts.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Photography Tours',
                'icon' => 'assets/images/cat-photography.webp',
                'description' => 'Guided photography expeditions to golden hour viewpoints, riverine life, wildlife, and heritage spots.',
                'sort_order' => 6,
            ],
            [
                'name' => 'Documentary Tours',
                'icon' => 'assets/images/cat-documentary.webp',
                'description' => 'Logistical support and permit facilitation for filmmakers, journalists, and scientific documentary crews.',
                'sort_order' => 7,
            ],
            [
                'name' => 'Bird Watching Tours',
                'icon' => 'assets/images/cat-bird.webp',
                'description' => 'Explore wetlands, haor basins, and tropical forests home to hundreds of migratory and indigenous bird species.',
                'sort_order' => 8,
            ],
            [
                'name' => 'Inbound Tour Packages',
                'icon' => 'assets/images/cat-inbound.webp',
                'description' => 'Comprehensive Bangladesh travel packages for international visitors with Japanese and English-speaking guides.',
                'sort_order' => 9,
            ],
            [
                'name' => 'Outbound Tour Packages',
                'icon' => 'assets/images/cat-outbound.webp',
                'description' => 'Curated vacations to Japan, Singapore, Thailand, and premier international destinations.',
                'sort_order' => 10,
            ],
            [
                'name' => 'Domestic Tour Packages',
                'icon' => 'assets/images/cat-domestic.webp',
                'description' => 'Short breaks and holiday packages across Bangladesh’s beaches, hill tracts, rivers, and tea estates.',
                'sort_order' => 11,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                    'sort_order' => $cat['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
