{{--
    ==================================================================
    ERP MODULE: Real-Time Order Synchronization (Tracking Page)

    COMPONENT: Order ID / Current Status Banner

    DESCRIPTION:
    Displays the Order ID with a copy-to-clipboard button
    and the current shipment status badge.

    ==================================================================

    TODO (Backend Integration):
    - Replace static "NX-2026-48291" with $order->order_number
    - Replace static "In Transit" with $order->status
      (e.g. In Transit / Processing / Delivered)
    - Dynamically set the status badge colour based on status

    ==================================================================
--}}

<div class="bg-blue-900 rounded-2xl px-6 py-5 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="text-xs text-blue-200/80 mb-1">Order ID</p>
        <div class="flex items-center gap-2">
            <span id="orderIdText" class="text-white text-xl font-bold tracking-wide">NX-2026-48291</span>
            <button type="button" onclick="copyOrderId()" title="Copy Order ID" class="text-blue-200 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="9" y="9" width="11" height="11" rx="2"></rect>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="text-right">
        <p class="text-xs text-blue-200/80 mb-1">Current Status</p>
        <span class="inline-block bg-cyan-500 text-white text-sm font-semibold px-4 py-1.5 rounded-full">
            In Transit
        </span>
    </div>
</div>
