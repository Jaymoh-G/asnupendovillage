<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalDonations = Donation::count();
        $completedDonations = Donation::completed()->count();
        $totalAmount = Donation::getTotalAmount();
        $pendingDonations = Donation::pending()->count();

        return [
            Stat::make('Total Donations', $totalDonations)
                ->description('All donations received')
                ->descriptionIcon('heroicon-m-heart')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->url(route('filament.admin.resources.donations.index')),

            Stat::make('Completed Donations', $completedDonations)
                ->description('Successfully processed')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([15, 4, 5, 2, 10, 2, 7]),

            Stat::make('Total Amount', 'KES ' . number_format($totalAmount, 2))
                ->description('Total funds raised')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning')
                ->chart([3, 10, 5, 2, 10, 2, 7]),

            Stat::make('Pending Donations', $pendingDonations)
                ->description('Awaiting processing')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info')
                ->chart([17, 16, 14, 15, 14, 13, 12]),
        ];
    }
}
