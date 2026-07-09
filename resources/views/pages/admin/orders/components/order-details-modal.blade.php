{{--
    ERP MODULE: Admin Orders
    COMPONENT: Order Details Modal
    DESCRIPTION: Slide-over panel showing full order details.
    TODO: Replace static data with $order data from backend
--}}

{{-- Overlay --}}
<div id="orderModal" class="hidden fixed inset-0 z-50">
    <div class="absolute inset-0 bg-black/30" onclick="closeOrderModal()"></div>
    {{-- Panel --}}
    <div class="absolute right-0 top-0 h-full w-full max-w-lg bg-white shadow-2xl overflow-y-auto max-lg:max-w-full">
        <div class="p-6">
            {{-- Modal header --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900">Order Details</h2>
                <button type="button" onclick="closeOrderModal()" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            {{-- Customer info --}}
            <div class="mb-6">
                <p class="text-xs text-gray-400 mb-1">Customer</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 shrink-0"></div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900" id="modalCustomerName">Alex Morgan</p>
                        <p class="text-xs text-gray-400">alex@example.com</p>
                    </div>
                </div>
            </div>

            {{-- Order info --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Order ID</p>
                    <p class="text-sm font-medium text-gray-900">#ORD-2026-0042</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Date</p>
                    <p class="text-sm font-medium text-gray-900">2026-07-05</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Status</p>
                    <span class="status-badge text-[11px] font-medium px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">Shipped</span>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Payment</p>
                    <p class="text-sm font-medium text-gray-900">Paid via GCash</p>
                </div>
            </div>

            {{-- Items --}}
            <div class="mb-6">
                <p class="text-xs text-gray-400 mb-2">Items (2)</p>
                <div class="divide-y divide-gray-100 border border-gray-200 rounded-xl">
                    <div class="flex items-center justify-between px-4 py-3">
                        <div>
                            <p class="text-sm font-medium text-gray-900">NVIDIA RTX 4090 FE</p>
                            <p class="text-xs text-gray-400">Qty: 1</p>
                        </div>
                        <p class="text-sm font-semibold text-gray-900">₱18,999</p>
                    </div>
                    <div class="flex items-center justify-between px-4 py-3">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Intel Core i9-14900K</p>
                            <p class="text-xs text-gray-400">Qty: 1</p>
                        </div>
                        <p class="text-sm font-semibold text-gray-900">₱2,149</p>
                    </div>
                </div>
            </div>

            {{-- Total --}}
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                <p class="text-sm font-semibold text-gray-900">Total</p>
                <p class="text-lg font-bold text-gray-900">₱21,148</p>
            </div>
        </div>
    </div>
</div>

<script>
    function openOrderModal() {
        document.getElementById('orderModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
</script>
