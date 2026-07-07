{{--
    ==================================================================
    ERP MODULE: Checkout — Order Confirmation (Success Page)

    COMPONENT: Success Page JavaScript

    DESCRIPTION:
    Frontend-only stubs for post-order actions.

    Includes:
      - Navigate to Track Order page
      - Navigate back to shopping

    ==================================================================

    TODO (Backend Integration):
    - Wire trackOrder() to route('orders.track', $order)
    - Wire continueShopping() to route('products.index')

    ==================================================================
--}}

<script>
    function trackOrder() {
        window.location.href = '/tracking';
    }

    function continueShopping() {
        // TODO: navigate to GET /shop or route('products.index')
        console.log('Navigating back to shopping...');
    }
</script>
