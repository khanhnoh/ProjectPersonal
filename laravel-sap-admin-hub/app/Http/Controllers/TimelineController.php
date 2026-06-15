<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use App\Models\Scope;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::with('scope')->latest()->paginate(15);
        return view('timelines.index', compact('timelines'));
    }

    public function create()
    {
        $scopes = Scope::all();
        return view('timelines.create', compact('scopes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'phase_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'in:not_started,in_progress,completed,delayed',
        ]);

        Timeline::create($validated);
        return redirect()->route('timelines.index')->with('success', 'Timeline created');
    }

    public function show(Timeline $timeline)
    {
        return view('timelines.show', compact('timeline'));
    }

    public function edit(Timeline $timeline)
    {
        $scopes = Scope::all();
        return view('timelines.edit', compact('timeline', 'scopes'));
    }

    public function update(Request $request, Timeline $timeline)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'phase_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'in:not_started,in_progress,completed,delayed',
        ]);

        $timeline->update($validated);
        return redirect()->route('timelines.show', $timeline)->with('success', 'Timeline updated');
    }

    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return redirect()->route('timelines.index')->with('success', 'Timeline deleted');
    }
}
