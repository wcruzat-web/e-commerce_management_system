<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;

class CartService
{
    public function getOrCreateCart(int $customerId): Cart
    {
        $cart = Cart::firstOrCreate(
            ['customer_id' => $customerId]
        );

        return $cart->load('items.product');
    }

    public function addItem(Cart $cart, int $productId, int $quantity): CartItem
    {
        $product = Product::findOrFail($productId);

        $unitPrice = $product->sale_price ?? $product->price;

        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->subtotal = $item->quantity * $item->unit_price;
            $item->save();
            return $item;
        }

        return $cart->items()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $quantity * $unitPrice,
        ]);
    }

    public function updateQuantity(CartItem $item, int $quantity): CartItem
    {
        $item->quantity = max(1, $quantity);
        $item->subtotal = $item->quantity * $item->unit_price;
        $item->save();

        return $item;
    }

    public function removeItem(CartItem $item): void
    {
        $item->delete();
    }

    public function getSummary(Cart $cart): array
    {
        $items = $cart->items;
        $subtotal = $items->sum('subtotal');
        $tax = round($subtotal * 0.08, 2);
        $grandTotal = round($subtotal + $tax, 2);

        return [
            'items_count' => $items->sum('quantity'),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'grand_total' => $grandTotal,
        ];
    }

    public function getGuestCustomer(): Customer
    {
        $customerId = session('guest_customer_id');

        if ($customerId) {
            $customer = Customer::find($customerId);
            if ($customer) {
                return $customer;
            }
        }

        $customer = Customer::create([
            'name' => 'Guest',
            'email' => 'guest_' . uniqid() . '@example.com',
        ]);

        session(['guest_customer_id' => $customer->customer_id]);

        return $customer;
    }
}
