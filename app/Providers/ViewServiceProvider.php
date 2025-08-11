<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Facility;
use App\Models\Program;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share facilities and programs data with header view
        View::composer('components.layouts.partials.header', function ($view) {
            $facilities = Facility::ordered()->get();

            $programs = Program::orderBy('title')
                ->get();

            $view->with('facilities', $facilities);
            $view->with('programs', $programs);
        });
    }
}
