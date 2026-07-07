{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Dashboard JavaScript
    DESCRIPTION: Frontend-only stubs for notifications, export, sync logs, sign out.
    TODO: Wire to API endpoints
--}}

<script>
    let exportToastTimer = null;
    function exportReport() {
        const toast = document.getElementById('exportToast');
        toast.classList.remove('hidden');

        clearTimeout(exportToastTimer);
        exportToastTimer = setTimeout(() => {
            toast.classList.add('hidden');
        }, 3500);
        
        console.log('Export report triggered...');
    }

    function viewSyncLogs() {
        // TODO: navigate to GET /admin/erp/sync-logs
        console.log('Viewing sync logs...');
    }

</script>
