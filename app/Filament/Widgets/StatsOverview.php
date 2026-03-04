<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Open Incidents', '14')
                ->description('3 new today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-exclamation-triangle')
                ->chart([7, 2, 10, 3, 15, 4, 14])
                ->color('danger'),
            
            Stat::make('Pending Review', '8')
                ->description('Waiting for team action')
                ->descriptionIcon('heroicon-m-clock')
                ->icon('heroicon-o-clipboard-document-list')
                ->chart([3, 5, 2, 8, 4, 6, 8])
                ->color('warning'),
                
            Stat::make('Avg Resolution Time', '4h 12m')
                ->description('Improved by 12%')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->icon('heroicon-o-clock')
                ->chart([4, 5, 4, 3, 2, 4, 3])
                ->color('success'),

            Stat::make('Resolved Incidents', '152')
                ->description('32 this month')
                ->descriptionIcon('heroicon-m-check-circle')
                ->icon('heroicon-o-check-badge')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('info'),
        ];
    }
}
