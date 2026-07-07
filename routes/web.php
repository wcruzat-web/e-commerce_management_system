<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/tracking');



/*
|--------------------------------------------------------------------------
| Real-Time Order Synchronization
|--------------------------------------------------------------------------
*/

Route::view('/tracking', 'pages.customer.order-tracking.tracking')
    ->name('tracking');

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
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard.dashboard')->name('admin.dashboard');
    Route::view('/orders', 'pages.admin.orders.orders')->name('admin.orders');
});
