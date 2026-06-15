<?php

namespace App\Http\Controllers;

use App\Models\Scope;
use App\Models\Lead;
use Illuminate\Http\Request;

class ScopeController extends Controller
{
    public function index()
    {
        $scopes = Scope::with('lead')->latest()->paginate(15);
        return view('scopes.index', compact('scopes'));
    }

    public function create()
    {
        $leads = Lead::all();
        return view('scopes.create', compact('leads'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'scope_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_duration' => 'nullable|integer',
            'status' => 'in:draft,approved,in_progress,completed',
        ]);

        Scope::create($validated);
        return redirect()->route('scopes.index')->with('success', 'Scope created');
    }

    public function show(Scope $scope)
    {
        return view('scopes.show', compact('scope'));
    }

    public function edit(Scope $scope)
    {
        $leads = Lead::all();
        return view('scopes.edit', compact('scope', 'leads'));
    }

    public function update(Request $request, Scope $scope)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'scope_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_duration' => 'nullable|integer',
            'status' => 'in:draft,approved,in_progress,completed',
        ]);

        $scope->update($validated);
        return redirect()->route('scopes.show', $scope)->with('success', 'Scope updated');
    }

    public function destroy(Scope $scope)
    {
        $scope->delete();
        return redirect()->route('scopes.index')->with('success', 'Scope deleted');
    }
}
