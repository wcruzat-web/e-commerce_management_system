{{--
    ==================================================================
    ERP MODULE: Shopping Cart (Cart Page)

    COMPONENT: Cart Items List

    DESCRIPTION:
    Displays all items in the shopping cart with thumbnail,
    brand/category tags, name, SKU, stock status, quantity stepper,
    remove button, and line total.

    ==================================================================

    TODO (Backend Integration):
    - Replace static $cartItems with $cart->items (CartItem model)
    - Wire quantity stepper to PATCH /cart/{item}
    - Wire remove button to DELETE /cart/{item}
    - Replace placeholder thumbnail with product image
    - Sync stock levels from Product model in real time

    ==================================================================
--}}

@php
    // TODO: replace this static array with $cart->items
    $cartItems = [
        [
            'id' => 1,
            'brand' => 'NVIDIA',
            'category' => 'Graphics Cards',
            'name' => 'NVIDIA GeForce RTX 4090 Founders Edition',
            'sku' => 'NV-RTX4090-FE-24G',
            'stock' => 'in_stock',
            'stock_label' => 'In Stock',
            'max_qty' => 10,
            'qty' => 1,
            'price' => 1599,
        ],
        [
            'id' => 2,
            'brand' => 'Intel',
            'category' => 'Processors',
            'name' => 'Intel Core i9-14900K Processor',
            'sku' => 'IN-14900K-BOX',
            'stock' => 'in_stock',
            'stock_label' => 'In Stock',
            'max_qty' => 10,
            'qty' => 1,
            'price' => 549,
        ],
        [
            'id' => 3,
            'brand' => 'Corsair',
            'category' => 'Memory',
            'name' => 'Corsair Vengeance DDR5-6400 32GB Kit',
            'sku' => 'CO-DDR5-6400-32',
            'stock' => 'low_stock',
            'stock_label' => 'Only 3 left',
            'max_qty' => 3,
            'qty' => 1,
            'price' => 567,
        ],
    ];
@endphp

<div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-fit">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <h2 class="text-sm font-semibold text-gray-900">Cart Items</h2>
            <span id="itemCountBadge" class="text-xs font-medium bg-blue-100 text-blue-700 px-2.5 py-0.5 rounded-full">3 items</span>
        </div>
        <a href="#" class="flex items-center gap-1 text-xs font-medium text-cyan-500 hover:text-cyan-600">
            Continue Shopping
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>

    <div id="cartItemsList" class="divide-y divide-gray-100">
        @foreach ($cartItems as $item)
            <div class="cart-item flex items-start gap-4 py-4 {{ $loop->first ? 'pt-0' : '' }}" data-item-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}" data-max-qty="{{ $item['max_qty'] }}">
                {{-- thumbnail placeholder --}}
                <div class="w-20 h-20 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[11px] font-medium bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">{{ $item['brand'] }}</span>
                        <span class="text-[11px] font-medium bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">{{ $item['category'] }}</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-900">{{ $item['name'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">SKU: {{ $item['sku'] }}</p>

                    <div class="mt-2">
                        @if($item['stock'] === 'in_stock')
                            <span class="inline-flex items-center gap-1 text-[11px] font-medium bg-green-50 text-green-600 px-2 py-0.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                {{ $item['stock_label'] }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-medium bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                {{ $item['stock_label'] }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 mt-3">
                        {{-- quantity stepper --}}
                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                            <button type="button" onclick="changeQty({{ $item['id'] }}, -1)" class="w-7 h-7 flex items-center justify-center text-gray-500 hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                            <span class="qty-value w-8 text-center text-sm font-medium text-gray-800">{{ $item['qty'] }}</span>
                            <button type="button" onclick="changeQty({{ $item['id'] }}, 1)" class="w-7 h-7 flex items-center justify-center text-gray-500 hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>

                        <button type="button" onclick="removeItem({{ $item['id'] }})" class="flex items-center gap-1 text-xs font-medium text-gray-400 hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                <path d="M10 11v6"></path>
                                <path d="M14 11v6"></path>
                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                            </svg>
                            Remove
                        </button>
                    </div>
                </div>

                <div class="text-right shrink-0">
                    <p class="line-total text-sm font-bold text-gray-900">${{ number_format($item['price'], 0) }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">${{ number_format($item['price'], 0) }} each</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
