@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
            <h3 class="text-gray-500 text-sm font-medium">Total Leads</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalLeads }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
            <h3 class="text-gray-500 text-sm font-medium">Qualified Leads</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $qualifiedLeads }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
            <h3 class="text-gray-500 text-sm font-medium">Revenue Pipeline</h3>
            <p class="text-2xl font-bold text-gray-800 mt-2">
                {{ number_format($totalRevenue, 0) }} {{ $totalRevenue > 1000000 ? 'M' : '' }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-orange-500">
            <h3 class="text-gray-500 text-sm font-medium">Phase Progress</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $phaseProgress }}%</p>
        </div>
    </div>

    <!-- Recent Leads -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Leads</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Created</th>
                        <th class="px-6 py-3 text-right text-sm font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentLeads as $lead)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $lead->customer_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lead->email ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded text-xs font-medium
                                @if($lead->status === 'qualified') bg-green-100 text-green-800
                                @elseif($lead->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($lead->status === 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $lead->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('leads.show', $lead) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No leads yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
