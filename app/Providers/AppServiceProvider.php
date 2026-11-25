<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production') || str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // Share cached pending/unread badge counts with the Admin layout sidebar
        View::composer('layouts.admin', function ($view) {
            $counts = Cache::remember('admin_sidebar_counts', 60, function () {
                return [
                    'pendingBookingsCount' => Booking::where('status', 'pending')->count(),
                    'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
                ];
            });

            $view->with($counts);
        });
    }
}
