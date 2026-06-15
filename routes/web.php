<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ScopeController;
use App\Http\Controllers\BANTAssessmentController;
use App\Http\Controllers\EffortEstimationController;
use App\Http\Controllers\CostEstimationController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\ResourceAllocationController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\PitchingChecklistController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resources
    Route::resource('leads', LeadController::class);
    Route::resource('scopes', ScopeController::class);
    Route::resource('bant-assessments', BANTAssessmentController::class);
    Route::resource('effort-estimations', EffortEstimationController::class);
    Route::resource('cost-estimations', CostEstimationController::class);
    Route::resource('timelines', TimelineController::class);
    Route::resource('resource-allocations', ResourceAllocationController::class);
    Route::resource('artifacts', ArtifactController::class);
    Route::resource('pitching-checklists', PitchingChecklistController::class);

    // Extra actions
    Route::get('/artifacts/{artifact}/download', [ArtifactController::class, 'download'])
        ->name('artifacts.download');
    Route::post('/pitching-checklists/{pitchingChecklist}/toggle', [PitchingChecklistController::class, 'toggle'])
        ->name('pitching-checklists.toggle');
});

// Auth routes (Laravel Breeze/default)
require __DIR__.'/auth.php';
