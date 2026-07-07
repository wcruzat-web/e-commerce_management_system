{{--
    ==================================================================
    ERP MODULE: Shopping Cart (Cart Page)
    ------------------------------------------------------------------
    FRONTEND-ONLY IMPLEMENTATION — NO BACKEND LOGIC INCLUDED.

    This view composes the full Cart Page from
    page-scoped components stored alongside it in the
    pages/cart/components/ directory.

    The site header / top navigation (promo bar, main nav,
    search / cart / account icons) lives in
    resources/views/layouts/app.blade.php and is rendered above
    @yield('content').

    Only the Cart Page body is assembled here.

    TODO (Backend Integration):
      Controller: CartController
      Method: index() / update() / destroy() / applyVoucher()
      Route: GET /cart
      Route: PATCH /cart/{item} (quantity update)
      Route: DELETE /cart/{item} (remove item)
      Route: POST /cart/voucher (apply coupon code)
      Replace static data with: $cart->items, $cart->subtotal, etc.
      Future: sync stock levels from Product model in real time
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
            <span class="text-gray-700 font-medium">Shopping Cart</span>
        </nav>

        {{-- Checkout Stepper --}}
        @include('pages.cart.components.checkout-stepper')

        {{-- Main Grid: Cart Items (left) + Summary (right) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Cart Items --}}
            @include('pages.cart.components.cart-items-list')

            {{-- Sidebar --}}
            <div class="space-y-6">
                @include('pages.cart.components.voucher-card')
                @include('pages.cart.components.order-summary')
            </div>

        </div>
    </div>
</div>

{{-- Frontend-only JavaScript --}}
@include('pages.cart.components.cart-scripts')

@endsection
