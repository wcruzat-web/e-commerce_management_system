{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Revenue Section
    DESCRIPTION: Revenue overview line chart + revenue by category breakdown.
    TODO: Replace with $revenueSeries / $revenueByCategory from DashboardController
--}}

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-900">Revenue Overview</h2>
        <p class="text-xs text-gray-400 mb-4">Last 6 months performance</p>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 560 200" class="w-full h-48">
            <g stroke="#f1f5f9" stroke-width="1">
                <line x1="50" y1="10" x2="550" y2="10"></line>
                <line x1="50" y1="48" x2="550" y2="48"></line>
                <line x1="50" y1="86" x2="550" y2="86"></line>
                <line x1="50" y1="124" x2="550" y2="124"></line>
                <line x1="50" y1="162" x2="550" y2="162"></line>
            </g>
            <g class="fill-gray-400" font-size="10" text-anchor="end">
                <text x="44" y="14">₱250k</text>
                <text x="44" y="52">₱187k</text>
                <text x="44" y="90">₱125k</text>
                <text x="44" y="128">₱62k</text>
                <text x="44" y="166">₱0k</text>
            </g>
            <polyline points="70,120 154,100 238,78 322,116 406,84 490,30" fill="none" stroke="#06b6d4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></polyline>
            <g fill="#06b6d4">
                <circle cx="70" cy="120" r="4"></circle>
                <circle cx="154" cy="100" r="4"></circle>
                <circle cx="238" cy="78" r="4"></circle>
                <circle cx="322" cy="116" r="4"></circle>
                <circle cx="406" cy="84" r="4"></circle>
                <circle cx="490" cy="30" r="4"></circle>
            </g>
            <g class="fill-gray-400" font-size="10" text-anchor="middle">
                <text x="70" y="186">July</text>
                <text x="154" y="186">August</text>
                <text x="238" y="186">September</text>
                <text x="322" y="186">October</text>
                <text x="406" y="186">November</text>
                <text x="490" y="186">December</text>
            </g>
        </svg>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-900">Revenue by Category</h2>
        <p class="text-xs text-gray-400 mb-4">June 2026</p>

        @php
            $categories = [
                ['label' => 'GPUs', 'amount' => '₱85.2k', 'pct' => 34, 'color' => 'bg-blue-900'],
                ['label' => 'CPUs', 'amount' => '₱61.4k', 'pct' => 25, 'color' => 'bg-cyan-500'],
                ['label' => 'Boards', 'amount' => '₱43.3k', 'pct' => 18, 'color' => 'bg-sky-300'],
                ['label' => 'Memory', 'amount' => '₱29.9k', 'pct' => 12, 'color' => 'bg-purple-400'],
            ];
        @endphp

        <div class="space-y-4">
            @foreach ($categories as $cat)
                <div>
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="text-gray-600">{{ $cat['label'] }}</span>
                        <span class="text-gray-900 font-medium">{{ $cat['amount'] }} <span class="text-gray-400">{{ $cat['pct'] }}%</span></span>
                    </div>
                    <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full {{ $cat['color'] }}" style="width: {{ $cat['pct'] * 2.2 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
