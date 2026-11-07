<?php

namespace App\Providers;

use App\Services\StorefrontService;
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
        // Share cached navigation categories with storefront layout
        View::composer('layouts.app', function ($view) {
            $view->with('navCategories', app(StorefrontService::class)->getNavigationCategories());
        });
    }
}
