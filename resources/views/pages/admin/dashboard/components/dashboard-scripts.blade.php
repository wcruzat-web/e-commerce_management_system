{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Dashboard JavaScript
    DESCRIPTION: Frontend-only stubs for notifications, export, sync logs, sign out.
    TODO: Wire to API endpoints
--}}

<script>
    function toggleNotifications() {
        document.getElementById('notificationsDropdown').classList.toggle('hidden');
    }

    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('notificationsDropdown');
        const isBellClick = event.target.closest('button[onclick="toggleNotifications()"]');
        if (!dropdown.contains(event.target) && !isBellClick) {
            dropdown.classList.add('hidden');
        }
    });

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

    function signOut() {
        // TODO: POST /logout
        console.log('Signing out...');
    }
</script>
