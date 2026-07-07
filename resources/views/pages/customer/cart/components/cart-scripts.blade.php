{{--
    ==================================================================
    ERP MODULE: Shopping Cart (Cart Page)

    COMPONENT: Cart Page JavaScript

    DESCRIPTION:
    Frontend-only behaviour for the shopping cart page.
    All functions are client-side stubs — no API calls yet.

    Includes:
      - Quantity stepper (changeQty) with stock limit
      - Remove item from cart
      - Recalculate summary (subtotal / tax / grand total)
      - Apply voucher placeholder
      - Proceed to checkout placeholder

    ==================================================================

    TODO (Backend Integration):
    - Wire changeQty() to PATCH /cart/{item}
    - Wire removeItem() to DELETE /cart/{item}
    - Wire applyVoucher() to POST /cart/voucher
    - Wire proceedToCheckout() to GET /checkout
    - Replace client-side math with server totals from CartController

    ==================================================================
--}}

<script>
    const TAX_RATE = 0.08;

    function changeQty(itemId, delta) {
        const row = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
        if (!row) return;

        const qtyEl = row.querySelector('.qty-value');
        let qty = parseInt(qtyEl.textContent, 10) + delta;
        const maxQty = parseInt(row.dataset.maxQty, 10);
        if (qty < 1) qty = 1;
        if (qty > maxQty) qty = maxQty;
        qtyEl.textContent = qty;

        const price = parseFloat(row.dataset.price);
        row.querySelector('.line-total').textContent = '$' + (price * qty).toLocaleString();

        // TODO (Cart Page): PATCH /cart/{item} with { quantity: qty }
        recalcSummary();
    }

    function removeItem(itemId) {
        const row = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
        if (!row) return;
        row.remove();

        // TODO (Cart Page): DELETE /cart/{item}
        recalcSummary();
    }

    function recalcSummary() {
        const rows = document.querySelectorAll('.cart-item');
        let subtotal = 0;

        rows.forEach(row => {
            const price = parseFloat(row.dataset.price);
            const qty = parseInt(row.querySelector('.qty-value').textContent, 10);
            subtotal += price * qty;
        });

        const tax = subtotal * TAX_RATE;
        const grandTotal = subtotal + tax;

        document.getElementById('itemCountBadge').textContent = rows.length + (rows.length === 1 ? ' item' : ' items');
        document.getElementById('summaryItemCount').textContent = rows.length;
        document.getElementById('summarySubtotal').textContent = '$' + subtotal.toLocaleString();
        document.getElementById('summaryTax').textContent = '$' + Math.round(tax).toLocaleString();
        document.getElementById('summaryGrandTotal').textContent = '$' + Math.round(grandTotal).toLocaleString();
    }

    function applyVoucher() {
        const code = document.getElementById('voucherInput').value.trim();
        if (!code) return;
        // TODO (Cart Page): POST /cart/voucher with { code }
        console.log('Voucher applied:', code);
    }

    function proceedToCheckout() {
        window.location.href = '/checkout';
    }
</script>
