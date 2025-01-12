<?php

use App\Http\Controllers\Frontend\Auth\AuthenticationController;
use App\Http\Controllers\Frontend\Auth\PasswordResetController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ValidationController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\profile\DashboardController;
use App\Http\Controllers\Frontend\profile\ProductController as ProfileProductController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Models\otp;
use Illuminate\Support\Facades\Route;

Route::get('/session', function () {
    return session()->all();
});
Route::get('/session/clear', function () {
    session()->forget('cart');
    return back();
});
Route::get('/otp', function () {
    return otp::get();
});

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name('home');
});

Route::controller(ServiceController::class)->group(function() {
    Route::get('/labors', 'labor')->name('labor');
});
Route::controller(ServiceController::class)->group(function() {
    Route::get('/labors/booking', 'laborCreate')->name('labor.create');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/specialist', 'specialist')->name('specialist');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/event', 'event')->name('event');
});




Route::middleware(['web', 'uv'])->group(function() {
    Route::post('logout', [AuthenticationController::class, 'destroy'])->name('logout');

    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Product route
        Route::controller(ProfileProductController::class)->prefix('product')->name('product.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/status', 'status')->name('status');
            Route::post('/update', 'update')->name('update');
            Route::get('/image/trash/{id}', 'imageTrash')->name('image.trash');
            Route::get('/trash/{id}', 'trash')->name('trash');
        });
    });
});

Route::middleware(['web', 'unv'])->group(function() {
    Route::controller(ValidationController::class)->group(function () {
        Route::get('verify-otp', 'index')->name('verify');
        Route::post('verify-otp/store', 'store')->name('verify.otp.store');
        Route::get('validation/{toke}', 'validation')->name('validation');
        Route::post('validation/check', 'check')->name('validation.check');
        Route::get('password-reset/{token}', 'passwordForm')->name('new.password');
        Route::post('new-password', 'changePassword')->name('new.password.store');
    });
});

Route::middleware('guest:web')->group(function() {
    Route::controller(RegisterController::class)->prefix('register')->group(function () {
        Route::get('/', 'index')->name('register');
        Route::post('/store', 'store')->name('register.store');
    });

    Route::controller(AuthenticationController::class)->prefix('login')->group(function() {
        Route::get('/', 'create')->name('login');
        Route::post('/store', 'store')->name('login.store');
    });

    Route::controller(PasswordResetController::class)->group(function () {
        Route::get('password-reset', 'index')->name('password.reset');
        Route::post('password-reset/store', 'store')->name('password.reset.store');
        Route::get('password-verify/{token}', 'verify')->name('password.verify.code');
        Route::post('password-verification', 'verification')->name('password.account.verification');
        Route::get('password-reset/{token}', 'passwordForm')->name('new.password');
        Route::post('new-password', 'changePassword')->name('new.password.store');
    });

});



Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{slug}', 'products')->name('products');
    Route::get('{slug}/{code}', 'product')->name('product');
});


