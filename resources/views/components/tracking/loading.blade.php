{{-- ============================================================
    ERP SYSTEM
    E-Commerce Management System

    MODULE
    Real-Time Order Synchronization

    COMPONENT
    Loading State

    DESCRIPTION
    Displays while waiting for the tracking
    information from the ERP system.

    ============================================================

    TODO: BACKEND

    Trigger this component when:

    • Customer searches an order
    • Synchronization is in progress
    • Waiting for Sales Management System
    • Waiting for Shipping & Logistics Module

    Hide this component once the response
    has been successfully synchronized.

============================================================ --}}

<section
    id="trackingLoading"
    class="hidden w-full py-8">

    <div class="mx-auto max-w-7xl px-5 lg:px-10">

        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- ===============================================
                Loading Header
            ================================================ --}}
            <div class="border-b border-gray-200 px-6 py-5">

                <div
                    class="h-6 w-56 animate-pulse rounded bg-gray-200">
                </div>

                <div
                    class="mt-3 h-4 w-80 animate-pulse rounded bg-gray-100">
                </div>

            </div>

            {{-- ===============================================
                Summary Skeleton
            ================================================ --}}
            <div
                class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 xl:grid-cols-3">

                @for ($i = 0; $i < 6; $i++)

                    <div>

                        <div
                            class="mb-3 h-3 w-24 animate-pulse rounded bg-gray-200">
                        </div>

                        <div
                            class="h-6 w-40 animate-pulse rounded bg-gray-300">
                        </div>

                    </div>

                @endfor

            </div>

            {{-- ===============================================
                Timeline Skeleton
            ================================================ --}}
            <div
                class="border-t border-gray-200 px-6 py-8">

                @for ($i = 0; $i < 4; $i++)

                    <div class="mb-8 flex gap-5">

                        {{-- Circle --}}
                        <div
                            class="mt-1 h-5 w-5 animate-pulse rounded-full bg-red-200">
                        </div>

                        {{-- Details --}}
                        <div class="flex-1">

                            <div
                                class="mb-2 h-5 w-52 animate-pulse rounded bg-gray-300">
                            </div>

                            <div
                                class="mb-2 h-4 w-72 animate-pulse rounded bg-gray-200">
                            </div>

                            <div
                                class="h-3 w-40 animate-pulse rounded bg-gray-100">
                            </div>

                        </div>

                    </div>

                @endfor

            </div>

            {{-- ===============================================
                Loading Footer
            ================================================ --}}
            <div
                class="border-t border-gray-200 bg-gray-50 px-6 py-5">

                <div class="flex items-center gap-4">

                    {{-- Spinner --}}
                    <svg
                        class="h-5 w-5 animate-spin text-red-600"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24">

                        <circle
                            class="opacity-20"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4" />

                        <path
                            class="opacity-100"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />

                    </svg>

                    <div>

                        <p class="font-medium text-gray-800">

                            Synchronizing order information...

                        </p>

                        <p class="text-sm text-gray-500">

                            Please wait while we retrieve the latest tracking updates.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
