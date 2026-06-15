<?php

namespace App\Providers;

use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        URL::forceScheme('https');

        View::composer('*', function ($view) {
            $serviceCategories = ServiceCategory::where('is_visible', 1)->get();
            $about_us = AboutUs::first();
            $latest_blogs = Blog::with('category')->latest()->take(3)->get();

            $view->with([
                'serviceCategories' => $serviceCategories,
                'about_us' => $about_us,
                'latest_blogs' => $latest_blogs
            ]);
        });
    }
}
