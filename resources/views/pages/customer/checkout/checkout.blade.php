{{--
    ==================================================================
    ERP MODULE: Checkout — Shipping & Contact Details (Checkout Page)
    ------------------------------------------------------------------
    FRONTEND-ONLY IMPLEMENTATION — NO BACKEND LOGIC INCLUDED.

    This view composes the full Checkout Page from
    page-scoped components stored alongside it in the
    pages/checkout/components/ directory.

    Shared components (checkout stepper, voucher card) are
    pulled from pages/cart/components/ since they are identical.

    The site header / top navigation lives in
    resources/views/layouts/app.blade.php and is rendered above
    @yield('content').

    Only the Checkout Page body is assembled here.

    TODO (Backend Integration):
      Controller: CheckoutController
      Method: showDetails() / storeDetails()
      Route: GET /checkout
      Route: POST /checkout (save contact + shipping info)
      Replace static data with: $cart->summary(), $order->shippingAddress
      Future: prefill fields from authenticated $user->profile
    ==================================================================
--}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8" style="font-family: 'Outfit', sans-serif;">
    <div class="max-w-6xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-400 mb-6">
            <a href="#" class="hover:text-gray-600">Home</a>
            <span class="mx-2">&gt;</span>
            <span class="text-gray-700 font-medium">Checkout</span>
        </nav>

        {{-- Checkout Stepper (active: checkout) --}}
        @include('pages.customer.cart.components.checkout-stepper', ['activeStep' => 'checkout'])

        {{-- Main Grid: Checkout Details (left) + Summary (right) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Checkout Details --}}
            @include('pages.customer.checkout.components.checkout-details')

            {{-- Sidebar --}}
            <div class="space-y-6">
                @include('pages.customer.cart.components.voucher-card')
                @include('pages.customer.checkout.components.order-summary')
            </div>

        </div>
    </div>
</div>

{{-- Frontend-only JavaScript --}}
@include('pages.customer.checkout.components.checkout-scripts')

@endsection
