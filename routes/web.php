<?php

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
*/

Route::view('/cart', 'pages.customer.cart.cart')
    ->name('cart');

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

Route::view('/shop', 'pages.customer.shop.index')->name('products.index');

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
