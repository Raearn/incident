<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tickets', Ticket::count())
                ->description('All time tickets')
                ->descriptionIcon('heroicon-m-ticket')
                ->icon('heroicon-o-ticket')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),

            Stat::make('Open Tickets', Ticket::where('status', 'Open')->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->icon('heroicon-o-exclamation-circle')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('danger'),

            Stat::make('Critical Incidents', Ticket::where('priority', 'Critical')->count())
                ->description('High priority')
                ->descriptionIcon('heroicon-m-fire')
                ->icon('heroicon-o-fire')
                ->chart([3, 5, 2, 8, 4, 6, 8])
                ->color('danger'),

            Stat::make('Unassigned Tickets', Ticket::whereNull('assigned_to')->count())
                ->description('Waiting for assignment')
                ->descriptionIcon('heroicon-m-user-minus')
                ->icon('heroicon-o-user-minus')
                ->chart([4, 5, 4, 3, 2, 4, 3])
                ->color('warning'),
        ];
    }
}
