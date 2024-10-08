<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Psychologist;
use App\Observers\PageObserver;
use App\Observers\BookingObserver;
use App\Models\Page;
use App\Observers\ActivityObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\PsychologistObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Psychologist::observe(PsychologistObserver::class);
        Activity::observe(ActivityObserver::class);
        Booking::observe(BookingObserver::class);
        Category::observe(CategoryObserver::class);
        Page::observe(PageObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
