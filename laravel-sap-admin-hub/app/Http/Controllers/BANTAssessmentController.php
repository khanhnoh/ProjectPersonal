<?php

namespace App\Http\Controllers;

use App\Models\BANTAssessment;
use App\Models\Lead;
use Illuminate\Http\Request;

class BANTAssessmentController extends Controller
{
    public function index()
    {
        $assessments = BANTAssessment::with('lead')->latest()->paginate(15);
        return view('bant-assessments.index', compact('assessments'));
    }

    public function create()
    {
        $leads = Lead::all();
        return view('bant-assessments.create', compact('leads'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'budget_score' => 'required|integer|min:0|max:10',
            'authority_score' => 'required|integer|min:0|max:10',
            'need_score' => 'required|integer|min:0|max:10',
            'timeline_score' => 'required|integer|min:0|max:10',
            'budget_notes' => 'nullable|string',
            'authority_notes' => 'nullable|string',
            'need_notes' => 'nullable|string',
            'timeline_notes' => 'nullable|string',
            'recommendation' => 'in:qualified,needs_follow_up,not_qualified',
        ]);

        $assessment = BANTAssessment::create($validated);
        $assessment->calculateOverallScore();
        $assessment->save();

        return redirect()->route('bant-assessments.index')->with('success', 'Assessment created');
    }

    public function show(BANTAssessment $bantAssessment)
    {
        return view('bant-assessments.show', ['assessment' => $bantAssessment]);
    }

    public function edit(BANTAssessment $bantAssessment)
    {
        $leads = Lead::all();
        return view('bant-assessments.edit', ['assessment' => $bantAssessment, 'leads' => $leads]);
    }

    public function update(Request $request, BANTAssessment $bantAssessment)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'budget_score' => 'required|integer|min:0|max:10',
            'authority_score' => 'required|integer|min:0|max:10',
            'need_score' => 'required|integer|min:0|max:10',
            'timeline_score' => 'required|integer|min:0|max:10',
            'budget_notes' => 'nullable|string',
            'authority_notes' => 'nullable|string',
            'need_notes' => 'nullable|string',
            'timeline_notes' => 'nullable|string',
            'recommendation' => 'in:qualified,needs_follow_up,not_qualified',
        ]);

        $bantAssessment->update($validated);
        $bantAssessment->calculateOverallScore();
        $bantAssessment->save();

        return redirect()->route('bant-assessments.show', $bantAssessment)->with('success', 'Assessment updated');
    }

    public function destroy(BANTAssessment $bantAssessment)
    {
        $bantAssessment->delete();
        return redirect()->route('bant-assessments.index')->with('success', 'Assessment deleted');
    }
}
