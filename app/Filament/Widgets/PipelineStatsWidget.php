<?php
/**
 * Module: Dashboard
 * Feature: Hero stats + secondary stats — tổng quan pipeline SAP presales
 */

namespace App\Filament\Widgets;

use App\Models\Artifact;
use App\Models\BANTAssessment;
use App\Models\Lead;
use App\Models\Scope;
use App\Models\Timeline;
use Carbon\Carbon;
use Filament\Widgets\Widget;

class PipelineStatsWidget extends Widget
{
    protected string $view = 'filament.widgets.pipeline-stats';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 1;

    protected function getViewData(): array
    {
        $now       = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        $thisMonthLeads = Lead::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $lastMonthLeads = Lead::whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->count();

        $thisMonthWon = Lead::where('status', 'won')
            ->whereYear('updated_at', $now->year)
            ->whereMonth('updated_at', $now->month)
            ->count();

        $lastMonthWon = Lead::where('status', 'won')
            ->whereYear('updated_at', $lastMonth->year)
            ->whereMonth('updated_at', $lastMonth->month)
            ->count();

        return [
            // Hero cards
            'totalLeads'     => Lead::count(),
            'activeLeads'    => Lead::whereIn('status', ['qualified', 'proposal'])->count(),
            'wonDeals'       => Lead::where('status', 'won')->count(),
            'prospectLeads'  => Lead::where('status', 'prospect')->count(),

            // % change badges
            'leadsChange'    => $this->pctChange($thisMonthLeads, $lastMonthLeads),
            'wonChange'      => $this->pctChange($thisMonthWon, $lastMonthWon),

            // Secondary cards
            'totalScopes'    => Scope::count(),
            'bantDone'       => BANTAssessment::count(),
            'activeTimelines'=> Timeline::whereNotIn('status', ['completed'])->count(),
            'artifacts'      => Artifact::count(),

            // Pipeline distribution (for mini indicators)
            'lostDeals'      => Lead::where('status', 'lost')->count(),
        ];
    }

    private function pctChange(int $current, int $previous): array
    {
        if ($previous === 0) {
            return $current > 0
                ? ['+' . $current * 100 . '%', true]
                : ['0%', true];
        }
        $pct = round((($current - $previous) / $previous) * 100);
        return [($pct >= 0 ? '+' : '') . $pct . '%', $pct >= 0];
    }
}
