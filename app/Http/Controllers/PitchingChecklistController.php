<?php

namespace App\Http\Controllers;

use App\Models\PitchingChecklist;
use App\Models\Scope;
use Illuminate\Http\Request;

class PitchingChecklistController extends Controller
{
    public function index()
    {
        $checklists = PitchingChecklist::with('scope')->latest()->paginate(15);
        return view('pitching-checklists.index', compact('checklists'));
    }

    public function create()
    {
        $scopes = Scope::all();
        return view('pitching-checklists.create', compact('scopes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'checklist_item' => 'required|string',
            'is_completed' => 'boolean',
            'assigned_to' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        PitchingChecklist::create($validated);
        return redirect()->route('pitching-checklists.index')->with('success', 'Checklist item created');
    }

    public function show(PitchingChecklist $pitchingChecklist)
    {
        return view('pitching-checklists.show', ['checklist' => $pitchingChecklist]);
    }

    public function edit(PitchingChecklist $pitchingChecklist)
    {
        $scopes = Scope::all();
        return view('pitching-checklists.edit', ['checklist' => $pitchingChecklist, 'scopes' => $scopes]);
    }

    public function update(Request $request, PitchingChecklist $pitchingChecklist)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'checklist_item' => 'required|string',
            'is_completed' => 'boolean',
            'assigned_to' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $pitchingChecklist->update($validated);
        return redirect()->route('pitching-checklists.show', $pitchingChecklist)->with('success', 'Checklist updated');
    }

    public function destroy(PitchingChecklist $pitchingChecklist)
    {
        $pitchingChecklist->delete();
        return redirect()->route('pitching-checklists.index')->with('success', 'Checklist deleted');
    }

    public function toggle(PitchingChecklist $pitchingChecklist)
    {
        $pitchingChecklist->is_completed = !$pitchingChecklist->is_completed;
        $pitchingChecklist->save();
        return back()->with('success', 'Checklist item updated');
    }
}
