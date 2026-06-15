<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use App\Models\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtifactController extends Controller
{
    public function index()
    {
        $artifacts = Artifact::with('scope')->latest()->paginate(15);
        return view('artifacts.index', compact('artifacts'));
    }

    public function create()
    {
        $scopes = Scope::all();
        return view('artifacts.create', compact('scopes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'artifact_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'file_type' => 'in:proposal,erd,wireframe,specification,other',
            'uploaded_by' => 'nullable|string|max:255',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('artifacts');
            $validated['file_path'] = $filePath;
        }

        $validated['upload_date'] = now();
        Artifact::create($validated);

        return redirect()->route('artifacts.index')->with('success', 'Artifact created');
    }

    public function show(Artifact $artifact)
    {
        return view('artifacts.show', compact('artifact'));
    }

    public function edit(Artifact $artifact)
    {
        $scopes = Scope::all();
        return view('artifacts.edit', compact('artifact', 'scopes'));
    }

    public function update(Request $request, Artifact $artifact)
    {
        $validated = $request->validate([
            'scope_id' => 'required|exists:scopes,id',
            'artifact_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'file_type' => 'in:proposal,erd,wireframe,specification,other',
            'uploaded_by' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            if ($artifact->file_path) {
                Storage::delete($artifact->file_path);
            }
            $filePath = $request->file('file')->store('artifacts');
            $validated['file_path'] = $filePath;
            $validated['upload_date'] = now();
        }

        $artifact->update($validated);
        return redirect()->route('artifacts.show', $artifact)->with('success', 'Artifact updated');
    }

    public function destroy(Artifact $artifact)
    {
        if ($artifact->file_path) {
            Storage::delete($artifact->file_path);
        }
        $artifact->delete();
        return redirect()->route('artifacts.index')->with('success', 'Artifact deleted');
    }

    public function download(Artifact $artifact)
    {
        if (!$artifact->file_path || !Storage::exists($artifact->file_path)) {
            return redirect()->back()->with('error', 'File not found');
        }
        return Storage::download($artifact->file_path);
    }
}
