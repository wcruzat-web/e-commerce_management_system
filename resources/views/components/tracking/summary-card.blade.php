{{-- ============================================================
    ERP SYSTEM
    E-Commerce Management System

    MODULE
    Real-Time Order Synchronization

    COMPONENT
    Order Summary Card

    DESCRIPTION
    Displays the summarized information of the
    tracked order.

    ============================================================

    TODO: ERP INTEGRATION

    DATA SOURCES

    Sales Management System
    • Order Number
    • Order Date
    • Customer Name

    Shipping & Logistics Management
    • Tracking Number
    • Courier
    • Delivery Status
    • Estimated Delivery Date

    NOTE
    This component only displays synchronized data.

============================================================ --}}

<section class="w-full py-8">

    <div class="mx-auto max-w-7xl px-5 lg:px-10">

        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- ==================================================
                Header
            =================================================== --}}
            <div
                class="flex flex-col gap-4 border-b border-gray-200 px-6 py-5 md:flex-row md:items-center md:justify-between">

                <div>

                    <h2 class="text-2xl font-semibold text-gray-900">
                        Order Summary
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Overview of the tracked shipment.
                    </p>

                </div>

                {{-- TODO: BACKEND
                     Display dynamic status --}}
                <span
                    class="inline-flex w-fit rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-700">

                    In Transit

                </span>

            </div>

            {{-- ==================================================
                Body
            =================================================== --}}

            <div
                class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 xl:grid-cols-3">

                {{-- Order Number --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Order Number
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        ORD-2026-000123
                    </h3>

                </div>

                {{-- Tracking Number --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Tracking Number
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        JT123456789PH
                    </h3>

                </div>

                {{-- Courier --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Courier
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        J&T Express
                    </h3>

                </div>

                {{-- Order Date --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Order Date
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        July 5, 2026
                    </h3>

                </div>

                {{-- Estimated Delivery --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Estimated Delivery
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-green-600">
                        July 8, 2026
                    </h3>

                </div>

                {{-- Destination --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Destination
                    </p>

                    <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        Quezon City, Metro Manila
                    </h3>

                </div>

            </div>

            {{-- ==================================================
                Footer
            =================================================== --}}

            <div
                class="flex flex-col gap-4 border-t border-gray-200 bg-gray-50 px-6 py-5 md:flex-row md:items-center md:justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Current Shipment Status
                    </p>

                    <p class="mt-1 font-medium text-gray-900">
                        Your package has departed from the sorting facility and is on its way to the destination hub.
                    </p>

                </div>

                {{-- ==================================================
                    FRONTEND ONLY

                    This button will toggle the timeline
                    between minimized and maximized view.

                    TODO:
                    Connect this button to tracking.js
                =================================================== --}}
                <button
                    id="toggleTrackingDetails"
                    type="button"
                    class="rounded-xl bg-red-600 px-6 py-3 text-sm font-medium text-white transition duration-300 hover:bg-red-700 hover:shadow-lg">

                    Show More Details

                </button>

            </div>

        </div>

    </div>

</section>
