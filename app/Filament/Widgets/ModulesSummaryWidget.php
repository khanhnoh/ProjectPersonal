<?php
/**
 * Module: Dashboard
 * Feature: SAP modules usage + deployment type distribution — right-panel overview
 */

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\Widget;

class ModulesSummaryWidget extends Widget
{
    protected string $view = 'filament.widgets.modules-summary';

    protected int|string|array $columnSpan = ['md' => 2, 'xl' => 1];

    protected static ?int $sort = 3;

    protected function getViewData(): array
    {
        $leads = Lead::whereNotNull('sap_modules')->get();

        // Tổng hợp tần suất mỗi SAP module được chọn
        $moduleCounts = [];
        foreach ($leads as $lead) {
            foreach ((array) $lead->sap_modules as $module) {
                $moduleCounts[$module] = ($moduleCounts[$module] ?? 0) + 1;
            }
        }
        arsort($moduleCounts);
        $topModules = array_slice($moduleCounts, 0, 6, true);

        // Deployment type distribution
        $deploymentCounts = Lead::whereNotNull('deployment_type')
            ->groupBy('deployment_type')
            ->selectRaw('deployment_type, count(*) as total')
            ->pluck('total', 'deployment_type')
            ->toArray();

        // Industry top 4
        $industryCounts = Lead::whereNotNull('industry')
            ->groupBy('industry')
            ->selectRaw('industry, count(*) as total')
            ->orderByRaw('count(*) desc')
            ->limit(4)
            ->pluck('total', 'industry')
            ->toArray();

        return [
            'topModules'      => $topModules,
            'totalLeadsWithModules' => $leads->count(),
            'deploymentCounts'=> $deploymentCounts,
            'industryCounts'  => $industryCounts,
        ];
    }
}
