<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->paginate(15);
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'status' => 'in:new,in_progress,qualified,rejected',
            'description' => 'nullable|string',
        ]);

        Lead::create($validated);
        return redirect()->route('leads.index')->with('success', 'Lead created successfully');
    }

    public function show(Lead $lead)
    {
        $scopes = $lead->scopes;
        $assessment = $lead->bantAssessment;
        return view('leads.show', compact('lead', 'scopes', 'assessment'));
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'status' => 'in:new,in_progress,qualified,rejected',
            'description' => 'nullable|string',
        ]);

        $lead->update($validated);
        return redirect()->route('leads.show', $lead)->with('success', 'Lead updated');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted');
    }
}
