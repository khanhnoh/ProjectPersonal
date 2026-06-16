@php
$deploymentLabels = [
    'public_cloud'  => 'Public Cloud',
    'private_cloud' => 'Private Cloud',
    'on_premise'    => 'On-Premise',
    'hybrid'        => 'Hybrid',
];
$deploymentColors = [
    'public_cloud'  => '#3b82f6',
    'private_cloud' => '#f59e0b',
    'on_premise'    => '#6b7280',
    'hybrid'        => '#10b981',
];
$industryLabels = [
    'manufacturing'   => 'Sản xuất',
    'retail'          => 'Bán lẻ',
    'chemical_pharma' => 'Hóa chất / Pharma',
    'oil_gas'         => 'Dầu khí',
    'construction'    => 'Xây dựng',
    'financial'       => 'Tài chính',
    'utilities'       => 'Tiện ích',
    'public_sector'   => 'Nhà nước',
    'healthcare'      => 'Y tế',
    'fmcg'            => 'FMCG',
    'logistics'       => 'Logistics',
    'other'           => 'Khác',
];
@endphp

<div class="space-y-4 h-full">

    {{-- SAP Modules Top 6 --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#ede9fe">
                <svg class="w-4 h-4" fill="none" stroke="#7c3aed" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">SAP Modules</h3>
                <p class="text-xs text-gray-400">Top phân hệ được yêu cầu</p>
            </div>
        </div>

        @if(empty($topModules))
            <p class="text-sm text-gray-400 text-center py-4">Chưa có dữ liệu</p>
        @else
            @php $maxCount = max(array_values($topModules)); @endphp
            <div class="space-y-2.5">
                @foreach($topModules as $module => $count)
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-gray-700 dark:text-gray-300">{{ $module }}</span>
                            <span class="text-gray-400">{{ $count }}</span>
                        </div>
                        <div class="h-1.5 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all"
                                 style="width:{{ $maxCount > 0 ? round($count/$maxCount*100) : 0 }}%; background: linear-gradient(90deg, #6366f1, #3b82f6)">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Deployment Type --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#dcfce7">
                <svg class="w-4 h-4" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Deployment</h3>
                <p class="text-xs text-gray-400">Hình thức triển khai</p>
            </div>
        </div>

        @if(empty($deploymentCounts))
            <p class="text-sm text-gray-400 text-center py-2">Chưa có dữ liệu</p>
        @else
            <div class="space-y-2">
                @foreach($deploymentCounts as $type => $count)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full" style="background:{{ $deploymentColors[$type] ?? '#94a3b8' }}"></div>
                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ $deploymentLabels[$type] ?? $type }}</span>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Industry Mix --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#fef3c7">
                <svg class="w-4 h-4" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Industry Mix</h3>
                <p class="text-xs text-gray-400">Top ngành nghề</p>
            </div>
        </div>

        @if(empty($industryCounts))
            <p class="text-sm text-gray-400 text-center py-2">Chưa có dữ liệu</p>
        @else
            <div class="space-y-2">
                @foreach($industryCounts as $industry => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-600 dark:text-gray-400 truncate pr-2">{{ $industryLabels[$industry] ?? $industry }}</span>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full flex-shrink-0">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
