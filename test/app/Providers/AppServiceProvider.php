<?php

namespace App\Providers;

use App\Models\AboutUs;
use App\Models\ServiceCategory;
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
        View::composer('*', function ($view) {
            $serviceCategories = ServiceCategory::where('is_visible', 1)->get();
            $about_us = AboutUs::first();

            $view->with([
                'serviceCategories' => $serviceCategories,
                'about_us' => $about_us
            ]);
        });
    }
}
