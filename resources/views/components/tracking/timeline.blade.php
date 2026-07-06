{{-- ============================================================
    ERP SYSTEM
    E-Commerce Management System

    MODULE
    Real-Time Order Synchronization

    COMPONENT
    Shipment Timeline

    DESCRIPTION
    Displays the shipment progress of the
    tracked order.

    Supports:

    • Minimized View
    • Expanded View

    ============================================================

    TODO: ERP INTEGRATION

    DATA SOURCE

    Shipping & Logistics Management Module

    Provides

    • Tracking History
    • Courier Status
    • Current Location
    • Event Timestamp
    • Delivery Progress

    NOTE

    This component is READ ONLY.

============================================================ --}}

<section class="w-full py-8">

    <div class="mx-auto max-w-7xl px-5 lg:px-10">

        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- ==================================================
                Header
            =================================================== --}}

            <div
                class="border-b border-gray-200 px-6 py-5">

                <h2
                    class="text-2xl font-semibold text-gray-900">

                    Shipment Timeline

                </h2>

                <p
                    class="mt-1 text-sm text-gray-500">

                    Follow your order from dispatch to delivery.

                </p>

            </div>

            {{-- ==================================================
                MINIMIZED TIMELINE

                Default View

                Frontend Only

                Hide when expanded.

            =================================================== --}}

            <div
                id="timelineMinimized"
                class="px-6 py-8">

                <div class="relative pl-10">

                    <div
                        class="absolute left-[10px] top-3 h-full w-0.5 bg-gray-200">
                    </div>

                    {{-- Current Status --}}
                    <div class="relative pb-10">

                        <span
                            class="absolute -left-[34px] top-1 h-5 w-5 rounded-full bg-red-600 ring-4 ring-red-100">
                        </span>

                        <h3
                            class="text-lg font-semibold text-gray-900">

                            In Transit

                        </h3>

                        <p
                            class="mt-1 text-gray-500">

                            Your package departed from the sorting facility.

                        </p>

                        <span
                            class="mt-2 block text-sm text-gray-400">

                            July 5, 2026 • 9:45 AM

                        </span>

                    </div>

                    {{-- Previous --}}
                    <div class="relative">

                        <span
                            class="absolute -left-[34px] top-1 h-5 w-5 rounded-full bg-green-500 ring-4 ring-green-100">
                        </span>

                        <h3
                            class="text-lg font-semibold text-gray-900">

                            Order Shipped

                        </h3>

                        <p
                            class="mt-1 text-gray-500">

                            Shipment successfully picked up by courier.

                        </p>

                        <span
                            class="mt-2 block text-sm text-gray-400">

                            July 4, 2026 • 6:30 PM

                        </span>

                    </div>

                </div>

            </div>

            {{-- ==================================================
                EXPANDED TIMELINE

                Hidden by default.

                Show using tracking.js

            =================================================== --}}

            <div
                id="timelineExpanded"
                class="hidden px-6 py-8">

                <div class="relative pl-10">

                    <div
                        class="absolute left-[10px] top-3 h-full w-0.5 bg-gray-200">
                    </div>

                    @php

                        $events = [

                            [
                                'title' => 'Order Placed',
                                'desc' => 'Customer successfully placed the order.',
                                'date' => 'July 3, 2026 • 8:00 AM',
                                'color' => 'bg-green-500'
                            ],

                            [
                                'title' => 'Payment Confirmed',
                                'desc' => 'Payment has been verified.',
                                'date' => 'July 3, 2026 • 8:20 AM',
                                'color' => 'bg-green-500'
                            ],

                            [
                                'title' => 'Preparing Shipment',
                                'desc' => 'Warehouse is preparing your package.',
                                'date' => 'July 4, 2026 • 10:00 AM',
                                'color' => 'bg-green-500'
                            ],

                            [
                                'title' => 'Order Shipped',
                                'desc' => 'Courier picked up your package.',
                                'date' => 'July 4, 2026 • 6:30 PM',
                                'color' => 'bg-green-500'
                            ],

                            [
                                'title' => 'In Transit',
                                'desc' => 'Package is moving to the destination hub.',
                                'date' => 'July 5, 2026 • 9:45 AM',
                                'color' => 'bg-red-600'
                            ],

                        ];

                    @endphp

                    @foreach ($events as $event)

                        <div class="relative pb-10 last:pb-0">

                            <span
                                class="absolute -left-[34px] top-1 h-5 w-5 rounded-full {{ $event['color'] }} ring-4 ring-white">
                            </span>

                            <h3
                                class="text-lg font-semibold text-gray-900">

                                {{ $event['title'] }}

                            </h3>

                            <p
                                class="mt-1 text-gray-500">

                                {{ $event['desc'] }}

                            </p>

                            <span
                                class="mt-2 block text-sm text-gray-400">

                                {{ $event['date'] }}

                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- ==================================================
                Footer

                TODO

                Connect button to tracking.js

            =================================================== --}}

            <div
                class="border-t border-gray-200 bg-gray-50 px-6 py-5">

                <button

                    id="toggleTimeline"

                    type="button"

                    class="rounded-xl
                           bg-red-600
                           px-6
                           py-3
                           text-sm
                           font-medium
                           text-white
                           transition
                           duration-300
                           hover:bg-red-700">

                    Show More Details

                </button>

            </div>

        </div>

    </div>

</section>
