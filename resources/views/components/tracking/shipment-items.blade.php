{{-- ============================================================
    ERP SYSTEM
    E-Commerce Management System

    MODULE
    Real-Time Order Synchronization

    COMPONENT
    Shipment Items

    DESCRIPTION
    Displays all products included in the tracked
    shipment.

    ============================================================

    TODO: ERP INTEGRATION

    DATA SOURCE

    Sales Management System

    Provides

    • Order Items
    • Product Name
    • Product Image
    • Quantity
    • Unit Price
    • SKU

    Inventory Management System

    Provides

    • Warehouse
    • Stock Allocation

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

            <div class="border-b border-gray-200 px-6 py-5">

                <h2 class="text-2xl font-semibold text-gray-900">

                    Shipment Items

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    Products included in this shipment.

                </p>

            </div>

            {{-- ==================================================
                TODO

                Replace static array with

                @foreach($order->items as $item)

            =================================================== --}}

            @php

                $items = [

                    [
                        'image' => 'https://placehold.co/120x120',
                        'name' => 'AMD Ryzen 7 7800X3D',
                        'sku' => 'CPU-7800X3D',
                        'qty' => 1,
                        'price' => '₱23,999'
                    ],

                    [
                        'image' => 'https://placehold.co/120x120',
                        'name' => 'MSI B650 Gaming Plus WiFi',
                        'sku' => 'MB-B650',
                        'qty' => 1,
                        'price' => '₱12,499'
                    ],

                    [
                        'image' => 'https://placehold.co/120x120',
                        'name' => 'Kingston Fury Beast DDR5 32GB',
                        'sku' => 'RAM-32GB',
                        'qty' => 2,
                        'price' => '₱5,999'
                    ],

                ];

            @endphp

            <div class="divide-y divide-gray-200">

                @foreach($items as $item)

                    <div
                        class="flex flex-col gap-6 p-6 transition duration-300 hover:bg-gray-50 md:flex-row md:items-center">

                        {{-- ======================================
                            Product Image

                            TODO

                            Replace image path.

                        ======================================= --}}

                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['name'] }}"
                            class="h-28 w-28 rounded-xl border border-gray-200 object-cover">

                        {{-- ======================================
                            Product Information
                        ======================================= --}}

                        <div class="flex-1">

                            <h3
                                class="text-lg font-semibold text-gray-900">

                                {{ $item['name'] }}

                            </h3>

                            <p
                                class="mt-2 text-sm text-gray-500">

                                SKU

                                <span class="font-medium text-gray-700">

                                    {{ $item['sku'] }}

                                </span>

                            </p>

                        </div>

                        {{-- ======================================
                            Quantity
                        ======================================= --}}

                        <div
                            class="min-w-[120px]">

                            <p class="text-sm text-gray-500">

                                Quantity

                            </p>

                            <p
                                class="mt-2 text-lg font-semibold text-gray-900">

                                × {{ $item['qty'] }}

                            </p>

                        </div>

                        {{-- ======================================
                            Price
                        ======================================= --}}

                        <div
                            class="min-w-[150px]">

                            <p class="text-sm text-gray-500">

                                Price

                            </p>

                            <p
                                class="mt-2 text-lg font-semibold text-red-600">

                                {{ $item['price'] }}

                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- ==================================================
                Footer

                TODO

                Display dynamic total.

            =================================================== --}}

            <div
                class="flex flex-col gap-3 border-t border-gray-200 bg-gray-50 px-6 py-5 md:flex-row md:items-center md:justify-between">

                <div>

                    <p class="text-sm text-gray-500">

                        Total Products

                    </p>

                    <p class="font-semibold text-gray-900">

                        3 Items

                    </p>

                </div>

                <div class="text-left md:text-right">

                    <p class="text-sm text-gray-500">

                        Total Amount

                    </p>

                    <p class="text-2xl font-bold text-red-600">

                        ₱48,496

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
