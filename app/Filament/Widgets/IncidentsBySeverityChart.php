<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class IncidentsBySeverityChart extends ChartWidget
{
    protected ?string $heading = 'Incidents by Severity';
    
    // Sort order on the dashboard (higher number = lower position)
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Incidents',
                    'data' => [5, 12, 24, 8], // Hardcoded numbers
                    'backgroundColor' => [
                        '#ef4444', // Red for Critical
                        '#f97316', // Orange for High
                        '#eab308', // Yellow for Medium
                        '#3b82f6', // Blue for Low
                    ],
                ],
            ],
            'labels' => ['Critical', 'High', 'Medium', 'Low'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
