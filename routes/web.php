<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tracking');



/*
|--------------------------------------------------------------------------
| Real-Time Order Synchronization
|--------------------------------------------------------------------------
*/

Route::view('/tracking', 'pages.customer.order-tracking.tracking')
    ->name('tracking');

Route::view('/track', 'pages.customer.order-tracking.tracking')
    ->name('orders.track');

/*
|--------------------------------------------------------------------------
| Shopping Cart
|--------------------------------------------------------------------------
| ToDo: Add voucher/coupon route (POST /cart/voucher) when coupon system is built
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
/* {{-- ToDo: POST /cart/voucher for coupon code when coupon system is built --}} */

/*
|--------------------------------------------------------------------------
| Checkout — Payment
|--------------------------------------------------------------------------
*/

Route::view('/payment', 'pages.customer.payment.payment')
    ->name('payment');

/*
|--------------------------------------------------------------------------
| Checkout — Shipping Details
|--------------------------------------------------------------------------
*/

Route::view('/checkout', 'pages.customer.checkout.checkout')
    ->name('checkout');

/*
|--------------------------------------------------------------------------
| Checkout — Order Confirmation
|--------------------------------------------------------------------------
*/

Route::view('/success', 'pages.customer.success.success')
    ->name('success');

/*
|--------------------------------------------------------------------------
| Customer — Shop & Account
|--------------------------------------------------------------------------
*/

Route::get('/shop', function () {
    $categories = App\Models\Category::with('products')->get();
    $products = App\Models\Product::with('category')->where('is_active', true)->get();
    return view('pages.customer.shop.index', compact('categories', 'products'));
})->name('products.index');

Route::get('/shop/{product:slug}', function (App\Models\Product $product) {
    $product->load('category', 'images', 'specifications');
    return view('pages.customer.shop.show', compact('product'));
})->name('products.show');

Route::view('/account', 'pages.customer.account.index')->name('account');

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard.dashboard')->name('admin.dashboard');
    Route::view('/orders', 'pages.admin.orders.orders')->name('admin.orders');
    Route::view('/products', 'pages.admin.products.index')->name('admin.products');
    Route::view('/inventory', 'pages.admin.inventory.index')->name('admin.inventory');
});
