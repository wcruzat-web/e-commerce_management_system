{{--
    ==================================================================
    ERP MODULE: Real-Time Order Synchronization (Tracking Page)

    COMPONENT: Shipment Meta Row

    DESCRIPTION:
    Displays carrier, tracking number, shipped-from location,
    and estimated delivery date in a 4-column grid.

    ==================================================================

    TODO (Backend Integration):
    - Replace static "J&T Express" with $order->carrier
    - Replace static "NX48291726" with $order->tracking_number
    - Replace static "Bulacan, Philippines" with $order->shipped_from
    - Replace static "July 2, 2026" with $order->est_delivery

    ==================================================================
--}}

<div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div>
            <p class="text-xs text-gray-400 mb-1">Carrier</p>
            <p class="text-sm font-semibold text-gray-900">J&amp;T Express</p>
        </div>
        <div>
            <p class="text-xs text-gray-400 mb-1">Tracking #</p>
            <p class="text-sm font-semibold text-cyan-500">NX48291726</p>
        </div>
        <div>
            <p class="text-xs text-gray-400 mb-1">Shipped From</p>
            <p class="text-sm font-semibold text-gray-900">Bulacan, Philippines</p>
        </div>
        <div>
            <p class="text-xs text-gray-400 mb-1">Est. Delivery</p>
            <p class="text-sm font-semibold text-gray-900">July 2, 2026</p>
        </div>
    </div>
</div>
