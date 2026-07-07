{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Low Stocks Alert
    DESCRIPTION: Low stock products list with progress bars.
    TODO: Replace with $lowStockProducts from DashboardController
--}}

<div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <h2 class="text-sm font-semibold text-gray-900">Low Stocks Alert</h2>
        </div>
        <span class="text-[11px] font-medium bg-red-100 text-red-600 px-2.5 py-0.5 rounded-full">3 SKUs</span>
    </div>

    @php
        $lowStock = [
            ['name' => 'NVIDIA RTX 4090 FE', 'sku' => 'NV-4090-FE', 'left' => 2, 'pct' => 4, 'max' => 50],
            ['name' => 'Intel Core i9-14900K', 'sku' => 'IN-14900K', 'left' => 7, 'pct' => 7, 'max' => 100],
            ['name' => 'ASUS ROG Maximus Z790', 'sku' => 'AS-Z790-MX', 'left' => 4, 'pct' => 13, 'max' => 30],
        ];
    @endphp

    <div class="space-y-3">
        @foreach ($lowStock as $product)
            <div>
                <div class="flex items-center justify-between text-sm mb-1">
                    <span class="font-medium text-gray-900">{{ $product['name'] }}</span>
                    <span class="text-xs font-semibold text-red-500">{{ $product['left'] }} left</span>
                </div>
                <p class="text-[11px] text-gray-400 mb-1">{{ $product['sku'] }}</p>
                <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full bg-red-400" style="width: {{ $product['pct'] }}%"></div>
                    </div>
                    <span class="text-[10px] text-gray-400 whitespace-nowrap">{{ $product['pct'] }}% of max stock ({{ $product['max'] }})</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
