<?php

namespace App\Filament\Widgets;

use App\Models\Album;
use App\Models\Career;
use App\Models\Donation;
use App\Models\Download;
use App\Models\Event;
use App\Models\Facility;
use App\Models\HomeSlider;
use App\Models\News;
use App\Models\PageBanner;
use App\Models\Program;
use App\Models\Project;
use App\Models\StaticPage;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered users in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Active News', News::published()->count())
                ->description('Published news articles')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Upcoming Events', Event::published()->count())
                ->description('Active events')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning')
                ->chart([15, 4, 5, 2, 10, 2, 7]),

            Stat::make('Team Members', Team::active()->count())
                ->description('Active team members')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->chart([3, 10, 5, 2, 10, 2, 7]),

            Stat::make('Projects', Project::active()->count())
                ->description('Active projects')
                ->descriptionIcon('heroicon-m-folder')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Programs', Program::count())
                ->description('Total programs')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Facilities', Facility::count())
                ->description('Total facilities')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info')
                ->chart([15, 4, 5, 2, 10, 2, 7]),

            Stat::make('Testimonials', Testimonial::count())
                ->description('Total testimonials')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('success')
                ->chart([3, 10, 5, 2, 10, 2, 7]),

            Stat::make('Photo Albums', Album::count())
                ->description('Total photo albums')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Downloads', Download::count())
                ->description('Available downloads')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('info')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Careers', Career::active()->count())
                ->description('Active job openings')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning')
                ->chart([15, 4, 5, 2, 10, 2, 7]),

            Stat::make('Donations', Donation::count())
                ->description('Total donations received')
                ->descriptionIcon('heroicon-m-heart')
                ->color('danger')
                ->chart([3, 10, 5, 2, 10, 2, 7]),

            Stat::make('Home Sliders', HomeSlider::active()->count())
                ->description('Active slider images')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Page Banners', PageBanner::where('is_active', true)->count())
                ->description('Active page banners')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('primary')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Static Pages', StaticPage::where('is_active', true)->count())
                ->description('Active static pages')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info')
                ->chart([15, 4, 5, 2, 10, 2, 7]),
        ];
    }
}
