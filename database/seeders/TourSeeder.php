<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourItinerary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $japanDest = Destination::where('slug', 'japan-tokyo-kyoto-fukuoka')->first();
        $singaporeDest = Destination::where('slug', 'singapore')->first();
        $sundarbanDest = Destination::where('slug', 'the-sundarbans')->first();
        $srimangalDest = Destination::where('slug', 'srimangal-tea-garden')->first();
        $coxsDest = Destination::where('slug', 'coxs-bazar')->first();

        $outboundCat = Category::where('slug', 'outbound-tour-packages')->first();
        $inboundCat = Category::where('slug', 'inbound-tour-packages')->first();
        $specialCat = Category::where('slug', 'specialized-tour-package')->first();
        $festivalCat = Category::where('slug', 'festival-packages')->first();
        $domesticCat = Category::where('slug', 'domestic-tour-packages')->first();

        $toursData = [
            [
                'title' => 'Japan Standard Tour Itinerary',
                'slug' => 'japan-standard-tour-itinerary',
                'category_id' => $outboundCat?->id,
                'destination_id' => $japanDest?->id,
                'duration_days' => 7,
                'duration_nights' => 6,
                'places_count' => 4,
                'starting_price' => 185000,
                'badge_text' => 'Outbound Favorite',
                'overview' => 'Experience the harmonious contrast between ultra-modern neon-lit skylines and serene ancient Shinto shrines across Tokyo, Mount Fuji, Kyoto, and Fukuoka. Designed with Japanese precision and Bangladeshi personal care.',
                'inclusions' => ['4-Star Hotel Accommodation', 'Bullet Train (Shinkansen) Passes', 'English & Japanese Speaking Guide', 'Daily Breakfast & Select Dinners', 'All Temple & Sightseeing Entry Fees'],
                'exclusions' => ['International Airfare', 'Personal Shopping & Souvenirs', 'Travel Insurance (Available upon request)'],
                'difficulty' => 'Easy',
                'featured_image' => 'assets/images/package-1.webp',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival in Tokyo (Narita/Haneda)', 'desc' => 'Airport pickup and transfer to central Tokyo hotel. Orientation and welcome dinner in Shinjuku.', 'hotel' => 'Tokyo Prince Hotel', 'meals' => 'Dinner'],
                    ['day' => 2, 'title' => 'Tokyo Highlights & Asakusa Sensoji', 'desc' => 'Visit Senso-ji temple, Nakamise shopping street, Tokyo Skytree, and Shibuya crossing.', 'hotel' => 'Tokyo Prince Hotel', 'meals' => 'Breakfast, Lunch'],
                    ['day' => 3, 'title' => 'Mount Fuji & Lake Kawaguchi', 'desc' => 'Scenic drive to 5th Station of Mt. Fuji, lake cruise, and panoramic ropeway cable car.', 'hotel' => 'Fuji View Ryokan', 'meals' => 'Breakfast, Kaiseki Dinner'],
                    ['day' => 4, 'title' => 'Bullet Train to Cultural Kyoto', 'desc' => 'Shinkansen ride at 300 km/h to Kyoto. Afternoon at Fushimi Inari thousand torii gates.', 'hotel' => 'Kyoto Grand Hotel', 'meals' => 'Breakfast'],
                    ['day' => 5, 'title' => 'Kinkaku-ji (Golden Pavilion) & Arashiyama', 'desc' => 'Explore the Golden Pavilion, Arashiyama Bamboo Grove, and Tenryuji Zen gardens.', 'hotel' => 'Kyoto Grand Hotel', 'meals' => 'Breakfast, Lunch'],
                    ['day' => 6, 'title' => 'Fukuoka Exploration & Canal City', 'desc' => 'Flight or train to Fukuoka. Visit Kushida Shrine, Ohori Park, and renowned Hakata Ramen stalls.', 'hotel' => 'Hotel Nikko Fukuoka', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 7, 'title' => 'Fukuoka Departure', 'desc' => 'Free morning for shopping at Tenjin. Transfer to Fukuoka International Airport for departure.', 'hotel' => null, 'meals' => 'Breakfast'],
                ]
            ],
            [
                'title' => '5 Days Singapore Standard Tour Package',
                'slug' => '5-days-singapore-standard-tour-package',
                'category_id' => $outboundCat?->id,
                'destination_id' => $singaporeDest?->id,
                'duration_days' => 5,
                'duration_nights' => 4,
                'places_count' => 3,
                'starting_price' => 95000,
                'badge_text' => 'Family Special',
                'overview' => 'A dynamic family journey exploring the dazzling cityscape of Singapore, including Sentosa Island, Universal Studios, and the Supertree Grove light show.',
                'inclusions' => ['3-4 Star City Center Accommodation', 'Airport Transfers', 'Universal Studios 1-Day Pass', 'Gardens by the Bay Double Conservatories Ticket', 'Half-day City Tour with English Guide'],
                'exclusions' => ['Air Tickets', 'Personal Meals not mentioned', 'Visa Fee'],
                'difficulty' => 'Easy',
                'featured_image' => 'assets/images/package-2.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival & Night Safari', 'desc' => 'Arrive at Changi Airport. Evening tram ride through Singapore Night Safari.', 'hotel' => 'Hotel Boss Singapore', 'meals' => 'Dinner'],
                    ['day' => 2, 'title' => 'Gardens by the Bay & Marina Bay Sands', 'desc' => 'Explore Flower Dome, Cloud Forest waterfall, and observation deck views.', 'hotel' => 'Hotel Boss Singapore', 'meals' => 'Breakfast'],
                    ['day' => 3, 'title' => 'Full Day Universal Studios Sentosa', 'desc' => 'Enjoy rollercoasters, immersive film sets, and Cable Car ride across Sentosa harbor.', 'hotel' => 'Hotel Boss Singapore', 'meals' => 'Breakfast'],
                    ['day' => 4, 'title' => 'Singapore Cultural Trail & River Cruise', 'desc' => 'Chinatown, Little India, Merlion Park photo stop, and historic Clarke Quay boat cruise.', 'hotel' => 'Hotel Boss Singapore', 'meals' => 'Breakfast, Lunch'],
                    ['day' => 5, 'title' => 'Jewel Changi & Departure', 'desc' => 'Visit HSBC Rain Vortex at Jewel Changi before boarding flight back home.', 'hotel' => null, 'meals' => 'Breakfast'],
                ]
            ],
            [
                'title' => 'Bangladesh Cultural Discovery Tour',
                'slug' => 'bangladesh-cultural-discovery-tour',
                'category_id' => $inboundCat?->id,
                'destination_id' => $srimangalDest?->id,
                'duration_days' => 8,
                'duration_nights' => 7,
                'places_count' => 11,
                'starting_price' => 45000,
                'badge_text' => 'Inbound Signature',
                'overview' => 'An authentic immersion into the arts, crafts, rivers, and traditions of Bangladesh. Covers Old Dhaka Mughal architecture, Sonargaon ancient capital, Srimangal tea valleys, and Mahasthangarh archaeological excavations.',
                'inclusions' => ['Private AC Minibus with Driver', 'Expert Government Licensed Guide', 'All Entry Permits & Heritage Fees', 'Standard Boutique Eco-Resort Stays', 'Authentic Local Bengali & Tribal Meals'],
                'exclusions' => ['Personal Laundry & Beverages', 'Gratuities for Guide & Driver'],
                'difficulty' => 'Easy',
                'featured_image' => 'assets/images/package-3.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Welcome to Dhaka - The City of Mosques', 'desc' => 'Lalbagh Fort, Ahsan Manzil Pink Palace, and rickshaw ride through Shankharia Bazar.', 'hotel' => 'Pan Pacific Sonargaon', 'meals' => 'Lunch, Dinner'],
                    ['day' => 2, 'title' => 'Panam City & Folk Art Museum Sonargaon', 'desc' => 'Walk through 19th-century merchant mansions at Panam Nagar and Zainul Abedin Folk Art Museum.', 'hotel' => 'Grand Sultan Tea Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 3, 'title' => 'Srimangal Green Tea Terraces & Lawachara', 'desc' => 'Trek Lawachara National Park to spot Hoolock Gibbon; visit Manipuri handloom village.', 'hotel' => 'Grand Sultan Tea Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 4, 'title' => 'Baikka Beel Bird Sanctuary', 'desc' => 'Early morning bird watching tower in wetlands; taste the famous Seven Layer Tea.', 'hotel' => 'Grand Sultan Tea Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 5, 'title' => 'Drive to Bogura via Jamuna Bridge', 'desc' => 'Cross the great Jamuna river. Visit Mahasthangarh, the 3rd-century BC ancient citadel of Pundranagar.', 'hotel' => 'Momo Inn Bogura', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 6, 'title' => 'Somapura Mahavihara (UNESCO Heritage Paharpur)', 'desc' => 'Excursion to the massive 8th-century Buddhist monastery at Paharpur, one of the greatest in Asia.', 'hotel' => 'Momo Inn Bogura', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 7, 'title' => 'Kantanagar Terracotta Temple, Dinajpur', 'desc' => 'Marvel at thousands of intricate medieval terracotta relief tiles depicting Ramayana stories.', 'hotel' => 'Momo Inn Bogura', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 8, 'title' => 'Return to Dhaka & Farewell Banquet', 'desc' => 'Scenic return drive with river ferry crossing. Farewell dinner in Dhaka.', 'hotel' => null, 'meals' => 'Breakfast, Dinner'],
                ]
            ],
            [
                'title' => 'Bangladesh Shaktipeeth Pilgrimage Tour',
                'slug' => 'bangladesh-shaktipeeth-pilgrimage-tour',
                'category_id' => $specialCat?->id,
                'destination_id' => $srimangalDest?->id,
                'duration_days' => 7,
                'duration_nights' => 6,
                'places_count' => 10,
                'starting_price' => 38000,
                'badge_text' => 'Pilgrimage Special',
                'overview' => 'A deeply spiritual pilgrimage covering the revered Shakti Peethas in Bangladesh, including Sugandha, Chattal (Sitakunda), Bhabanipur, Jayanti, and Sri Sail.',
                'inclusions' => ['Dedicated AC Transport throughout', 'Temple Puja Arrangements & Purohit Assistance', 'Clean Pure-Veg Meals & Accommodations', 'Experienced Pilgrimage Coordinator'],
                'exclusions' => ['Personal Puja offerings & Dakshina', 'Airfare to/from Dhaka'],
                'difficulty' => 'Moderate',
                'featured_image' => 'assets/images/package-4.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Dhaka Dhakeshwari National Temple', 'desc' => 'Darshan at Dhakeshwari National Temple and Ramna Kali Mandir.', 'hotel' => 'Hotel 71 Dhaka', 'meals' => 'Lunch, Dinner'],
                    ['day' => 2, 'title' => 'Journey to Sitakunda Chandranath Hill', 'desc' => 'Travel to Chattogram. Climb the sacred Chandranath hill to visit the Chattal Shaktipeeth.', 'hotel' => 'The Peninsula Chittagong', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 3, 'title' => 'Adinath Temple Maheshkhali Island', 'desc' => 'Speedboat transfer to Maheshkhali island to offer prayers at Mainak hill shrine.', 'hotel' => 'The Peninsula Chittagong', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 4, 'title' => 'Bhabanipur Shaktipeeth Bogura', 'desc' => 'Darshan and holy dip at the Shakha-pukur pond of Aparajita goddess at Bhabanipur.', 'hotel' => 'Hotel Castle Soad Bogura', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 5, 'title' => 'Sri Sail Shaktipeeth Sylhet', 'desc' => 'Travel to Jainpur, Sylhet to visit the neck relic site of Goddess Sati.', 'hotel' => 'Rose View Hotel Sylhet', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 6, 'title' => 'Jayanti Shaktipeeth Jaintiapur', 'desc' => 'Scenic drive to Jaintiapur ancient kingdom near Meghalaya border. Special evening puja.', 'hotel' => 'Rose View Hotel Sylhet', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 7, 'title' => 'Return to Dhaka & Blessings Consecration', 'desc' => 'Return to Dhaka with blessed prasad distribution.', 'hotel' => null, 'meals' => 'Breakfast'],
                ]
            ],
            [
                'title' => '7 Days Bangladesh Standard Tour',
                'slug' => '7-days-bangladesh-standard-tour',
                'category_id' => $domesticCat?->id,
                'destination_id' => $sundarbanDest?->id,
                'duration_days' => 7,
                'duration_nights' => 6,
                'places_count' => 12,
                'starting_price' => 35000,
                'badge_text' => 'Popular Tour',
                'overview' => 'The ideal introductory journey covering Dhaka, ancient Bagerhat Sixty Dome Mosque (UNESCO), and a 3-day deep river cruise through the Sundarbans mangrove forest.',
                'inclusions' => ['3-Day Sundarbans Charter Boat Stay with Private Cabin', 'Forest Department Armed Guard & Permits', 'All Meals Onboard Boat', 'AC Transport for Highway transfers', 'Experienced Naturalist'],
                'exclusions' => ['Camera Drone Fees', 'Soft Drinks & Personal Items'],
                'difficulty' => 'Easy',
                'featured_image' => 'assets/images/package-5.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Dhaka Heritage & River Life', 'desc' => 'Old Dhaka walking tour and evening overnight luxury paddle steamer (Rocket) cruise.', 'hotel' => 'Historic Rocket Steamer Cabin', 'meals' => 'Dinner'],
                    ['day' => 2, 'title' => 'Bagerhat Sixty Dome Mosque to Mongla', 'desc' => 'Arrive in Khulna, explore Sixty Dome Mosque and Khan Jahan Ali Tomb. Board Sundarbans cruise vessel.', 'hotel' => 'Tourist Cruise Vessel', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 3, 'title' => 'Kotka Wildlife Sanctuary & Jamtola Beach', 'desc' => 'Silent rowboat canal cruise in morning; deer and tiger pugmark trail trek to wild beach.', 'hotel' => 'Tourist Cruise Vessel', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 4, 'title' => 'Kachikhali & Harbaria Eco-Tourism Station', 'desc' => 'Canal safari through thick mangrove roots; watchtower wildlife observation.', 'hotel' => 'Tourist Cruise Vessel', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 5, 'title' => 'Karamjal Crocodile & Dolphin Watch', 'desc' => 'Visit Karamjal eco center, witness freshwater Irrawaddy dolphins at river confluence.', 'hotel' => 'City Inn Khulna', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 6, 'title' => 'Scenic Drive across Padma Bridge to Dhaka', 'desc' => 'Drive over Bangladesh’s engineering marvel, the Padma Multipurpose Bridge.', 'hotel' => 'Dhaka Regency Hotel', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 7, 'title' => 'Dhaka Souvenir Shopping & Departure', 'desc' => 'Visit Aarong craft center and transfer to airport.', 'hotel' => null, 'meals' => 'Breakfast'],
                ]
            ],
            [
                'title' => '10 Days Bangladesh Standard Tour',
                'slug' => '10-days-bangladesh-standard-tour',
                'category_id' => $inboundCat?->id,
                'destination_id' => $coxsDest?->id,
                'duration_days' => 10,
                'duration_nights' => 9,
                'places_count' => 13,
                'starting_price' => 52000,
                'badge_text' => 'Comprehensive',
                'overview' => 'An expansive travel itinerary linking the green tea slopes of Srimangal, the golden beaches of Cox’s Bazar, and the tranquil tribal waterways of Kaptai Lake.',
                'inclusions' => ['Domestic Flights (Dhaka-Sylhet, Coxs-Dhaka)', 'All 3 & 4 Star Resort Accommodations', 'Private Lake Cruise Boat', 'Daily Breakfast & All Guided Tours'],
                'exclusions' => ['Water Sports at Beach', 'Personal Expenses'],
                'difficulty' => 'Easy',
                'featured_image' => 'assets/images/package-6.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival in Dhaka', 'desc' => 'Hotel check-in and evening welcome banquet.', 'hotel' => 'Westin Dhaka', 'meals' => 'Dinner'],
                    ['day' => 2, 'title' => 'Dhaka to Srimangal Tea Country', 'desc' => 'Scenic train ride through rural paddies to tea capital Srimangal.', 'hotel' => 'Dusai Resort', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 3, 'title' => 'Srimangal Rainforest & Tribal Villages', 'desc' => 'Lawachara nature hike and Khasia betel leaf farmers community visit.', 'hotel' => 'Dusai Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 4, 'title' => 'Sylhet Shrines & Lalakhal Blue River', 'desc' => 'Hazrat Shah Jalal shrine and emerald boat cruise on Lalakhal river.', 'hotel' => 'Nazimgarh Wilderness', 'meals' => 'Breakfast, Lunch'],
                    ['day' => 5, 'title' => 'Flight to Chittagong & Rangamati', 'desc' => 'Fly to coastal south and drive into the green hills of Rangamati.', 'hotel' => 'Rangamati Waterfront Resort', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 6, 'title' => 'Kaptai Lake & Shuvolong Waterfall', 'desc' => 'Wooden boat cruise on Kaptai lake, Chakma tribal weaving market, and waterfall.', 'hotel' => 'Rangamati Waterfront Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 7, 'title' => 'Bandarban Golden Temple & Nilachal', 'desc' => 'Drive to Bandarban; sunset view from Nilachal 2,000 feet above valley clouds.', 'hotel' => 'Sairu Hill Resort', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 8, 'title' => 'Marine Drive to Cox’s Bazar', 'desc' => 'Scenic ocean drive along the longest marine road in Asia to Cox’s Bazar.', 'hotel' => 'Sayeman Beach Resort', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 9, 'title' => 'Himchari & Inani Coral Beach', 'desc' => 'Explore Himchari national park waterfall and walk on natural coral boulders at Inani.', 'hotel' => 'Sayeman Beach Resort', 'meals' => 'Breakfast, Lunch'],
                    ['day' => 10, 'title' => 'Morning Surf & Flight to Dhaka', 'desc' => 'Beachside morning and 45-minute flight to Dhaka for international connection.', 'hotel' => null, 'meals' => 'Breakfast'],
                ]
            ],
            [
                'title' => '10 Days Bangladesh Discovery Tour',
                'slug' => '10-days-bangladesh-discovery-tour',
                'category_id' => $specialCat?->id,
                'destination_id' => $sundarbanDest?->id,
                'duration_days' => 10,
                'duration_nights' => 9,
                'places_count' => 13,
                'starting_price' => 56000,
                'badge_text' => 'Eco Adventure',
                'overview' => 'Tailored for true wildlife and adventure enthusiasts: combine the deep Sundarbans tiger habitat cruise with the pristine southern island of Saint Martin and hill treks.',
                'inclusions' => ['Sundarbans Private Cruise Vessel', 'Ship to Saint Martins Island', 'All Forest Permits & Armed Guards', 'Beachfront Coral Cottages', 'All Meals & Guided Hikes'],
                'exclusions' => ['Scuba Diving Gear Rental', 'Tips & Personal Sundries'],
                'difficulty' => 'Moderate',
                'featured_image' => 'assets/images/package-7.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Dhaka Arrival & Old City Life', 'desc' => 'Explore Armenian Church, Tara Masjid, and Buriganga river harbor.', 'hotel' => 'InterContinental Dhaka', 'meals' => 'Dinner'],
                    ['day' => 2, 'title' => 'Overnight Steamer to Sundarbans Gateway', 'desc' => 'Mighty Meghna and Padma rivers cruise aboard colonial Rocket steamer.', 'hotel' => 'Steamer 1st Class Cabin', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 3, 'title' => 'Board Cruise Ship at Mongla', 'desc' => 'Enter Sundarbans reserve forest; Harbaria eco walk.', 'hotel' => 'Sundarbans Cruise Ship', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 4, 'title' => 'Kotka Tiger Point & Virgin Coastline', 'desc' => 'Silent sunrise paddle boat expedition and beach trek.', 'hotel' => 'Sundarbans Cruise Ship', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 5, 'title' => 'Kachikhali & Bay of Bengal Estuary', 'desc' => 'Otter fishing community and wild deer meadow sightings.', 'hotel' => 'Sundarbans Cruise Ship', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 6, 'title' => 'Exit Forest to Barisal Backwaters', 'desc' => 'Floating guava market canoe tour through small canal villages.', 'hotel' => 'Grand Park Barisal', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 7, 'title' => 'Highway to Cox’s Bazar', 'desc' => 'Travel south along the Bay of Bengal coastline.', 'hotel' => 'Ocean Paradise Coxs Bazar', 'meals' => 'Breakfast, Dinner'],
                    ['day' => 8, 'title' => 'Cruise to Saint Martin’s Coral Island', 'desc' => 'Sea cruise to the only coral island of Bangladesh; coconut groves and turquoise surf.', 'hotel' => 'Coral View Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 9, 'title' => 'Chhera Dwip Uninhabited Island Trek', 'desc' => 'Trek to the southernmost tip of Bangladesh; snorkeling among live corals.', 'hotel' => 'Coral View Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 10, 'title' => 'Return Cruise & Flight to Dhaka', 'desc' => 'Return ship to Teknaf, transfer to Cox’s Bazar airport for flight to Dhaka.', 'hotel' => null, 'meals' => 'Breakfast'],
                ]
            ],
            [
                'title' => '12 Days Village Culture, Archaeology & Heritage Tour',
                'slug' => '12-days-village-culture-archaeology-heritage-tour',
                'category_id' => $festivalCat?->id,
                'destination_id' => $srimangalDest?->id,
                'duration_days' => 12,
                'duration_nights' => 11,
                'places_count' => 7,
                'starting_price' => 68000,
                'badge_text' => 'Grand Odyssey',
                'overview' => 'Our flagship heritage expedition. Explore ancient Buddhist university ruins, medieval Islamic terracotta mosques, brass artisan villages, river weavers, and indigenous tea communities.',
                'inclusions' => ['Dedicated AC Luxury Coaster/Minibus', 'Accommodations in Best Available Heritage Lodges', 'All UNESCO Site Admissions & Archaeological Guides', 'Full Board Meal Plan (B, L, D)', 'Cultural Music Performance Evening'],
                'exclusions' => ['International Airfare', 'Personal Shopping'],
                'difficulty' => 'Easy',
                'featured_image' => 'assets/images/package-8.jpg',
                'is_featured' => true,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival in Dhaka', 'desc' => 'Transfer to hotel and cultural briefing.', 'hotel' => 'Amari Dhaka', 'meals' => 'Dinner'],
                    ['day' => 2, 'title' => 'Mughal & Colonial Dhaka', 'desc' => 'Curzon Hall, Lalbagh Fort, Star Mosque, and Ahsan Manzil.', 'hotel' => 'Amari Dhaka', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 3, 'title' => 'Jamdani Weaving Village & Sonargaon', 'desc' => 'Observe master weavers weaving intricate UNESCO Intangible Heritage Jamdani sarees.', 'hotel' => 'Grand Sultan Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 4, 'title' => 'Srimangal Tea Estates & Khasia Punji', 'desc' => 'Tea plucking experience with local tea garden workers and tasting session.', 'hotel' => 'Grand Sultan Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 5, 'title' => 'Lawachara Forest & Madhabkunda Fall', 'desc' => 'Forest hike and excursion to Bangladesh’s highest single-drop waterfall.', 'hotel' => 'Grand Sultan Resort', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 6, 'title' => 'Tangail Brass Metal Artisans Village', 'desc' => 'Visit traditional lost-wax brass casting workshops in Dhamrai and Tangail handloom.', 'hotel' => 'Momo Inn Bogura', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 7, 'title' => 'Paharpur Somapura Mahavihara', 'desc' => 'Full day exploring the UNESCO 8th-century Buddhist monastery, stupas, and museum.', 'hotel' => 'Momo Inn Bogura', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 8, 'title' => 'Puthia Temple City & Rajshahi Silk', 'desc' => 'Govinda terracotta temple and Shiva temple in Puthia palace estate; visit silk cocoon weavers.', 'hotel' => 'Grand Riverview Rajshahi', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 9, 'title' => 'Kushtia - Lalon Fakir Shrine & Rabindranath Tagore Lodge', 'desc' => 'Baul mystic music session at Lalon Shah shrine; visit Nobel Laureate Tagore’s Shilaidaha Kuthibari.', 'hotel' => 'City Inn Khulna', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 10, 'title' => 'Bagerhat Sixty Dome Mosque Complex', 'desc' => '15th-century brick mosque city of Khalifatabad, UNESCO World Heritage site.', 'hotel' => 'City Inn Khulna', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 11, 'title' => 'Paddle Steamer River Journey back to Dhaka', 'desc' => 'Relax on the upper deck watching riverine fishermen and lush green delta banks.', 'hotel' => 'Amari Dhaka', 'meals' => 'Breakfast, Lunch, Dinner'],
                    ['day' => 12, 'title' => 'Final Day in Dhaka & Departure', 'desc' => 'Morning leisure, farewell lunch, and transfer to airport.', 'hotel' => null, 'meals' => 'Breakfast, Lunch'],
                ]
            ],
        ];

        foreach ($toursData as $data) {
            $itineraries = $data['itinerary'] ?? [];
            unset($data['itinerary']);

            $tour = Tour::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            // Re-create itineraries
            TourItinerary::where('tour_id', $tour->id)->delete();
            foreach ($itineraries as $item) {
                TourItinerary::create([
                    'tour_id' => $tour->id,
                    'day_number' => $item['day'],
                    'title' => $item['title'],
                    'description' => $item['desc'],
                    'accommodation' => $item['hotel'] ?? null,
                    'meals' => $item['meals'] ?? null,
                ]);
            }
        }
    }
}
