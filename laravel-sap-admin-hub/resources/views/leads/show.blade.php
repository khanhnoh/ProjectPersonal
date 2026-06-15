@extends('layouts.app')

@section('page-title', 'Lead Details')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $lead->customer_name }}</h3>
            <p class="text-gray-600">Created: {{ $lead->created_at->format('M d, Y') }}</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('leads.edit', $lead) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
            <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700" onclick="return confirm('Delete this lead?')">Delete</button>
            </form>
        </div>
    </div>

    <!-- Lead Information -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h4 class="font-bold text-gray-800 mb-4">Lead Information</h4>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-gray-600 text-sm">Email</p>
                <p class="text-gray-800 font-medium">{{ $lead->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Phone</p>
                <p class="text-gray-800 font-medium">{{ $lead->phone ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Company</p>
                <p class="text-gray-800 font-medium">{{ $lead->company ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Status</p>
                <span class="px-3 py-1 rounded text-xs font-medium
                    @if($lead->status === 'qualified') bg-green-100 text-green-800
                    @elseif($lead->status === 'in_progress') bg-blue-100 text-blue-800
                    @elseif($lead->status === 'rejected') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($lead->status) }}
                </span>
            </div>
        </div>
        @if($lead->description)
        <div class="mt-6">
            <p class="text-gray-600 text-sm mb-2">Description</p>
            <p class="text-gray-800">{{ $lead->description }}</p>
        </div>
        @endif
    </div>

    <!-- Related Scopes -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-gray-800">Related Scopes</h4>
            <a href="{{ route('scopes.create') }}" class="text-blue-600 hover:text-blue-800 text-sm">+ Add Scope</a>
        </div>
        @if($scopes->count() > 0)
        <div class="space-y-2">
            @foreach($scopes as $scope)
            <div class="p-4 border rounded hover:bg-gray-50">
                <div class="flex justify-between">
                    <div>
                        <h5 class="font-medium text-gray-800">{{ $scope->scope_title }}</h5>
                        <p class="text-sm text-gray-600">{{ $scope->description }}</p>
                    </div>
                    <a href="{{ route('scopes.show', $scope) }}" class="text-blue-600 hover:text-blue-800">View</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-center py-4">No scopes yet</p>
        @endif
    </div>

    <!-- BANT Assessment -->
    @if($assessment)
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h4 class="font-bold text-gray-800 mb-4">BANT Assessment</h4>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 text-sm">Budget Score: {{ $assessment->budget_score }}/10</p>
                <div class="w-full bg-gray-200 rounded h-2 mt-1">
                    <div class="bg-blue-600 h-2 rounded" style="width: {{ $assessment->budget_score * 10 }}%"></div>
                </div>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Authority Score: {{ $assessment->authority_score }}/10</p>
                <div class="w-full bg-gray-200 rounded h-2 mt-1">
                    <div class="bg-green-600 h-2 rounded" style="width: {{ $assessment->authority_score * 10 }}%"></div>
                </div>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Need Score: {{ $assessment->need_score }}/10</p>
                <div class="w-full bg-gray-200 rounded h-2 mt-1">
                    <div class="bg-purple-600 h-2 rounded" style="width: {{ $assessment->need_score * 10 }}%"></div>
                </div>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Timeline Score: {{ $assessment->timeline_score }}/10</p>
                <div class="w-full bg-gray-200 rounded h-2 mt-1">
                    <div class="bg-orange-600 h-2 rounded" style="width: {{ $assessment->timeline_score * 10 }}%"></div>
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-4">Overall Score: <span class="font-bold">{{ $assessment->overall_score }}/10</span></p>
        <p class="text-sm text-gray-600">Recommendation: <span class="font-bold">{{ ucfirst($assessment->recommendation) }}</span></p>
        <a href="{{ route('bant-assessments.edit', $assessment) }}" class="text-blue-600 hover:text-blue-800 text-sm mt-4 block">Edit Assessment</a>
    </div>
    @endif
</div>
@endsection
