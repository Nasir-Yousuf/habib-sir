<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\User;
use Tests\TestCase;

class PublicAndAdminTest extends TestCase
{
    public function test_homepage_loads_successfully_with_brand_content(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bongo Tanbo Travels');
        $response->assertSee('The Sundarbans');
        $response->assertSee('Bangladesh Tourism Board');
    }

    public function test_about_page_loads_with_joint_venture_details(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('About Bongo Tanbo Travels');
        $response->assertSee('Bangladesh–Japan');
        $response->assertSee('Bangladesh Tourism Board');
    }

    public function test_tours_catalog_loads_with_filters(): void
    {
        $response = $this->get('/tours');
        $response->assertStatus(200);
        $response->assertSee('Our Tour Packages');
        $response->assertSee('Japan Standard Tour Itinerary');
    }

    public function test_single_tour_details_page_loads_with_itinerary(): void
    {
        $tour = Tour::first();
        $this->assertNotNull($tour);

        $response = $this->get('/tours/' . $tour->slug);
        $response->assertStatus(200);
        $response->assertSee($tour->title);
        $response->assertSee('Day-by-Day Itinerary');
        $response->assertSee('Inclusions');
    }

    public function test_destinations_catalog_and_single_destination_load(): void
    {
        $response = $this->get('/destinations');
        $response->assertStatus(200);
        $response->assertSee('Featured Destinations');

        $dest = Destination::first();
        $this->assertNotNull($dest);

        $showResponse = $this->get('/destinations/' . $dest->slug);
        $showResponse->assertStatus(200);
        $showResponse->assertSee($dest->name);
    }

    public function test_contact_page_loads(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Contact Bongo Tanbo Travels');
        $response->assertSee('Bangladesh Liaison Office');
        $response->assertSee('Japan Headquarters');
    }

    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test Traveler',
            'email' => 'traveler@example.com',
            'phone' => '+8801700000000',
            'subject' => 'Sundarbans Tour Inquiry',
            'message' => 'Hello, I would like to book a 5-person tour next month.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'traveler@example.com',
            'name' => 'Test Traveler',
        ]);
    }

    public function test_booking_inquiry_submission(): void
    {
        $tour = Tour::first();

        $response = $this->post('/bookings', [
            'tour_id' => $tour->id,
            'customer_name' => 'John Smith',
            'customer_email' => 'john@example.com',
            'customer_phone' => '+8801800000000',
            'departure_date' => now()->addDays(14)->format('Y-m-d'),
            'adults_count' => 2,
            'children_count' => 1,
            'special_requests' => 'Vegetarian meals required',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('bookings', [
            'customer_email' => 'john@example.com',
            'customer_name' => 'John Smith',
            'tour_id' => $tour->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin);

        $loginResponse = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $loginResponse->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin);

        $dashboardResponse = $this->actingAs($admin)->get('/admin/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Executive Analytics');

        $toursResponse = $this->actingAs($admin)->get('/admin/tours');
        $toursResponse->assertStatus(200);
        $toursResponse->assertSee('Tour Packages Catalog');

        $bookingsResponse = $this->actingAs($admin)->get('/admin/bookings');
        $bookingsResponse->assertStatus(200);
        $bookingsResponse->assertSee('Customer Booking Inquiries');
    }

    public function test_sitemap_and_robots_txt(): void
    {
        $sitemapResponse = $this->get('/sitemap.xml');
        $sitemapResponse->assertStatus(200);
        $sitemapResponse->assertHeader('Content-Type', 'text/xml; charset=UTF-8');

        $robotsResponse = $this->get('/robots.txt');
        $robotsResponse->assertStatus(200);
        $robotsResponse->assertSee('Sitemap:');
    }

    public function test_security_headers_are_present(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_input_sanitization_strips_malicious_xss(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Security Tester',
            'email' => 'security@example.com',
            'phone' => '+8801900000000',
            'subject' => '<script>alert("hack")</script>Inquiry',
            'message' => 'Hello <script>alert("xss")</script>world.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'security@example.com',
            'subject' => 'Inquiry',
            'message' => 'Hello world.',
        ]);
    }

    public function test_non_admin_user_is_forbidden_from_admin_dashboard(): void
    {
        $regularUser = User::factory()->create([
            'role' => 'customer',
        ]);

        $response = $this->actingAs($regularUser)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_user_can_register_with_bcrypt_hashed_password(): void
    {
        $uniqueEmail = 'traveler_' . time() . '@example.com';
        $response = $this->post('/register', [
            'name' => 'John Traveler',
            'email' => $uniqueEmail,
            'password' => 'secret12345',
            'password_confirmation' => 'secret12345',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();

        $user = User::where('email', $uniqueEmail)->first();
        $this->assertNotNull($user);
        $this->assertEquals('customer', $user->role);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('secret12345', $user->password));
    }
}
