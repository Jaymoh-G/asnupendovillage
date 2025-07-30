<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\Event;
use App\Models\Project;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Album;
use App\Models\Download;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Active News', News::where('is_active', true)->count())
                ->description('Published articles')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),

            Stat::make('Upcoming Events', Event::where('is_active', true)->count())
                ->description('Active events')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),

            Stat::make('Team Members', Team::where('is_active', true)->count())
                ->description('Active team')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Projects', Project::where('is_active', true)->count())
                ->description('Active projects')
                ->descriptionIcon('heroicon-m-folder')
                ->color('success'),

            Stat::make('Testimonials', Testimonial::where('is_active', true)->count())
                ->description('Published testimonials')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('danger'),

            Stat::make('Photo Albums', Album::count())
                ->description('Total albums')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),

            Stat::make('Downloads', Download::count())
                ->description('Available files')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('info'),
        ];
    }
}
