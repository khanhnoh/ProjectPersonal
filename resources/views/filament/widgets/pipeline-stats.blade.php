<div class="space-y-4">

    {{-- ===== ROW 1: Hero Gradient Cards ===== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        {{-- Card 1: Total Leads (Orange) --}}
        <div class="rounded-2xl p-5 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #f97316 0%, #dc2626 100%)">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full opacity-10" style="background:white"></div>
            <div class="flex items-start justify-between relative">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider opacity-80">Total Leads</p>
                    <p class="text-4xl font-bold mt-1">{{ $totalLeads }}</p>
                    <span class="inline-flex items-center mt-2 text-xs font-semibold px-2 py-0.5 rounded-full"
                          style="background:rgba(255,255,255,0.25)">
                        @if($leadsChange[1]) ↑ @else ↓ @endif {{ $leadsChange[0] }} vs tháng trước
                    </span>
                </div>
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:rgba(255,255,255,0.2)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs opacity-60 mt-3">Tổng khách hàng tiềm năng SAP</p>
        </div>

        {{-- Card 2: Active Pipeline (Dark Navy) --}}
        <div class="rounded-2xl p-5 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%)">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full opacity-10" style="background:white"></div>
            <div class="flex items-start justify-between relative">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider opacity-80">Active Pipeline</p>
                    <p class="text-4xl font-bold mt-1">{{ $activeLeads }}</p>
                    <span class="inline-flex items-center mt-2 text-xs font-semibold px-2 py-0.5 rounded-full"
                          style="background:rgba(255,255,255,0.15)">
                        Qualified + Proposal
                    </span>
                </div>
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:rgba(255,255,255,0.1)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs opacity-60 mt-3">Deals đang trong quá trình xử lý</p>
        </div>

        {{-- Card 3: Won Deals (Teal) --}}
        <div class="rounded-2xl p-5 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #0ea5e9 0%, #0d9488 100%)">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full opacity-10" style="background:white"></div>
            <div class="flex items-start justify-between relative">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider opacity-80">Won Deals</p>
                    <p class="text-4xl font-bold mt-1">{{ $wonDeals }}</p>
                    <span class="inline-flex items-center mt-2 text-xs font-semibold px-2 py-0.5 rounded-full"
                          style="background:rgba(255,255,255,0.25)">
                        @if($wonChange[1]) ↑ @else ↓ @endif {{ $wonChange[0] }} vs tháng trước
                    </span>
                </div>
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:rgba(255,255,255,0.2)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs opacity-60 mt-3">Dự án SAP đã chốt thành công</p>
        </div>

        {{-- Card 4: Prospects (Blue) --}}
        <div class="rounded-2xl p-5 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #6366f1 0%, #2563eb 100%)">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full opacity-10" style="background:white"></div>
            <div class="flex items-start justify-between relative">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider opacity-80">New Prospects</p>
                    <p class="text-4xl font-bold mt-1">{{ $prospectLeads }}</p>
                    <span class="inline-flex items-center mt-2 text-xs font-semibold px-2 py-0.5 rounded-full"
                          style="background:rgba(255,255,255,0.25)">
                        Chờ qualify
                    </span>
                </div>
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:rgba(255,255,255,0.2)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs opacity-60 mt-3">Leads mới chưa đánh giá</p>
        </div>
    </div>

    {{-- ===== ROW 2: Secondary White Cards ===== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        {{-- Scopes --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#fef3c7">
                <svg class="w-6 h-6" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Scopes</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalScopes }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Phạm vi dự án SAP</p>
            </div>
            <a href="{{ route('filament.admin.resources.scopes.index') }}" class="text-xs text-blue-500 hover:text-blue-600 font-medium whitespace-nowrap">Xem →</a>
        </div>

        {{-- BANT --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#d1fae5">
                <svg class="w-6 h-6" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">BANT Assessed</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $bantDone }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Đã đánh giá BANT</p>
            </div>
            <a href="{{ route('filament.admin.resources.b-a-n-t-assessments.index') }}" class="text-xs text-blue-500 hover:text-blue-600 font-medium whitespace-nowrap">Xem →</a>
        </div>

        {{-- Timelines --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#dbeafe">
                <svg class="w-6 h-6" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Active Timelines</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $activeTimelines }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Tiến độ đang chạy</p>
            </div>
            <a href="{{ route('filament.admin.resources.timelines.index') }}" class="text-xs text-blue-500 hover:text-blue-600 font-medium whitespace-nowrap">Xem →</a>
        </div>

        {{-- Artifacts --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#fce7f3">
                <svg class="w-6 h-6" fill="none" stroke="#ec4899" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Artifacts</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $artifacts }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Tài liệu đã upload</p>
            </div>
            <a href="{{ route('filament.admin.resources.artifacts.index') }}" class="text-xs text-blue-500 hover:text-blue-600 font-medium whitespace-nowrap">Xem →</a>
        </div>

    </div>
</div>
