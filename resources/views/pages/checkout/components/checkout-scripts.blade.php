{{--
    ==================================================================
    ERP MODULE: Checkout — Shipping & Contact Details (Checkout Page)

    COMPONENT: Checkout Page JavaScript

    DESCRIPTION:
    Frontend-only behaviour for the checkout page.
    All functions are client-side stubs — no API calls yet.

    Includes:
      - Shipping method selection with live-updating summary
      - Apply voucher placeholder
      - Continue to payment payload assembly

    ==================================================================

    TODO (Backend Integration):
    - Wire continueToPayment() to POST /checkout
    - Wire applyVoucher() to POST /cart/voucher (or /checkout/voucher)
    - Redirect to GET /checkout/payment on success
    - Replace BASE_GRAND_TOTAL with dynamic total from server

    ==================================================================
--}}

<script>
    const BASE_GRAND_TOTAL = 2728;

    function selectShippingOption(radio) {
        document.querySelectorAll('.shipping-option').forEach(label => {
            label.classList.remove('border-cyan-500', 'bg-cyan-50/40');
            label.classList.add('border-gray-200');
        });

        const selectedLabel = radio.closest('.shipping-option');
        selectedLabel.classList.remove('border-gray-200');
        selectedLabel.classList.add('border-cyan-500', 'bg-cyan-50/40');

        const price = parseFloat(selectedLabel.dataset.shippingPrice);
        const shippingEl = document.getElementById('summaryShipping');
        const noteEl = document.getElementById('summaryShippingNote');

        if (price === 0) {
            shippingEl.textContent = 'FREE';
            shippingEl.classList.add('text-green-600');
            shippingEl.classList.remove('text-gray-900');
            noteEl.textContent = 'Free shipping on this order';
        } else {
            shippingEl.textContent = '$' + price;
            shippingEl.classList.remove('text-green-600');
            shippingEl.classList.add('text-gray-900');
            noteEl.textContent = 'Faster delivery selected';
        }

        document.getElementById('summaryGrandTotal').textContent = '$' + (BASE_GRAND_TOTAL + price).toLocaleString();
    }

    function applyVoucher() {
        const code = document.getElementById('voucherInput').value.trim();
        if (!code) return;
        // TODO: POST /cart/voucher with { code }
        console.log('Voucher applied:', code);
    }

    function continueToPayment() {
        const payload = {
            first_name: document.getElementById('firstName').value,
            last_name: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            street_address: document.getElementById('streetAddress').value,
            city: document.getElementById('city').value,
            state: document.getElementById('state').value,
            zip_code: document.getElementById('zipCode').value,
            shipping_method: document.querySelector('input[name="shippingMethod"]:checked')?.value,
        };
        // TODO: POST /checkout with `payload`, then redirect to GET /checkout/payment
        console.log('Continuing to payment with:', payload);
    }
</script>
