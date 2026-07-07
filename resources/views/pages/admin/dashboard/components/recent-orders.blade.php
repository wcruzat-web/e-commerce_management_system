{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Recent Orders
    DESCRIPTION: Recent orders table with status badges.
    TODO: Replace with $recentOrders from DashboardController
--}}

<div class="xl:col-span-2 bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-sm font-semibold text-gray-900">Recent Orders</h2>
        <a href="{{ route('admin.orders') }}" class="text-xs font-medium text-cyan-500 hover:text-cyan-600">View all &gt;</a>
    </div>

    @php
        $recentOrders = [
            ['name' => 'Alex Morgan', 'spec' => 'RTX 4090 + i9-14900K', 'price' => '₱21,148', 'status' => 'Shipped'],
            ['name' => 'Sarah Chen', 'spec' => 'ROG Maximus Z790', 'price' => '₱42,639', 'status' => 'Processing'],
            ['name' => 'Marcus Davis', 'spec' => 'Ryzen 9 7950X + DDR5', 'price' => '₱60,878', 'status' => 'Processing'],
            ['name' => 'Elena Rodriguez', 'spec' => 'RTX 4080 Super', 'price' => '₱23,058', 'status' => 'Delivered'],
        ];
    @endphp

    <div class="divide-y divide-gray-100">
        @foreach ($recentOrders as $order)
            <div class="flex items-center justify-between py-3 {{ $loop->first ? 'pt-0' : '' }}">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gray-200 shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $order['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $order['spec'] }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <p class="text-sm font-semibold text-gray-900">{{ $order['price'] }}</p>
                    <span class="text-[11px] font-medium px-2.5 py-1 rounded-full
                        @if($order['status'] === 'Shipped') bg-blue-100 text-blue-700
                        @elseif($order['status'] === 'Processing') bg-amber-100 text-amber-600
                        @else bg-green-100 text-green-700
                        @endif">
                        {{ $order['status'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
