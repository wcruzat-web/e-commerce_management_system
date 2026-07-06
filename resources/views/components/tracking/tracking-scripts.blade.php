{{--
    ==================================================================
    ERP MODULE: Real-Time Order Synchronization (Tracking Page)

    COMPONENT: Tracking Page JavaScript

    DESCRIPTION:
    Frontend-only behaviour for the tracking page.
    All functions are client-side stubs — no API calls yet.

    Includes:
      - Timeline toggle (collapsed / expanded views)
      - Copy Order ID to clipboard
      - Track Another Order form handler
      - Floating chat widget toggle

    ==================================================================

    TODO (Backend Integration):
    - Wire trackAnotherOrder() to POST /orders/track
    - Wire toggleChatWidget() to live-chat widget / support modal

    ==================================================================
--}}

<script>
    function toggleTimelineDetails() {
        const collapsed = document.getElementById('timelineCollapsed');
        const expanded = document.getElementById('timelineExpanded');
        const label = document.getElementById('timelineToggleLabel');
        const icon = document.getElementById('timelineToggleIcon');

        const isExpanded = !expanded.classList.contains('hidden');

        if (isExpanded) {
            expanded.classList.add('hidden');
            collapsed.classList.remove('hidden');
            label.textContent = 'Show more details';
            icon.classList.remove('rotate-180');
        } else {
            collapsed.classList.add('hidden');
            expanded.classList.remove('hidden');
            label.textContent = 'Show less details';
            icon.classList.add('rotate-180');
        }
    }

    function copyOrderId() {
        const orderId = document.getElementById('orderIdText').textContent.trim();
        if (navigator.clipboard) {
            navigator.clipboard.writeText(orderId);
        }
    }

    function trackAnotherOrder() {
        const value = document.getElementById('trackInput').value.trim();
        if (!value) return;
        // TODO: submit `value` to OrderController@trackOrder()
        console.log('Tracking lookup requested for:', value);
    }

    function toggleChatWidget() {
        // TODO: open live-chat widget or support modal
        console.log('Support chat toggled');
    }
</script>
