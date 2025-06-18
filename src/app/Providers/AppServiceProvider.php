<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // mergeConfigFrom removed to fix array_merge error
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

