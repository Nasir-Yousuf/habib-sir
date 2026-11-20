<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'The Sundarbans',
                'country' => 'Bangladesh',
                'tagline' => 'UNESCO World Heritage Mangrove Forest',
                'description' => "Explore the world's largest mangrove forest, home of the majestic Royal Bengal Tiger, mystical tidal waterways, and unspoiled wilderness. Experience eco-cruises on chartered river cruisers with local naturalist guides.",
                'banner_image' => 'assets/images/sundorbon.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Srimangal (Tea Garden)',
                'country' => 'Bangladesh',
                'tagline' => 'Emerald Rolling Hills & Rainforests',
                'description' => "Immerse yourself in Srimangal’s lush green rolling hills, aromatic estates, indigenous Manipuri and Khasia cultures, and tranquil Lawachara rainforest sanctuary.",
                'banner_image' => 'assets/images/tea-garden.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Kaptai Lake & Rangamati',
                'country' => 'Bangladesh',
                'tagline' => 'Serene Hill Tracts & Turquoise Waters',
                'description' => 'Sail through turquoise waters embraced by emerald peaks in Rangamati, witnessing vibrant tribal lifestyle, the hanging bridge, and magical lakeside sunsets.',
                'banner_image' => 'assets/images/kaptai-lake.png',
                'is_featured' => true,
            ],
            [
                'name' => "Cox's Bazar",
                'country' => 'Bangladesh',
                'tagline' => "World's Longest Natural Sea Beach",
                'description' => 'Feel the golden sand under your feet across 120 uninterrupted kilometers of gentle waves, coastal seafood, marine drive views, and breathtaking sunsets over the Bay of Bengal.',
                'banner_image' => 'assets/images/hero-coxs-bazar.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Bandarban Hill District',
                'country' => 'Bangladesh',
                'tagline' => 'Mist-Covered Cloud Peaks & Waterfalls',
                'description' => 'Discover the highest peaks of Bangladesh, including Nilgiri, Boga Lake, and Nafakhum falls, combined with the warmth of indigenous hill communities.',
                'banner_image' => 'assets/images/package-5.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Japan (Tokyo, Kyoto, Fukuoka)',
                'country' => 'Japan',
                'tagline' => 'Land of Rising Sun, Tradition & Modernity',
                'description' => 'Journey across iconic Tokyo skylines, historic temples of Kyoto, Mount Fuji panoramas, and Fukuoka gastronomy with seamless Japanese logistics and hospitality.',
                'banner_image' => 'assets/images/package-1.webp',
                'is_featured' => true,
            ],
            [
                'name' => 'Singapore',
                'country' => 'Singapore',
                'tagline' => 'Garden City of Modern Architecture',
                'description' => 'Discover Marina Bay Sands, Gardens by the Bay, Sentosa Island, and world-class retail and culinary culture in one of the safest cities in the world.',
                'banner_image' => 'assets/images/package-2.jpg',
                'is_featured' => true,
            ],
        ];

        foreach ($destinations as $dest) {
            Destination::updateOrCreate(
                ['slug' => Str::slug($dest['name'])],
                $dest
            );
        }
    }
}
