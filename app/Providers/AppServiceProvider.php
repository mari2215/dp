<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\MainPage;
use App\Models\Psychologist;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\UrlGenerator;

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
    public function boot()
    {
        Filament::registerNavigationGroups([
            'Заходи',
            'Користувачі',
            'Персональні дані',
        ]);

        try {
            if (Schema::hasTable('psychologists')) {
                $psychologist = Psychologist::first();

                if ($psychologist) {
                    $globalVariables = [
                        'telegram' => "https://t.me/{$psychologist->telegram}",
                        'viber' => "viber://chat?number={$psychologist->viber}",
                        'facebook' => $psychologist->facebook,
                        'instagram' => $psychologist->instagram,
                    ];
                    view()->composer('source.partials.footer', function ($view) use ($globalVariables) {
                        $view->with($globalVariables);
                    });
                    view()->composer('source.event', function ($view) use ($globalVariables) {
                        $view->with($globalVariables);
                    });
                }
            }

            if (Schema::hasTable('categories')) {
                $categories = Category::orderBy('position', 'asc')
                    ->withCount('activities')
                    ->get();

                view()->composer('source.partials.header', function ($view) use ($categories) {
                    $view->with('categories', $categories);
                });
            }

            if (Schema::hasTable('bookings')) {
                $bookings = Booking::all();

                view()->composer(['source.partials.header', 'profile.edit'], function ($view) use ($bookings) {
                    $view->with('bookings', $bookings);
                });
            }

            if (Schema::hasTable('main_pages')) {
                $pageInfo = MainPage::firstOrCreate();

                view()->composer('welcome', function ($view) use ($pageInfo) {
                    $view->with('pageInfo', $pageInfo);
                });
            }
        } catch (\Exception $e) {
            Log::error('Error during boot in AppServiceProvider: ' . $e->getMessage());
        }
    }
}
