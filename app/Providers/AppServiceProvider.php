<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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
        /* Paginator::useBootstrapFive();
        Paginator::useBootstrapFour(); */

        $settings = /* Setting::first(); */ Cache::remember('settings', 60*60*24, function () {
            return Setting::first();
        });

        View::share('settings', $settings);
    }
}
