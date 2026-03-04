<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class IncidentsOverTimeChart extends ChartWidget
{
    protected ?string $heading = 'Incidents Over Time';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Incidents Created',
                    'data' => [2, 4, 12, 10, 15, 8, 12],
                    'fill' => 'start',
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
