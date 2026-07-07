{{--
    ERP MODULE: Admin Orders
    COMPONENT: Orders Table
    DESCRIPTION: Full orders table with status badges.
    TODO: Replace with $orders from backend
--}}

<div class="orders-print-area bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        {{-- Table header --}}
        <thead>
            <tr class="border-b border-gray-100 text-left text-xs text-gray-400 uppercase tracking-wider">
                <th class="px-5 py-3 font-medium">Customer</th>
                <th class="px-5 py-3 font-medium">Items</th>
                <th class="px-5 py-3 font-medium">Total</th>
                <th class="px-5 py-3 font-medium">Status</th>
                <th class="px-5 py-3 font-medium">Date</th>
            </tr>
        </thead>
        {{-- Table body --}}
        <tbody class="divide-y divide-gray-50">
            @php
                $orders = [
                    ['name' => 'Alex Morgan', 'items' => 'RTX 4090 + i9-14900K', 'total' => '₱21,148', 'status' => 'Shipped', 'date' => '2026-07-05'],
                    ['name' => 'Sarah Chen', 'items' => 'ROG Maximus Z790', 'total' => '₱42,639', 'status' => 'Processing', 'date' => '2026-07-04'],
                    ['name' => 'Marcus Davis', 'items' => 'Ryzen 9 7950X + DDR5', 'total' => '₱60,878', 'status' => 'Processing', 'date' => '2026-07-04'],
                    ['name' => 'Elena Rodriguez', 'items' => 'RTX 4080 Super', 'total' => '₱23,058', 'status' => 'Delivered', 'date' => '2026-07-02'],
                    ['name' => 'James Wilson', 'items' => 'i7-13700K + Z790', 'total' => '₱38,420', 'status' => 'Delivered', 'date' => '2026-07-01'],
                    ['name' => 'Priya Sharma', 'items' => 'RX 7900 XTX', 'total' => '₱19,999', 'status' => 'Cancelled', 'date' => '2026-06-30'],
                    ['name' => 'Daniel Kim', 'items' => 'DDR5 32GB Kit', 'total' => '₱8,499', 'status' => 'Delivered', 'date' => '2026-06-29'],
                    ['name' => 'Olivia Brown', 'items' => 'RTX 4070 Ti + PSU', 'total' => '₱35,740', 'status' => 'Shipped', 'date' => '2026-06-28'],
                ];
            @endphp
            @foreach ($orders as $order)
                {{-- Order row (click to view details) --}}
                <tr class="hover:bg-gray-50 transition-colors cursor-pointer" onclick="openOrderModal()">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-200 shrink-0"></div>
                            <span class="font-medium text-gray-900">{{ $order['name'] }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-600">{{ $order['items'] }}</td>
                    <td class="px-5 py-3 font-semibold text-gray-900">{{ $order['total'] }}</td>
                    <td class="px-5 py-3">
                        {{-- Status badge with color coding --}}
                        <span class="status-badge text-[11px] font-medium px-2.5 py-1 rounded-full
                            @if($order['status'] === 'Shipped') bg-blue-100 text-blue-700
                            @elseif($order['status'] === 'Processing') bg-amber-100 text-amber-600
                            @elseif($order['status'] === 'Cancelled') bg-red-100 text-red-600
                            @else bg-green-100 text-green-700
                            @endif">
                            {{ $order['status'] }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-400">{{ $order['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
