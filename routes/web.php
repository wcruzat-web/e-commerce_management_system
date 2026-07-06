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

Route::view('/tracking', 'realtime-order.tracking')
    ->name('tracking');
