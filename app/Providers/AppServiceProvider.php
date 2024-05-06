<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Psychologist;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
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
    public function boot()
    {

        URL::forceRootUrl(Config::get('app.url'));
        if (str_contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

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
        } catch (\Exception $e) {
            Log::error('Error during boot in AppServiceProvider: ' . $e->getMessage());
        }
    }
}
