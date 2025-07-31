<?php

namespace App\Filament\Widgets;

use App\Models\Setting;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SettingsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalSettings = Setting::count();
        $contactSettings = Setting::where('group', 'contact')->count();
        $socialSettings = Setting::where('group', 'social')->count();
        $paymentSettings = Setting::where('group', 'payment')->count();

        return [
            Stat::make('Total Settings', $totalSettings)
                ->description('All configuration options')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->url(route('filament.admin.resources.settings.index')),

            Stat::make('Contact Info', $contactSettings)
                ->description('Contact settings configured')
                ->descriptionIcon('heroicon-m-phone')
                ->color('success')
                ->chart([15, 4, 5, 2, 10, 2, 7]),

            Stat::make('Social Media', $socialSettings)
                ->description('Social media links')
                ->descriptionIcon('heroicon-m-share')
                ->color('info')
                ->chart([3, 10, 5, 2, 10, 2, 7]),

            Stat::make('Payment Details', $paymentSettings)
                ->description('Payment configuration')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('warning')
                ->chart([17, 16, 14, 15, 14, 13, 12]),
        ];
    }
}
