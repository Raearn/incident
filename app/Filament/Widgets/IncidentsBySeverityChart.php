<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class IncidentsBySeverityChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return 'Incidents by Severity';
    }
    
    // Sort order on the dashboard (higher number = lower position)
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Ticket::selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority')
            ->toArray();

        // Define colors for each priority
        $colors = [
            'Critical' => '#ef4444', // Red
            'High' => '#f97316', // Orange
            'Medium' => '#eab308', // Yellow
            'Low' => '#3b82f6', // Blue
        ];

        // Ensure all priorities are represented even if count is 0
        $priorities = ['Critical', 'High', 'Medium', 'Low'];
        $counts = [];
        $backgroundColors = [];

        foreach ($priorities as $priority) {
            $counts[] = $data[$priority] ?? 0;
            $backgroundColors[] = $colors[$priority];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Incidents',
                    'data' => $counts,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $priorities,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
