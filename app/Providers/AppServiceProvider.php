<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Project;
use App\Models\Facility;

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
        Schema::defaultStringLength(191);

        // Share projects and facilities data with header
        View::composer('components.layouts.partials.header', function ($view) {
            $view->with([
                'projects' => Project::orderBy('updated_at', 'desc')->limit(10)->get(),
                'facilities' => Facility::orderBy('updated_at', 'desc')->limit(10)->get(),
            ]);
        });
    }
}
