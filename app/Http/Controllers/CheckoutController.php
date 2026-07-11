<?php

namespace App\Http\Controllers;

use App\DTOs\CheckoutDataDTO;
use App\Models\CustomerAddress;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(
        private CheckoutService $checkoutService,
        private CartService $cartService,
    ) {}

    public function index()
    {
        $customer = Auth::user();
        $cart = $this->cartService->getOrCreateCart($customer->customer_id);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $summary = $this->cartService->getSummary($cart);
        $addresses = $customer->addresses;

        return view('pages.customer.checkout.checkout', compact('cart', 'summary', 'addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'nullable|string|max:20',
            'street' => 'required|string|max:150',
            'barangay' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'address_type' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        $customer = Auth::user();
        $cart = $this->cartService->getOrCreateCart($customer->customer_id);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $shippingAddress = $validated['street'] . ', ' . $validated['barangay'] . ', ' . $validated['city'] . ', ' . $validated['province'] . ' ' . $validated['postal_code'] . ', ' . $validated['country'];

        $dto = new CheckoutDataDTO(
            shippingName: $validated['first_name'] . ' ' . $validated['last_name'],
            shippingEmail: $validated['shipping_email'],
            shippingPhone: $validated['shipping_phone'] ?? '',
            shippingAddress: $shippingAddress,
            notes: $validated['notes'] ?? '',
        );

        $order = $this->checkoutService->createOrder($cart, $dto);

        $existing = $customer->addresses()->where('street', $validated['street'])
            ->where('barangay', $validated['barangay'])
            ->where('city', $validated['city'])
            ->where('province', $validated['province'])
            ->where('postal_code', $validated['postal_code'])
            ->where('country', $validated['country'])
            ->first();

        if (!$existing) {
            $hasExisting = $customer->addresses()->count() > 0;

            CustomerAddress::create([
                'customer_id' => $customer->customer_id,
                'address_type' => $validated['address_type'] ?? 'Home',
                'street' => $validated['street'],
                'barangay' => $validated['barangay'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'is_default' => !$hasExisting,
            ]);
        }

        return redirect()->route('payment')->with('order_id', $order->order_id);
    }

    public function saveAddress(Request $request)
    {
        $validated = $request->validate([
            'address_id' => 'nullable|integer|exists:customer_addresses,address_id',
            'address_type' => 'required|string|max:20',
            'street' => 'required|string|max:150',
            'barangay' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:100',
        ]);

        $customer = Auth::user();

        if ($validated['address_id']) {
            $address = CustomerAddress::where('customer_id', $customer->customer_id)
                ->findOrFail($validated['address_id']);
            $address->update([
                'address_type' => $validated['address_type'],
                'street' => $validated['street'],
                'barangay' => $validated['barangay'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
            ]);
            return response()->json(['address' => $address->fresh()->toArray()]);
        }

        $existing = $customer->addresses()
            ->where('street', $validated['street'])
            ->where('barangay', $validated['barangay'])
            ->where('city', $validated['city'])
            ->where('province', $validated['province'])
            ->where('postal_code', $validated['postal_code'])
            ->where('country', $validated['country'])
            ->first();

        if ($existing) {
            return response()->json([
                'address' => $existing->toArray(),
            ]);
        }

        $hasExisting = $customer->addresses()->count() > 0;

        $address = CustomerAddress::create([
            'customer_id' => $customer->customer_id,
            'address_type' => $validated['address_type'],
            'street' => $validated['street'],
            'barangay' => $validated['barangay'],
            'city' => $validated['city'],
            'province' => $validated['province'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
            'is_default' => !$hasExisting,
        ]);

        return response()->json([
            'address' => $address->toArray(),
        ]);
    }
}
