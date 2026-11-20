<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $blogs = [
            [
                'title' => 'The Sundarbans Mangrove Forest: A Global Treasure and Wildlife Sanctuary',
                'category' => 'Eco Tourism',
                'featured_image' => 'assets/images/blog-1.webp',
                'excerpt' => 'The Sundarbans is the world\'s largest continuous mangrove forest and a UNESCO World Heritage site, spanning across southwestern Bangladesh. Discover its rare biodiversity and conservation journey.',
                'content' => 'The Sundarbans delta is formed by the confluence of the Padma, Brahmaputra, and Meghna rivers across the Bay of Bengal. Covering approximately 10,000 square kilometers, with 60% situated in Bangladesh, it supports a unique ecosystem comprising 334 plant species, 400 Royal Bengal Tigers, saltwater crocodiles, and the endangered Ganges and Irrawaddy river dolphins. Visiting the Sundarbans aboard a chartered eco-cruiser offers an unparalleled immersion into nature where tidal creeks ebb and flow twice daily.',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Discovering Seamless Journeys with Bongo Tanbo Travels',
                'category' => 'Travel Insights',
                'featured_image' => 'assets/images/blog-2.webp',
                'excerpt' => 'Finding a travel agency that understands your unique wanderlust is like finding a hidden gem. Learn how our Bangladesh–Japan joint venture delivers precision and warm hospitality.',
                'content' => 'Traveling is more than visiting famous monuments; it is about feeling safe, respected, and enriched at every single milestone. At Bongo Tanbo Travels, we bridge Japanese organizational meticulousness—punctuality, safety, and curated comfort—with the legendary warmth of Bangladeshi hospitality. Whether navigating remote tribal trails or coordinating seamless Shinkansen passes in Japan, our dedicated ground teams ensure every detail is handled flawlessly.',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Outstanding Service Experience with Bongo Tanbo Travels',
                'category' => 'Customer Stories',
                'featured_image' => 'assets/images/blog-3.webp',
                'excerpt' => '“I am truly impressed by the level of service provided by Bongo Tanbo Travels.” From start to finish, our bespoke itinerary was carried out with extraordinary attention to detail.',
                'content' => 'When international travel resumed, our 12-member cultural delegation booked the 12 Days Village Culture and Archaeology Tour. From airport arrival in Dhaka with smiling coordinators to the specialized guides at Paharpur Somapura Mahavihara and the peaceful houseboats of the Sundarbans, every single aspect exceeded our expectations. The meals were fresh, hygienic, and authentic, and emergency vehicle support was always on standby.',
                'published_at' => now()->subDays(18),
            ],
            [
                'title' => 'An Effortless and Enjoyable Journey with Bongo Tanbo Travels',
                'category' => 'Destinations',
                'featured_image' => 'assets/images/blog-4.webp',
                'excerpt' => 'From the very first consultation, their team was incredibly friendly, responsive, and professional. Discover why travelers choose us for custom family holidays.',
                'content' => 'Planning a multi-generational family vacation can be stressful—balancing the energy of young children with the comfort needed for grandparents. Bongo Tanbo Travels crafted a bespoke itinerary that combined gentle tea garden strolls in Srimangal, comfortable private transport with child safety seating, and a relaxing beachfront stay in Cox’s Bazar. We did not have to worry about a single ticket, hotel check-in, or meal reservation.',
                'published_at' => now()->subDays(25),
            ],
        ];

        foreach ($blogs as $post) {
            Blog::updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'user_id' => $admin?->id,
                    'title' => $post['title'],
                    'category' => $post['category'],
                    'featured_image' => $post['featured_image'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'is_published' => true,
                    'published_at' => $post['published_at'],
                ]
            );
        }
    }
}
