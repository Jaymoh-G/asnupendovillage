<?php

namespace App\Filament\Widgets;

use App\Models\HomePageContent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HomePageContentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalSections = HomePageContent::count();
        $activeSections = HomePageContent::where('is_active', true)->count();
        $inactiveSections = HomePageContent::where('is_active', false)->count();

        return [
            Stat::make('Total Sections', $totalSections)
                ->description('All homepage content sections')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Active Sections', $activeSections)
                ->description('Currently displayed on homepage')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Inactive Sections', $inactiveSections)
                ->description('Hidden from homepage')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
