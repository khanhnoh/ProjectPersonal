<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\BANTAssessment;
use App\Models\Timeline;
use App\Models\Scope;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLeads = Lead::count();
        $qualifiedLeads = BANTAssessment::where('recommendation', 'qualified')->count();
        $totalRevenue = Scope::with('costEstimation')
            ->get()
            ->sum(fn($s) => $s->costEstimation?->final_price ?? 0);

        $completedPhases = Timeline::where('status', 'completed')->count();
        $totalPhases = Timeline::count();
        $phaseProgress = $totalPhases > 0 ? round(($completedPhases / $totalPhases) * 100, 1) : 0;

        $recentLeads = Lead::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalLeads',
            'qualifiedLeads',
            'totalRevenue',
            'phaseProgress',
            'recentLeads'
        ));
    }
}
