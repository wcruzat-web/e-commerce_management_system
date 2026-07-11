<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dummy/shop');



/*
|--------------------------------------------------------------------------
| Customer Pages (Requires Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view('/tracking', 'pages.customer.order-tracking.tracking')
        ->name('tracking');

    Route::view('/track', 'pages.customer.order-tracking.tracking')
        ->name('orders.track');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/address', [CheckoutController::class, 'saveAddress'])->name('checkout.address.save');

    Route::view('/payment', 'pages.customer.payment.payment')
        ->name('payment');

    Route::view('/success', 'pages.customer.success.success')
        ->name('success');

});

/*
|--------------------------------------------------------------------------
| Customer — Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/forgot-password', 'pages.customer.auth.forgot-password')->name('forgot.password');
Route::post('/forgot-password', function () {
    return back()->with('status', 'Password reset is not yet implemented.');
});

/*
|--------------------------------------------------------------------------
| Dummy Pages — Shop & Account (Placeholder)
|--------------------------------------------------------------------------
*/

Route::get('/dummy/shop', function () {
    $categories = App\Models\Category::with('products')->get();
    $products = App\Models\Product::with('category')->where('is_active', true)->get();
    return view('pages.dummy.shop.index', compact('categories', 'products'));
})->name('products.index');

Route::get('/dummy/shop/{product:slug}', function (App\Models\Product $product) {
    $product->load('category', 'images', 'specifications');
    return view('pages.dummy.shop.show', compact('product'));
})->name('products.show');

Route::view('/dummy/account', 'pages.dummy.account')->name('account');

/*
|--------------------------------------------------------------------------
| Dummy Pages — Preview Only
|--------------------------------------------------------------------------
*/

Route::get('/dummy/addresses', function () {
    $addresses = CustomerAddress::where('customer_id', Auth::id())->get();
    return view('pages.dummy.address-preview', compact('addresses'));
})->middleware('auth')->name('dummy.addresses');

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
