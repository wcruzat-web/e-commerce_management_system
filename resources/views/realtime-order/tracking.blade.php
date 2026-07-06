{{--
    ==================================================================
    ERP MODULE: Real-Time Order Synchronization (Tracking Page)
    ------------------------------------------------------------------
    FRONTEND-ONLY IMPLEMENTATION — NO BACKEND LOGIC INCLUDED.
    This view assumes the site header / top navigation (promo bar,
    "All Hardware / Processors / GPUs / Motherboards / Deals" nav,
    search / cart / account icons) already lives inside
    resources/views/layouts/app.blade.php and is rendered above
    @yield('content'). Only the Tracking Page body is implemented here.

    <!-- TODO (Tracking Page) -->
    <!-- Controller: OrderController -->
    <!-- Method: trackOrder() / search() -->
    <!-- Route: POST /orders/track -->
    <!-- Input: order_id or tracking_number -->
    <!-- Replace with: $order->status -->
    <!-- Future: integrate real-time status updates (Echo / Pusher / Polling) -->
    <!-- Future: connect order timeline from OrderStatus model -->
    ==================================================================
--}}
@extends('layouts.app')

@section('content')

{{-- Outfit font (per Figma) — move to layout <head> once integrated --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="min-h-screen bg-[#f5f5f5] py-8 px-4 sm:px-6 lg:px-8" style="font-family: 'Outfit', sans-serif;">
    <div class="max-w-5xl mx-auto space-y-5">

        {{-- ============================================================
             PAGE TITLE
             TODO (Tracking Page): "[business name]" is a placeholder —
             replace with config('app.name') or tenant/store name.
        ============================================================= --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Order Tracking</h1>
            <p class="text-sm text-gray-500 mt-1">Real-time updates on your [business name] PC order.</p>
        </div>

        {{-- ============================================================
             TRACK ANOTHER ORDER
             <!-- Controller: OrderController -->
             <!-- Method: search() -->
             <!-- Route: POST /orders/track -->
             <!-- Input: order_id or tracking_number -->
        ============================================================= --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-800 mb-3">Track Another Order</h2>

            {{-- Frontend-only form: no action/method wired to a real endpoint --}}
            <form onsubmit="event.preventDefault(); trackAnotherOrder();" class="flex items-center gap-3">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="7"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input
                        type="text"
                        id="trackInput"
                        placeholder="Order ID or Tracking Number"
                        class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                    >
                </div>
                <button
                    type="submit"
                    class="shrink-0 bg-cyan-500 hover:bg-cyan-600 transition-colors text-white text-sm font-semibold px-7 py-3 rounded-xl"
                >
                    Track
                </button>
            </form>
        </div>

        {{-- ============================================================
             ORDER ID / CURRENT STATUS BANNER
             <!-- Replace with: $order->order_number -->
             <!-- Replace with: $order->status (In Transit / Processing / Delivered ...) -->
        ============================================================= --}}
        <div class="bg-blue-900 rounded-2xl px-6 py-5 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs text-blue-200/80 mb-1">Order ID</p>
                <div class="flex items-center gap-2">
                    <span id="orderIdText" class="text-white text-xl font-bold tracking-wide">NX-2026-48291</span>
                    <button type="button" onclick="copyOrderId()" title="Copy Order ID" class="text-blue-200 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="11" height="11" rx="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs text-blue-200/80 mb-1">Current Status</p>
                <span class="inline-block bg-cyan-500 text-white text-sm font-semibold px-4 py-1.5 rounded-full">
                    In Transit
                </span>
            </div>
        </div>

        {{-- ============================================================
             SHIPMENT META ROW
             <!-- Replace with: $order->carrier / $order->tracking_number -->
             <!-- Replace with: $order->shipped_from / $order->est_delivery -->
        ============================================================= --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <p class="text-xs text-gray-400 mb-1">Carrier</p>
                    <p class="text-sm font-semibold text-gray-900">J&amp;T Express</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1">Tracking #</p>
                    <p class="text-sm font-semibold text-cyan-500">NX48291726</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1">Shipped From</p>
                    <p class="text-sm font-semibold text-gray-900">Bulacan, Philippines</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1">Est. Delivery</p>
                    <p class="text-sm font-semibold text-gray-900">July 2, 2026</p>
                </div>
            </div>
        </div>

        {{-- ============================================================
             SHIPMENT TIMELINE
             <!-- Replace with: $order->timeline (collection of OrderStatus records) -->
             <!-- Future: connect order timeline from OrderStatus model -->
             <!-- Future: integrate real-time status updates -->
        ============================================================= --}}
        @php
            // TODO (Tracking Page): replace this static array with data
            // returned from OrderController@trackOrder(), typically:
            // $steps = $order->statusHistory()->orderBy('sequence')->get();
            $timelineSteps = [
                [
                    'title' => 'Order Placed',
                    'description' => 'Your order has been received and confirmed.',
                    'meta' => 'Business Name - Online',
                    'date' => 'June 28, 2026',
                    'time' => '10:40 AM',
                    'state' => 'done',
                ],
                [
                    'title' => 'Processing',
                    'description' => 'Our warehouse team is packaging your items.',
                    'meta' => "Business Name's Warehouse - Bulacan, Philippines",
                    'date' => 'June 29, 2026',
                    'time' => '1:00 AM',
                    'state' => 'done',
                ],
                [
                    'title' => 'Shipped',
                    'description' => 'Package handed off to J&T Express.',
                    'meta' => 'Business Name - Bulacan, Philippines',
                    'date' => 'June 30, 2026',
                    'time' => '8:45 AM',
                    'state' => 'done',
                ],
                [
                    'title' => 'In Transit',
                    'description' => 'Your package is on the way. Passing through Hub.',
                    'meta' => 'J&T Express Hub - Bulacan, Philippines',
                    'date' => 'June 30, 2026',
                    'time' => '10:00 PM',
                    'state' => 'current',
                ],
                [
                    'title' => 'Out for Delivery',
                    'description' => 'Package loaded onto delivery vehicle.',
                    'meta' => 'J&T Express Cavite - Cavite, Philippines',
                    'date' => 'July 01, 2026',
                    'time' => 'Est. 7:00 AM',
                    'state' => 'pending',
                ],
                [
                    'title' => 'Delivered',
                    'description' => 'Package delivered to your door.',
                    'meta' => '(customer address) - Cavite, Philippines',
                    'date' => 'July 02, 2026',
                    'time' => 'Est. 1:00 PM',
                    'state' => 'pending',
                ],
            ];
        @endphp

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-semibold text-gray-900">Shipment Timeline</h2>
                <button type="button" onclick="toggleTimelineDetails()" class="flex items-center gap-1 text-xs font-medium text-cyan-500 hover:text-cyan-600">
                    <span id="timelineToggleLabel">Show more details</span>
                    <svg id="timelineToggleIcon" xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>

            {{-- ---------- COLLAPSED / MINIMIZED VIEW (horizontal) ---------- --}}
            <div id="timelineCollapsed">
                <div class="flex items-start justify-between">
                    @foreach ($timelineSteps as $index => $step)
                        <div class="flex flex-col items-center flex-1 relative">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center z-10
                                @if($step['state'] === 'done') bg-green-500 text-white
                                @elseif($step['state'] === 'current') bg-cyan-500 text-white
                                @else bg-gray-300 text-white
                                @endif">
                                @if($step['state'] === 'done')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                @elseif($step['state'] === 'current')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                @endif
                            </div>
                            <p class="text-xs mt-2 text-center leading-tight max-w-[80px]
                                @if($step['state'] === 'pending') text-gray-400 @else text-gray-700 font-medium @endif">
                                {{ $step['title'] }}
                            </p>

                            {{-- connector line to next step --}}
                            @if(!$loop->last)
                                <div class="absolute top-4 left-1/2 w-full h-0.5 -z-0
                                    @if($step['state'] === 'done') bg-green-500 @else bg-gray-200 @endif">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ---------- EXPANDED / MAXIMIZED VIEW (vertical, with details) ---------- --}}
            <div id="timelineExpanded" class="hidden">
                <div class="space-y-0">
                    @foreach ($timelineSteps as $step)
                        <div class="flex gap-4 {{ !$loop->last ? 'pb-6' : '' }}">
                            {{-- icon + connecting line --}}
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0
                                    @if($step['state'] === 'done') bg-green-500 text-white
                                    @elseif($step['state'] === 'current') bg-cyan-500 text-white
                                    @else bg-gray-300 text-white
                                    @endif">
                                    @if($step['state'] === 'done')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @elseif($step['state'] === 'current')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                    @endif
                                </div>
                                @if(!$loop->last)
                                    <div class="w-0.5 flex-1 mt-1 {{ $step['state'] === 'done' ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                @endif
                            </div>

                            {{-- text content --}}
                            <div class="flex-1 {{ !$loop->last ? 'pb-1' : '' }}">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="text-sm font-semibold
                                        @if($step['state'] === 'pending') text-gray-400
                                        @elseif($step['state'] === 'current') text-cyan-500
                                        @else text-gray-900
                                        @endif">
                                        {{ $step['title'] }}
                                    </p>
                                    <span class="text-xs text-gray-400 whitespace-nowrap">{{ $step['date'] }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $step['description'] }}</p>
                                <div class="flex items-start justify-between gap-2 mt-0.5">
                                    <p class="text-xs text-gray-400">{{ $step['meta'] }}</p>
                                    <span class="text-xs text-gray-400 whitespace-nowrap">{{ $step['time'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ============================================================
             ITEMS IN THIS SHIPMENT
             <!-- Replace with: $order->items (OrderItem model) -->
        ============================================================= --}}
        @php
            // TODO (Tracking Page): replace with $order->items relationship
            $shipmentItems = [
                ['name' => 'NVIDIA RTX 4050 FE', 'qty' => 1, 'price' => '₱45,999', 'type' => 'gpu'],
                ['name' => 'Intel Core i9 14-900K', 'qty' => 1, 'price' => '₱32,940', 'type' => 'cpu'],
            ];
        @endphp

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-900 mb-4">Items in this Shipment</h2>
            <div class="space-y-3">
                @foreach ($shipmentItems as $item)
                    <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500 shrink-0">
                                @if($item['type'] === 'gpu')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="10" rx="2"></rect>
                                        <circle cx="8" cy="12" r="2"></circle>
                                        <circle cx="14" cy="12" r="2"></circle>
                                        <line x1="19" y1="10" x2="19" y2="14"></line>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="6" y="6" width="12" height="12" rx="1"></rect>
                                        <rect x="10" y="10" width="4" height="4"></rect>
                                        <line x1="6" y1="2" x2="6" y2="5"></line>
                                        <line x1="10" y1="2" x2="10" y2="5"></line>
                                        <line x1="14" y1="2" x2="14" y2="5"></line>
                                        <line x1="18" y1="2" x2="18" y2="5"></line>
                                        <line x1="6" y1="19" x2="6" y2="22"></line>
                                        <line x1="10" y1="19" x2="10" y2="22"></line>
                                        <line x1="14" y1="19" x2="14" y2="22"></line>
                                        <line x1="18" y1="19" x2="18" y2="22"></line>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-400">Qty: {{ $item['qty'] }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-900">{{ $item['price'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ============================================================
             SUPPORT SHORTCUTS
             <!-- Future: link to real support routes / live chat widget -->
        ============================================================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="#" class="flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-5 py-4 hover:border-cyan-300 transition-colors">
                <div class="w-9 h-9 rounded-full bg-blue-900 flex items-center justify-center text-white shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">Call Support</p>
                    <p class="text-xs text-gray-400">(02) 8123-4567 - Mon-Fri, 9AM-6PM</p>
                </div>
            </a>
            <a href="#" class="flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-5 py-4 hover:border-cyan-300 transition-colors">
                <div class="w-9 h-9 rounded-full bg-cyan-500 flex items-center justify-center text-white shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">Email Support</p>
                    <p class="text-xs text-gray-400">support@business-name.com</p>
                </div>
            </a>
        </div>

    </div>

    {{-- ============================================================
         FLOATING SUPPORT / CHAT BUTTON
         <!-- Future: hook into live-chat widget or support modal -->
    ============================================================= --}}
    <button
        type="button"
        onclick="toggleChatWidget()"
        class="fixed bottom-6 right-6 w-12 h-12 rounded-full bg-blue-700 hover:bg-blue-800 text-white shadow-lg flex items-center justify-center transition-colors"
        aria-label="Open support chat"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
        </svg>
    </button>
</div>

{{-- ============================================================
     FRONTEND-ONLY BEHAVIOR (no API calls)
============================================================= --}}
<script>
    // Toggle between the minimized (horizontal) and maximized (vertical) timeline views
    function toggleTimelineDetails() {
        const collapsed = document.getElementById('timelineCollapsed');
        const expanded = document.getElementById('timelineExpanded');
        const label = document.getElementById('timelineToggleLabel');
        const icon = document.getElementById('timelineToggleIcon');

        const isExpanded = !expanded.classList.contains('hidden');

        if (isExpanded) {
            expanded.classList.add('hidden');
            collapsed.classList.remove('hidden');
            label.textContent = 'Show more details';
            icon.classList.remove('rotate-180');
        } else {
            collapsed.classList.add('hidden');
            expanded.classList.remove('hidden');
            label.textContent = 'Show less details';
            icon.classList.add('rotate-180');
        }
    }

    // Copy the Order ID to clipboard (frontend-only convenience action)
    function copyOrderId() {
        const orderId = document.getElementById('orderIdText').textContent.trim();
        if (navigator.clipboard) {
            navigator.clipboard.writeText(orderId);
        }
    }

    // Placeholder for the "Track" form — wire this to POST /orders/track later
    function trackAnotherOrder() {
        const value = document.getElementById('trackInput').value.trim();
        if (!value) return;
        // TODO (Tracking Page): submit `value` to OrderController@trackOrder()
        console.log('Tracking lookup requested for:', value);
    }

    // Placeholder for the floating support/chat button
    function toggleChatWidget() {
        // TODO: open live-chat widget or support modal
        console.log('Support chat toggled');
    }
</script>

@endsection
