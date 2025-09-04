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
use App\Models\Program;
use App\Models\Facility;
use App\Models\Donation;
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
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->url(route('filament.admin.resources.users.index')),

            Stat::make('Total Positions', \App\Models\Career::count())
                ->description('All job positions')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info')
                ->chart([15, 4, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.careers.index')),

            Stat::make('Total Facilities', Facility::count())
                ->description('All facilities')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning')
                ->chart([3, 10, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.facilities.index')),

            Stat::make('Active News', News::published()->count())
                ->description('Published articles')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ->url(route('filament.admin.resources.news.index')),

            Stat::make('Upcoming Events', Event::published()->count())
                ->description('Active events')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning')
                ->chart([15, 4, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.events.index')),

            Stat::make('Team Members', Team::active()->count())
                ->description('Active team')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->chart([3, 10, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.teams.index')),

            Stat::make('Projects', Project::active()->count())
                ->description('Active projects')
                ->descriptionIcon('heroicon-m-folder')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->url(route('filament.admin.resources.projects.index')),

            Stat::make('Testimonials', Testimonial::count())
                ->description('Total testimonials')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('danger')
                ->chart([3, 10, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.testimonials.index')),

            Stat::make('Photo Albums', Album::count())
                ->description('Total albums')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->url(route('filament.admin.resources.albums.index')),

            Stat::make('Programs', Program::count())
                ->description('Total programs')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning')
                ->chart([15, 4, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.programs.index')),

            Stat::make('Monthly Reports', Download::count())
                ->description('Available monthly reports')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('info')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ->url(route('filament.admin.resources.downloads.index')),

            Stat::make('Total Donations', Donation::count())
                ->description('All donations received')
                ->descriptionIcon('heroicon-m-heart')
                ->color('danger')
                ->chart([3, 10, 5, 2, 10, 2, 7])
                ->url(route('filament.admin.resources.donations.index')),
        ];
    }
}
