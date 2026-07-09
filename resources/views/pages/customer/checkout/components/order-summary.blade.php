{{--
    ==================================================================
    ERP MODULE: Checkout — Shipping & Contact Details (Checkout Page)

    COMPONENT: Order Summary

    DESCRIPTION:
    Sidebar card showing items count, subtotal, shipping (dynamic),
    tax, and grand total. Shipping cost updates via JS when the
    user selects a different shipping method.

    ==================================================================

    TODO (Backend Integration):
    - Replace static values with $cart->subtotal / $cart->tax / $cart->shipping / $cart->grandTotal
    - Dynamically calculate tax rate from config
    - Live shipping price should come from ShippingMethod model

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
            <span id="summaryShipping" class="font-medium text-green-600">FREE</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-gray-500">Tax (8%)</span>
            <span class="font-medium text-gray-900">$202</span>
        </div>
    </div>

    <div class="border-t border-gray-100 my-4"></div>

    <div class="flex items-center justify-between mb-5">
        <span class="text-sm font-semibold text-gray-900">Grand Total</span>
        <span id="summaryGrandTotal" class="text-lg font-bold text-gray-900">$2,728</span>
    </div>

    <p class="flex items-center gap-1.5 text-xs text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <span id="summaryShippingNote">Free shipping on this order</span>
    </p>
</div>
