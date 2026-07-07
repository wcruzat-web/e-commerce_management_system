{{--
    ==================================================================
    ERP MODULE: Checkout — Order Confirmation (Success Page)
    ------------------------------------------------------------------
    FRONTEND-ONLY IMPLEMENTATION — NO BACKEND LOGIC INCLUDED.

    This view composes the full Success Page from
    page-scoped components stored alongside it in the
    pages/success/components/ directory.

    The checkout stepper is pulled from pages/cart/components/.

    The site header / top navigation lives in
    resources/views/layouts/app.blade.php and is rendered above
    @yield('content').

    Only the Success Page body is assembled here.

    TODO (Backend Integration):
      Controller: CheckoutController
      Method: showSuccess()
      Route: GET /checkout/success/{order}
      Replace static data with: $order->order_number, $order->grand_total, etc.
      Future: trigger confirmation email, link to tracking page
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
            <span class="text-gray-700 font-medium">Success</span>
        </nav>

        {{-- Checkout Stepper (active: success) --}}
        @include('pages.cart.components.checkout-stepper', ['activeStep' => 'success'])

        {{-- Main Grid: Order Confirmed (left) + Summary (right) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Order Confirmed --}}
            @include('pages.success.components.order-confirmed')

            {{-- Sidebar (no voucher — order is already placed) --}}
            <div class="space-y-6">
                @include('pages.success.components.order-summary')
            </div>

        </div>
    </div>
</div>

{{-- Frontend-only JavaScript --}}
@include('pages.success.components.success-scripts')

@endsection
