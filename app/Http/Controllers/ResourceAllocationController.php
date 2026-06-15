<?php

namespace App\Http\Controllers;

use App\Models\ResourceAllocation;
use App\Models\Timeline;
use Illuminate\Http\Request;

class ResourceAllocationController extends Controller
{
    public function index()
    {
        $allocations = ResourceAllocation::with('timeline')->latest()->paginate(15);
        return view('resource-allocations.index', compact('allocations'));
    }

    public function create()
    {
        $timelines = Timeline::all();
        return view('resource-allocations.create', compact('timelines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'timeline_id' => 'required|exists:timelines,id',
            'resource_name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'allocation_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        ResourceAllocation::create($validated);
        return redirect()->route('resource-allocations.index')->with('success', 'Allocation created');
    }

    public function show(ResourceAllocation $resourceAllocation)
    {
        return view('resource-allocations.show', ['allocation' => $resourceAllocation]);
    }

    public function edit(ResourceAllocation $resourceAllocation)
    {
        $timelines = Timeline::all();
        return view('resource-allocations.edit', ['allocation' => $resourceAllocation, 'timelines' => $timelines]);
    }

    public function update(Request $request, ResourceAllocation $resourceAllocation)
    {
        $validated = $request->validate([
            'timeline_id' => 'required|exists:timelines,id',
            'resource_name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'allocation_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        $resourceAllocation->update($validated);
        return redirect()->route('resource-allocations.show', $resourceAllocation)->with('success', 'Allocation updated');
    }

    public function destroy(ResourceAllocation $resourceAllocation)
    {
        $resourceAllocation->delete();
        return redirect()->route('resource-allocations.index')->with('success', 'Allocation deleted');
    }
}
