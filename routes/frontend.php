<?php

use App\Http\Controllers\Frontend\Auth\AuthenticationController;
use App\Http\Controllers\Frontend\Auth\PasswordResetController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ValidationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\profile\DashboardController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name('home');
});


Route::middleware(['web', 'uv'])->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::post('logout', [AuthenticationController::class, 'destroy'])->name('logout');
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
