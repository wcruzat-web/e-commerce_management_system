{{--
    ==================================================================
    ERP MODULE: Real-Time Order Synchronization (Tracking Page)

    COMPONENT: Items in this Shipment

    DESCRIPTION:
    Lists all products included in the tracked shipment,
    with icon, name, quantity, and price.

    ==================================================================

    TODO (Backend Integration):
    - Replace static $shipmentItems with $order->items
      (OrderItem model relationship)
    - Replace static product icons with dynamic type-based icons
    - Pull real product names, quantities, and prices from DB

    ==================================================================
--}}

@php
    // TODO: replace with $order->items relationship
    $shipmentItems = [
        ['name' => 'NVIDIA RTX 4050 FE', 'qty' => 1, 'price' => '₱45,999', 'type' => 'gpu'],
        ['name' => 'Intel Core i9 14-900K', 'qty' => 1, 'price' => '₱32,940', 'type' => 'cpu'],
    ];
@endphp

<div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
    <h2 class="text-sm font-semibold text-gray-900 mb-4">Items in this Shipment</h2>
    <div class="space-y-3">
        @foreach ($shipmentItems as $item)
            <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500 shrink-0">
                        @if($item['type'] === 'gpu')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="10" rx="2"></rect>
                                <circle cx="8" cy="12" r="2"></circle>
                                <circle cx="14" cy="12" r="2"></circle>
                                <line x1="19" y1="10" x2="19" y2="14"></line>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="6" y="6" width="12" height="12" rx="1"></rect>
                                <rect x="10" y="10" width="4" height="4"></rect>
                                <line x1="6" y1="2" x2="6" y2="5"></line>
                                <line x1="10" y1="2" x2="10" y2="5"></line>
                                <line x1="14" y1="2" x2="14" y2="5"></line>
                                <line x1="18" y1="2" x2="18" y2="5"></line>
                                <line x1="6" y1="19" x2="6" y2="22"></line>
                                <line x1="10" y1="19" x2="10" y2="22"></line>
                                <line x1="14" y1="19" x2="14" y2="22"></line>
                                <line x1="18" y1="19" x2="18" y2="22"></line>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $item['name'] }}</p>
                        <p class="text-xs text-gray-400">Qty: {{ $item['qty'] }}</p>
                    </div>
                </div>
                <p class="text-sm font-semibold text-gray-900">{{ $item['price'] }}</p>
            </div>
        @endforeach
    </div>
</div>
