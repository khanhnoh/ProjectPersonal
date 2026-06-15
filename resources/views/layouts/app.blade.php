<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SAP Admin Hub')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">SAP Admin</h1>
                <p class="text-sm text-slate-400">Management System</p>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('dashboard')) bg-blue-600 @endif">
                    📊 Dashboard
                </a>
                <a href="{{ route('leads.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('leads.*')) bg-blue-600 @endif">
                    👤 Leads
                </a>
                <a href="{{ route('scopes.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('scopes.*')) bg-blue-600 @endif">
                    📋 Scopes
                </a>
                <a href="{{ route('bant-assessments.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('bant-assessments.*')) bg-blue-600 @endif">
                    🎯 BANT Assessment
                </a>
                <a href="{{ route('effort-estimations.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('effort-estimations.*')) bg-blue-600 @endif">
                    ⏱️ Effort Estimation
                </a>
                <a href="{{ route('cost-estimations.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('cost-estimations.*')) bg-blue-600 @endif">
                    💰 Cost Estimation
                </a>
                <a href="{{ route('timelines.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('timelines.*')) bg-blue-600 @endif">
                    📅 Timelines
                </a>
                <a href="{{ route('resource-allocations.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('resource-allocations.*')) bg-blue-600 @endif">
                    👥 Resource Allocation
                </a>
                <a href="{{ route('artifacts.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('artifacts.*')) bg-blue-600 @endif">
                    📄 Artifacts
                </a>
                <a href="{{ route('pitching-checklists.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 @if(request()->routeIs('pitching-checklists.*')) bg-blue-600 @endif">
                    ✅ Pitching Checklist
                </a>
            </nav>

            <div class="mt-12 pt-6 border-t border-slate-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-slate-800 rounded">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <div class="text-sm text-gray-600">
                        User: <span class="font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
