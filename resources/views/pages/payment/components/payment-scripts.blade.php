{{--
    ==================================================================
    ERP MODULE: Checkout — Payment (Payment Page)

    COMPONENT: Payment Page JavaScript

    DESCRIPTION:
    Frontend-only behaviour for the payment page.
    All functions are client-side stubs — no API calls yet.

    Includes:
      - Payment method tab switching (Visa / Mastercard / G-Cash)
      - Place order payload assembly
      - Back navigation
      - Apply voucher placeholder

    ==================================================================

    TODO (Backend Integration):
    - Wire placeOrder() to POST /checkout/payment
    - Wire applyVoucher() to POST /cart/voucher (or /checkout/voucher)
    - Replace console.log with actual API calls
    - Integrate real payment gateway (Stripe / PayMongo / GCash API)
    - Tokenize card fields client-side before hitting the server

    ==================================================================
--}}

<script>
    function selectPaymentMethod(method) {
        document.querySelectorAll('.payment-method-btn').forEach(btn => {
            if (btn.dataset.method === method) {
                btn.classList.remove('border-gray-200', 'text-gray-500');
                btn.classList.add('border-cyan-500', 'text-cyan-500');
            } else {
                btn.classList.remove('border-cyan-500', 'text-cyan-500');
                btn.classList.add('border-gray-200', 'text-gray-500');
            }
        });

        const cardFields = document.getElementById('cardFields');
        const gcashFields = document.getElementById('gcashFields');

        if (method === 'gcash') {
            cardFields.classList.add('hidden');
            gcashFields.classList.remove('hidden');
        } else {
            gcashFields.classList.add('hidden');
            cardFields.classList.remove('hidden');
        }
    }

    function goBack() {
        // TODO: navigate back to GET /checkout
        window.history.back();
    }

    function placeOrder() {
        const method = document.querySelector('.payment-method-btn.border-cyan-500')?.dataset.method;

        const payload = method === 'gcash'
            ? {
                payment_method: method,
                gcash_name: document.getElementById('gcashName').value,
                gcash_number: document.getElementById('gcashNumber').value,
              }
            : {
                payment_method: method,
                cardholder_name: document.getElementById('cardholderName').value,
                card_number: document.getElementById('cardNumber').value,
                expiry_date: document.getElementById('expiryDate').value,
                cvv: document.getElementById('cvv').value,
              };

        // TODO: POST /checkout/payment with `payload`
        window.location.href = '/success';
    }

    function applyVoucher() {
        const code = document.getElementById('voucherInput').value.trim();
        if (!code) return;
        // TODO: POST /cart/voucher with { code }
        console.log('Voucher applied:', code);
    }
</script>
