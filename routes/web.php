<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dummy/shop');



/*
|--------------------------------------------------------------------------
| Customer Pages (Requires Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
    Route::match(['get', 'post'], '/track', [TrackingController::class, 'track'])->name('orders.track');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/address', [CheckoutController::class, 'saveAddress'])->name('checkout.address.save');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');

    Route::get('/success', [SuccessController::class, 'index'])->name('success');

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

Route::view('/dummy/account', 'pages.dummy.account')->middleware('customer')->name('account');

/*
|--------------------------------------------------------------------------
| Dummy Pages — Preview Only
|--------------------------------------------------------------------------
*/

Route::get('/dummy/addresses', function () {
    $addresses = CustomerAddress::where('customer_id', Auth::id())->get();
    return view('pages.dummy.address-preview', compact('addresses'));
})->middleware(['auth', 'customer'])->name('dummy.addresses');

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:super_admin,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/print', [DashboardController::class, 'print'])->name('admin.dashboard.print');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('admin.orders.payment');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::post('/orders/{order}/tracking', [OrderController::class, 'updateTracking'])->name('admin.orders.tracking');
    Route::view('/products', 'pages.admin.products.index')->name('admin.products');
    Route::view('/inventory', 'pages.admin.inventory.index')->name('admin.inventory');
});

/*
|--------------------------------------------------------------------------
| Admin — User Management (super_admin only)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
});

Route::get('/shop', function () {
    return view('pages.customer.shop.shop');
});
