{{-- ============================================================
    ERP SYSTEM
    E-Commerce Management System

    MODULE
    Real-Time Order Synchronization

    COMPONENT
    Search Card

    DESCRIPTION
    Search an order using an Order Number or
    Tracking Number.

    ============================================================

    TODO: BACKEND

    ERP DATA SOURCE

    Sales Management System

    Retrieves:
    • Order Number
    • Tracking Number

    Controller:
    OrderTrackingController

    Route:
    route('tracking.search')

============================================================ --}}

<section class="w-full">

    <div class="mx-auto max-w-7xl px-5 lg:px-10">

        <div
            class="rounded-2xl
                   border
                   border-gray-200
                   bg-white
                   p-6
                   shadow-sm">

            <div
                class="flex
                       flex-col
                       gap-6
                       lg:flex-row
                       lg:items-center
                       lg:justify-between">

                {{-- ==========================================
                    Search Title
                =========================================== --}}

                <div>

                    <h2
                        class="text-2xl
                               font-semibold
                               text-gray-900">

                        Track Your Order

                    </h2>

                    <p
                        class="mt-1
                               text-sm
                               text-gray-500">

                        Enter your order number or tracking number
                        to view the latest shipment updates.

                    </p>

                </div>

                {{-- ==========================================
                    TODO: BACKEND

                    Replace action="#"

                    with

                    {{ route('tracking.search') }}

                =========================================== --}}

                <form
                    action="#"
                    method="GET"
                    class="flex
                           w-full
                           flex-col
                           gap-3
                           lg:w-auto
                           lg:flex-row">

                    {{-- Search Input --}}
                    <div class="relative">

                        <input
                            type="text"
                            name="tracking"
                            placeholder="Enter Order ID or Tracking Number"
                            class="h-14
                                   w-full
                                   rounded-xl
                                   border
                                   border-gray-300
                                   bg-white
                                   px-5
                                   pr-12
                                   text-sm
                                   text-gray-900
                                   outline-none
                                   transition-all
                                   duration-300
                                   placeholder:text-gray-400
                                   focus:border-red-500
                                   focus:ring-2
                                   focus:ring-red-200
                                   lg:w-[430px]">

                        {{-- Search Icon --}}
                        <div
                            class="pointer-events-none
                                   absolute
                                   right-4
                                   top-1/2
                                   -translate-y-1/2
                                   text-gray-400">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-5 w-5">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5.65 5.65a7.5 7.5 0 0 0 10.6 10.6Z" />

                            </svg>

                        </div>

                    </div>

                    {{-- Track Button --}}
                    <button
                        type="submit"
                        class="flex
                               h-14
                               items-center
                               justify-center
                               rounded-xl
                               bg-red-600
                               px-8
                               text-sm
                               font-medium
                               text-white
                               transition-all
                               duration-300
                               hover:bg-red-700
                               hover:shadow-lg
                               active:scale-95">

                        Track

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>
