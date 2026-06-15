<?php

namespace App\Http\Controllers;

use App\Models\EffortEstimation;
use App\Models\Scope;
use Illuminate\Http\Request;

class EffortEstimationController extends Controller
{
    public function index()
    {
        $estimations = EffortEstimation::with('scope')->latest()->paginate(15);
        return view('effort-estimations.index', compact('estimations'));
    }

    public function create()
    {
        $scopes = Scope::all();
        return view('effort-estimations.create', compact('scopes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'task_name' => 'required|string|max:255',
            'estimated_hours' => 'required|numeric|min:0',
            'assigned_to' => 'nullable|string|max:255',
            'status' => 'in:draft,approved,in_progress',
        ]);

        EffortEstimation::create($validated);
        return redirect()->route('effort-estimations.index')->with('success', 'Estimation created');
    }

    public function show(EffortEstimation $effortEstimation)
    {
        return view('effort-estimations.show', ['estimation' => $effortEstimation]);
    }

    public function edit(EffortEstimation $effortEstimation)
    {
        $scopes = Scope::all();
        return view('effort-estimations.edit', ['estimation' => $effortEstimation, 'scopes' => $scopes]);
    }

    public function update(Request $request, EffortEstimation $effortEstimation)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'task_name' => 'required|string|max:255',
            'estimated_hours' => 'required|numeric|min:0',
            'assigned_to' => 'nullable|string|max:255',
            'status' => 'in:draft,approved,in_progress',
        ]);

        $effortEstimation->update($validated);
        return redirect()->route('effort-estimations.show', $effortEstimation)->with('success', 'Estimation updated');
    }

    public function destroy(EffortEstimation $effortEstimation)
    {
        $effortEstimation->delete();
        return redirect()->route('effort-estimations.index')->with('success', 'Estimation deleted');
    }
}
