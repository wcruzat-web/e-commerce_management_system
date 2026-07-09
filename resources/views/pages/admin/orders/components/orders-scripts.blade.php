{{--
    ERP MODULE: Admin Orders
    COMPONENT: Orders Scripts
    DESCRIPTION: Client-side filtering for search, status, and date.
    TODO (Backend): Remove this — replace with server-side filtering.
--}}

<script>
    const searchInput = document.querySelector('[data-orders-search]');
    const statusFilter = document.querySelector('[data-orders-status]');
    const dateFilter = document.querySelector('[data-orders-date]');
    const orderRows = document.querySelectorAll('[data-order-row]');

    function matchesDateFilter(rowDateStr, filter) {
        if (!filter) return true;
        const d = new Date(rowDateStr);
        if (isNaN(d.getTime())) return false;
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (filter === 'today') {
            return d.getTime() === today.getTime();
        }
        if (filter === 'week') {
            const startOfWeek = new Date(today);
            startOfWeek.setDate(today.getDate() - today.getDay());
            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6);
            return d >= startOfWeek && d <= endOfWeek;
        }
        if (filter === 'month') {
            return d.getFullYear() === today.getFullYear() && d.getMonth() === today.getMonth();
        }
        return true;
    }

    function filterOrders() {
        const query = (searchInput?.value || '').toLowerCase();
        const status = statusFilter?.value || '';
        const dateFilterVal = dateFilter?.value || '';

        orderRows.forEach(row => {
            const name = (row.dataset.customerName || '').toLowerCase();
            const rowStatus = row.dataset.orderStatus || '';
            const rowDate = row.dataset.orderDate || '';

            const matchesSearch = name.includes(query);
            const matchesStatus = !status || rowStatus === status;
            const matchesDate = matchesDateFilter(rowDate, dateFilterVal);

            row.style.display = matchesSearch && matchesStatus && matchesDate ? '' : 'none';
        });
    }

    searchInput?.addEventListener('input', filterOrders);
    statusFilter?.addEventListener('change', filterOrders);
    dateFilter?.addEventListener('change', filterOrders);
</script>
