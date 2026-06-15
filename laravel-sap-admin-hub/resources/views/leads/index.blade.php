@extends('layouts.app')

@section('page-title', 'Leads Management')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-bold">Lead List</h3>
        <a href="{{ route('leads.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Lead
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Customer Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Phone</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Company</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Created</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($leads as $lead)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $lead->customer_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $lead->email ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $lead->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $lead->company ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded text-xs font-medium
                            @if($lead->status === 'qualified') bg-green-100 text-green-800
                            @elseif($lead->status === 'in_progress') bg-blue-100 text-blue-800
                            @elseif($lead->status === 'rejected') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($lead->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $lead->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('leads.show', $lead) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                        <a href="{{ route('leads.edit', $lead) }}" class="text-green-600 hover:text-green-800 text-sm">Edit</a>
                        <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No leads found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-center">
        {{ $leads->links() }}
    </div>
</div>
@endsection
