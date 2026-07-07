{{--
    ==================================================================
    ERP MODULE: Checkout — Shipping & Contact Details (Checkout Page)

    COMPONENT: Checkout Details Form

    DESCRIPTION:
    Contact information (name, email, phone), shipping address
    (street, city, state, ZIP), and shipping method selection
    with radio cards.

    ==================================================================

    TODO (Backend Integration):
    - Wire form to POST /checkout
    - Validate all fields server-side
    - Replace $shippingOptions with data from ShippingMethod model / rate API
    - Prefill fields from authenticated $user->profile
    - Validate address via a shipping-rate API before showing rates

    ==================================================================
--}}

<div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-fit">
    <div class="flex items-center gap-2 mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <h2 class="text-sm font-semibold text-gray-900">Checkout Details</h2>
    </div>

    <form id="checkoutForm" onsubmit="event.preventDefault(); continueToPayment();" class="space-y-4">

        {{-- Name --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">First Name</label>
                <input type="text" id="firstName" placeholder="Alex"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Last Name</label>
                <input type="text" id="lastName" placeholder="Morgan"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
        </div>

        {{-- Contact --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                <input type="email" id="email" placeholder="alex@gmail.com"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Phone</label>
                <input type="tel" id="phone" placeholder="+1 (555) 000-0000"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
        </div>

        {{-- Address --}}
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1.5">Street Address</label>
            <input type="text" id="streetAddress" placeholder="123 Tech Boulevard, Suite 400"
                class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">City</label>
                <input type="text" id="city" placeholder="San Francisco"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">State</label>
                <input type="text" id="state" placeholder="CA"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">ZIP Code</label>
                <input type="text" id="zipCode" placeholder="94105"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 bg-gray-100 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
            </div>
        </div>

        {{-- Shipping Method --}}
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-2">Shipping Method</label>

            @php
                $shippingOptions = [
                    [
                        'id' => 'standard',
                        'title' => 'Standard Shipping',
                        'subtitle' => '5-7 Business days',
                        'price' => 0,
                        'priceLabel' => 'FREE',
                        'icon' => 'truck',
                        'selected' => true,
                    ],
                    [
                        'id' => 'express',
                        'title' => 'Express Shipping',
                        'subtitle' => '2-3 Business days',
                        'price' => 29,
                        'priceLabel' => '$29',
                        'icon' => 'truck',
                        'selected' => false,
                    ],
                    [
                        'id' => 'overnight',
                        'title' => 'Overnight Shipping',
                        'subtitle' => 'Next Business day',
                        'price' => 79,
                        'priceLabel' => '$79',
                        'icon' => 'bolt',
                        'selected' => false,
                    ],
                ];
            @endphp

            <div class="space-y-3">
                @foreach ($shippingOptions as $option)
                    <label
                        for="shipping_{{ $option['id'] }}"
                        data-shipping-price="{{ $option['price'] }}"
                        class="shipping-option flex items-center justify-between gap-4 border rounded-xl px-4 py-3 cursor-pointer transition-colors
                            {{ $option['selected'] ? 'border-cyan-500 bg-cyan-50/40' : 'border-gray-200' }}"
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="shippingMethod"
                                id="shipping_{{ $option['id'] }}"
                                value="{{ $option['id'] }}"
                                onchange="selectShippingOption(this)"
                                {{ $option['selected'] ? 'checked' : '' }}
                                class="w-4 h-4 text-cyan-500 focus:ring-cyan-400"
                            >
                            <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 shrink-0">
                                @if($option['icon'] === 'truck')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="1" y="3" width="15" height="13"></rect>
                                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                    </svg>
                                @endif
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">{{ $option['title'] }}</span>
                                <span class="block text-xs text-gray-400">{{ $option['subtitle'] }}</span>
                            </span>
                        </div>
                        <span class="text-sm font-semibold {{ $option['price'] === 0 ? 'text-green-600' : 'text-gray-900' }}">
                            {{ $option['priceLabel'] }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 bg-cyan-500 hover:bg-cyan-600 transition-colors text-white text-sm font-semibold py-3 rounded-xl"
        >
            Continue to Payment
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </form>
</div>
