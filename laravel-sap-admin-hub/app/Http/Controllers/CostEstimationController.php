<?php

namespace App\Http\Controllers;

use App\Models\CostEstimation;
use App\Models\Scope;
use Illuminate\Http\Request;

class CostEstimationController extends Controller
{
    public function index()
    {
        $estimations = CostEstimation::with('scope')->latest()->paginate(15);
        return view('cost-estimations.index', compact('estimations'));
    }

    public function create()
    {
        $scopes = Scope::all();
        return view('cost-estimations.create', compact('scopes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'hourly_rate' => 'required|numeric|min:0',
            'total_hours' => 'required|numeric|min:0',
            'material_cost' => 'nullable|numeric|min:0',
            'markup_percentage' => 'nullable|integer|min:0|max:100',
            'currency' => 'in:VND,USD',
        ]);

        $estimation = CostEstimation::create($validated);
        $estimation->calculateCosts();
        $estimation->save();

        return redirect()->route('cost-estimations.index')->with('success', 'Cost estimation created');
    }

    public function show(CostEstimation $costEstimation)
    {
        return view('cost-estimations.show', ['estimation' => $costEstimation]);
    }

    public function edit(CostEstimation $costEstimation)
    {
        $scopes = Scope::all();
        return view('cost-estimations.edit', ['estimation' => $costEstimation, 'scopes' => $scopes]);
    }

    public function update(Request $request, CostEstimation $costEstimation)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'hourly_rate' => 'required|numeric|min:0',
            'total_hours' => 'required|numeric|min:0',
            'material_cost' => 'nullable|numeric|min:0',
            'markup_percentage' => 'nullable|integer|min:0|max:100',
            'currency' => 'in:VND,USD',
        ]);

        $costEstimation->update($validated);
        $costEstimation->calculateCosts();
        $costEstimation->save();

        return redirect()->route('cost-estimations.show', $costEstimation)->with('success', 'Cost estimation updated');
    }

    public function destroy(CostEstimation $costEstimation)
    {
        $costEstimation->delete();
        return redirect()->route('cost-estimations.index')->with('success', 'Estimation deleted');
    }
}
