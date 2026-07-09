{{--
    ==================================================================
    ERP MODULE: Real-Time Order Synchronization (Tracking Page)
    ------------------------------------------------------------------
    FRONTEND-ONLY IMPLEMENTATION — NO BACKEND LOGIC INCLUDED.

    This view composes the full Tracking Page from
    page-scoped components stored alongside it in the
    pages/order-tracking/components/ directory.

    The site header / top navigation (promo bar, nav links,
    search / cart / account icons) lives in
    resources/views/layouts/app.blade.php and is rendered above
    @yield('content').

    Only the Tracking Page body is assembled here.

    TODO (Backend Integration):
      Controller: OrderController
      Method: trackOrder() / search()
      Route: POST /orders/track
      Input: order_id or tracking_number
      Replace static data with: $order->status, $order->items, etc.
      Future: integrate real-time status updates (Echo / Pusher / Polling)
      Future: connect order timeline from OrderStatus model
    ==================================================================
--}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#f5f5f5] py-8 px-4 sm:px-6 lg:px-8" style="font-family: 'Outfit', sans-serif;">
    <div class="max-w-5xl mx-auto space-y-5">

        {{-- ============================================================
             PAGE TITLE
             TODO: Replace "[business name]" with config('app.name')
                   or tenant/store name.
        ============================================================= --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Order Tracking</h1>
            <p class="text-sm text-gray-500 mt-1">Real-time updates on your [business name] PC order.</p>
        </div>

        {{-- Track Another Order --}}
        @include('pages.customer.order-tracking.components.track-another-order')

        {{-- Order ID / Current Status Banner --}}
        @include('pages.customer.order-tracking.components.order-status-banner')

        {{-- Shipment Meta Row --}}
        @include('pages.customer.order-tracking.components.shipment-meta')

        {{-- Shipment Timeline --}}
        @include('pages.customer.order-tracking.components.timeline')

        {{-- Items in this Shipment --}}
        @include('pages.customer.order-tracking.components.shipment-items')

        {{-- Support Shortcuts --}}
        @include('pages.customer.order-tracking.components.support-shortcuts')

    </div>

    {{-- Floating Support / Chat Button --}}
    @include('pages.customer.order-tracking.components.chat-button')
</div>

{{-- Frontend-only JavaScript --}}
@include('pages.customer.order-tracking.components.tracking-scripts')

@endsection
