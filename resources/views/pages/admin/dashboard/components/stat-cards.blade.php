{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Stat Cards
    DESCRIPTION: 4 stat cards (Total Revenue, Orders, ERP Syncs, Low Stocks).
    TODO: Replace static $stats with $stats from DashboardController
--}}

@php
    $stats = [
        [
            'label' => 'Total Revenue',
            'value' => '₱247,340',
            'trend' => '+18.2% vs. last month',
            'trend_positive' => true,
            'icon' => 'peso',
            'icon_bg' => 'bg-blue-100 text-blue-900',
        ],
        [
            'label' => 'Orders This Month',
            'value' => '168',
            'trend' => '+15.9% vs. last month',
            'trend_positive' => true,
            'icon' => 'cart',
            'icon_bg' => 'bg-cyan-100 text-cyan-600',
        ],
        [
            'label' => 'Active ERP Syncs',
            'value' => '3 / 5',
            'trend' => '1 failed sync streams',
            'trend_positive' => false,
            'icon' => 'sync',
            'icon_bg' => 'bg-amber-100 text-amber-500',
        ],
        [
            'label' => 'Low Stocks Alert',
            'value' => '3 SKUs',
            'trend' => '+2 new required stocks',
            'trend_positive' => false,
            'icon' => 'alert',
            'icon_bg' => 'bg-red-100 text-red-500',
        ],
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
    @foreach ($stats as $stat)
        <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <p class="text-xs text-gray-400">{{ $stat['label'] }}</p>
                <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $stat['icon_bg'] }}">
                    @if($stat['icon'] === 'peso')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 3h8a4 4 0 0 1 0 8H6"></path>
                            <line x1="4" y1="9" x2="14" y2="9"></line>
                            <line x1="4" y1="13" x2="12" y2="13"></line>
                            <line x1="6" y1="3" x2="6" y2="21"></line>
                        </svg>
                    @elseif($stat['icon'] === 'cart')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    @elseif($stat['icon'] === 'sync')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    @endif
                </span>
            </div>
            <p class="text-xl font-bold text-gray-900">{{ $stat['value'] }}</p>
            <p class="text-xs mt-1 flex items-center gap-1 {{ $stat['trend_positive'] ? 'text-green-600' : 'text-red-500' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    @if($stat['trend_positive'])
                        <polyline points="18 15 12 9 6 15"></polyline>
                    @else
                        <polyline points="6 9 12 15 18 9"></polyline>
                    @endif
                </svg>
                {{ $stat['trend'] }}
            </p>
        </div>
    @endforeach
</div>
