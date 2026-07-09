{{--
    ERP MODULE: Admin Orders
    COMPONENT: Orders Toolbar
    DESCRIPTION: Search input, status filter, and date filter.
    TODO (Backend): Replace client-side filtering with AJAX or form
                    submission to DashboardController@orders.
--}}

<div class="flex items-center justify-between flex-wrap gap-3">
    {{-- Search --}}
    <div class="relative flex-1 max-w-xs">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" data-orders-search placeholder="Search orders..." class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-200 focus:border-cyan-400">
    </div>
    {{-- Filters --}}
    <div class="flex items-center gap-3">
        <select data-orders-status class="text-sm border border-gray-200 rounded-lg px-3 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-200 focus:border-cyan-400">
            <option value="">All Status</option>
            <option value="Shipped">Shipped</option>
            <option value="Processing">Processing</option>
            <option value="Delivered">Delivered</option>
            <option value="Cancelled">Cancelled</option>
        </select>
        <select data-orders-date class="text-sm border border-gray-200 rounded-lg px-3 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-200 focus:border-cyan-400">
            <option value="">All Dates</option>
            <option value="today">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
            <option value="custom">Custom Range</option>
        </select>
    </div>
</div>
