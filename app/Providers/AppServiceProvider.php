<?php

namespace App\Providers;

use App\Models\Psychologist;
use App\Models\Category;
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
        $psychologist = Psychologist::first();
        $globalVariables = [
            'telegram' => "https://t.me/{{ $psychologist->telegram }}",
            'viber' => "viber://chat?number={{ $psychologist->viber }}",
            'facebook' => $psychologist->facebook,
            'instagram' => $psychologist->instagram,
        ];

        $categories = Category::orderBy('position', 'asc')
            ->withCount('activities')
            ->get();

        view()->composer('source.partials.header', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });

        view()->composer('source.partials.footer', function ($view) use ($globalVariables) {
            $view->with($globalVariables);
        });
    }
}
