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

    public function test_guest_is_redirected_from_my_bookings_dashboard(): void
    {
        $response = $this->get('/my-bookings');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_traveler_can_view_my_bookings_and_download_voucher(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
        ]);

        $tour = Tour::first();

        $booking = \App\Models\Booking::create([
            'user_id' => $user->id,
            'tour_id' => $tour ? $tour->id : null,
            'booking_reference' => 'BTB-TEST-' . rand(1000, 9999),
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => '+8801700112233',
            'departure_date' => now()->addDays(20)->format('Y-m-d'),
            'adults_count' => 2,
            'children_count' => 0,
            'status' => 'confirmed',
        ]);

        // Access dashboard
        $response = $this->actingAs($user)->get('/my-bookings');
        $response->assertStatus(200);
        $response->assertSee($booking->booking_reference);
        $response->assertSee('My Bookings');

        // Access voucher
        $voucherResponse = $this->actingAs($user)->get('/bookings/' . $booking->booking_reference . '/voucher');
        $voucherResponse->assertStatus(200);
        $voucherResponse->assertSee($booking->booking_reference);
        $voucherResponse->assertSee('Tour Voucher');
        $voucherResponse->assertSee('Print / Save as PDF');
    }

    public function test_whatsapp_floating_pill_is_rendered_on_pages(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('floating-whatsapp-btn');
        $response->assertSee('wa.me');
        $response->assertSee('+8801577509112');
    }

    public function test_admin_responsive_pages_and_modals_load_properly(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin/dashboard')
            ->assertStatus(200)
            ->assertSee('Executive Analytics');

        $this->actingAs($admin)->get('/admin/bookings')
            ->assertStatus(200)
            ->assertSee('bookingDetailModal')
            ->assertSee('Export CSV');

        $this->actingAs($admin)->get('/admin/tours')
            ->assertStatus(200)
            ->assertSee('Tour Packages Catalog');

        $this->actingAs($admin)->get('/admin/destinations')
            ->assertStatus(200)
            ->assertSee('editDestModal');

        $this->actingAs($admin)->get('/admin/categories')
            ->assertStatus(200)
            ->assertSee('editCatModal');

        $this->actingAs($admin)->get('/admin/messages')
            ->assertStatus(200)
            ->assertSee('Contact Inquiries Inbox');
    }

    public function test_admin_can_export_bookings_csv(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/bookings/export');
        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
    }

    public function test_admin_can_update_destination_and_category(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        $dest = Destination::create([
            'name' => 'Temp Dest ' . rand(100, 999),
            'slug' => 'temp-dest-' . time(),
            'country' => 'Bangladesh',
            'is_featured' => false,
        ]);

        $destUpdate = $this->actingAs($admin)->put('/admin/destinations/' . $dest->id, [
            'name' => $dest->name . ' Updated',
            'country' => 'Bangladesh',
            'tagline' => 'Updated Tagline',
            'is_featured' => '1',
        ]);
        $destUpdate->assertRedirect();
        $this->assertDatabaseHas('destinations', ['id' => $dest->id, 'tagline' => 'Updated Tagline']);
        $dest->delete();

        $cat = \App\Models\Category::create([
            'name' => 'Temp Cat ' . rand(100, 999),
            'slug' => 'temp-cat-' . time(),
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $catUpdate = $this->actingAs($admin)->put('/admin/categories/' . $cat->id, [
            'name' => $cat->name . ' Updated',
            'sort_order' => 5,
            'is_active' => '1',
        ]);
        $catUpdate->assertRedirect();
        $this->assertDatabaseHas('categories', ['id' => $cat->id, 'sort_order' => 5]);
        $cat->delete();
    }

    public function test_public_cached_routes_and_sitemap_load_cleanly(): void
    {
        $this->get('/gallery')->assertStatus(200);
        $this->get('/blog')->assertStatus(200);
        $sitemap = $this->get('/sitemap.xml')->assertStatus(200);
        $this->assertStringContainsString('text/xml', $sitemap->headers->get('Content-Type'));
    }
}
