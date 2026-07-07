{{--
    ==================================================================
    ERP MODULE: Checkout — Order Confirmation (Success Page)

    COMPONENT: Order Summary

    DESCRIPTION:
    Sidebar card showing finalized order totals.
    No voucher card or checkout button — order is already placed.

    ==================================================================

    TODO (Backend Integration):
    - Replace static values with $order->subtotal / $order->tax / $order->shipping / $order->grandTotal

    ==================================================================
--}}

<div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
    <h2 class="text-sm font-semibold text-gray-900 mb-4">Order Summary</h2>

    <div class="space-y-2.5 text-sm">
        <div class="flex items-center justify-between">
            <span class="text-gray-500">Items (3)</span>
            <span class="font-medium text-gray-900">$2,715</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="flex items-center gap-1.5 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13"></rect>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
                Shipping
            </span>
            <span class="font-medium text-green-600">FREE</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-gray-500">Tax (8%)</span>
            <span class="font-medium text-gray-900">$202</span>
        </div>
    </div>

    <div class="border-t border-gray-100 my-4"></div>

    <div class="flex items-center justify-between mb-1">
        <span class="text-sm font-semibold text-gray-900">Grand Total</span>
        <span class="text-lg font-bold text-gray-900">$2,728</span>
    </div>

    <p class="flex items-center gap-1.5 text-xs text-gray-400 mt-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        Free shipping on this order
    </p>
</div>
