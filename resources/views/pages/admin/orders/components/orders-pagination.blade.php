{{--
    ERP MODULE: Admin Orders
    COMPONENT: Orders Pagination
    DESCRIPTION: Pagination bar with page numbers.
    TODO: Wire to backend pagination
--}}

<div class="flex items-center justify-between pt-4">
    <p class="text-sm text-gray-400">Showing 1–8 of 24 orders</p>
    <div class="flex items-center gap-1">
        {{-- Previous --}}
        <button class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        {{-- Pages --}}
        <button class="w-8 h-8 rounded-lg bg-cyan-500 text-white text-sm font-medium">1</button>
        <button class="w-8 h-8 rounded-lg border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition-colors">2</button>
        <button class="w-8 h-8 rounded-lg border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition-colors">3</button>
        {{-- Next --}}
        <button class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
    </div>
</div>
