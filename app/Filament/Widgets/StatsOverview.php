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
                ->color('danger'),
            
            Stat::make('Pending Review', '8')
                ->description('Waiting for team action')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
                
            Stat::make('Avg Resolution Time', '4h 12m')
                ->description('Improved by 12%')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('success'),

            Stat::make('Resolved Incidents', '152')
                ->description('32 this month')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
        ];
    }
}
