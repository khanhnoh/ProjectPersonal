<?php
/**
 * Module: Dashboard
 * Feature: Stacked bar chart — leads theo tháng phân loại theo pipeline status
 */

namespace App\Filament\Widgets;

use App\Models\Lead;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class LeadsPipelineChartWidget extends ChartWidget
{
    protected ?string $heading = 'Pipeline Overview';

    protected ?string $description = 'Leads theo tháng phân loại theo trạng thái';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = ['md' => 2, 'xl' => 3];

    public ?string $filter = '6m';

    protected function getFilters(): ?array
    {
        return [
            '1m' => '1 Tháng',
            '3m' => '3 Tháng',
            '6m' => '6 Tháng',
            '1y' => '1 Năm',
        ];
    }

    protected function getData(): array
    {
        $months = match ($this->filter) {
            '1m' => 1,
            '3m' => 3,
            '1y' => 12,
            default => 6,
        };

        $labels   = [];
        $statuses = [
            'prospect'  => ['label' => 'Prospect',  'color' => 'rgba(148,163,184,0.85)'],
            'qualified' => ['label' => 'Qualified',  'color' => 'rgba(59,130,246,0.85)'],
            'proposal'  => ['label' => 'Proposal',   'color' => 'rgba(251,146,60,0.85)'],
            'won'       => ['label' => 'Won',        'color' => 'rgba(16,185,129,0.85)'],
            'lost'      => ['label' => 'Lost',       'color' => 'rgba(239,68,68,0.85)'],
        ];

        $data = array_fill_keys(array_keys($statuses), []);

        for ($i = $months - 1; $i >= 0; $i--) {
            $month    = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');

            foreach (array_keys($statuses) as $status) {
                $data[$status][] = Lead::where('status', $status)
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            }
        }

        $datasets = [];
        foreach ($statuses as $key => $meta) {
            $datasets[] = [
                'label'           => $meta['label'],
                'data'            => $data[$key],
                'backgroundColor' => $meta['color'],
                'borderRadius'    => 4,
                'borderSkipped'   => false,
            ];
        }

        return ['datasets' => $datasets, 'labels' => $labels];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => ['stacked' => true, 'grid' => ['display' => false]],
                'y' => ['stacked' => true, 'beginAtZero' => true],
            ],
            'plugins' => [
                'legend' => ['position' => 'bottom'],
            ],
        ];
    }
}
