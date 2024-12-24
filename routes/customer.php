<?php

use App\Http\Controllers\Customer\Auth\AuthenticationController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\Page\DashboardController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('customer')->prefix('customer')->name('customer.')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/addToCart', 'addToCart')->name('add.to.cart');
    });


    Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('logout');
});

Route::middleware('guest:customer')->prefix('customer')->name('customer.')->group(function() {
    Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login.store');

    Route::controller(RegisterController::class)->prefix('register')->name('register.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
    });
});
