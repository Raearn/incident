<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class TicketsByStatusChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return 'Tickets by Status';
    }

    protected function getData(): array
    {
        $data = Ticket::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Define colors for each status
        $colors = [
            'Open' => '#ef4444', // Red
            'In Progress' => '#3b82f6', // Blue
            'On Hold' => '#f59e0b', // Amber/Orange
            'Resolved' => '#10b981', // Green
            'Closed' => '#6b7280', // Gray
        ];

        // Ensure all statuses are represented even if count is 0
        $statuses = ['Open', 'In Progress', 'On Hold', 'Resolved', 'Closed'];
        $counts = [];
        $backgroundColors = [];

        foreach ($statuses as $status) {
            $counts[] = $data[$status] ?? 0;
            $backgroundColors[] = $colors[$status];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tickets',
                    'data' => $counts,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
