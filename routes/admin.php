<?php

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\Auth\PasswordResetController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LaborController;
use App\Http\Controllers\Admin\OrderManageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Permission\RoleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ShippingCostController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('logout');

    Route::controller(CommonController::class)->prefix('common')->group(function() {
        Route::post('/summernote/image/upload', 'summernoteImageUpload')->name('summernote.image.upload');
        Route::post('/summernote/image/delete', 'summernoteImageDelete')->name('summernote.image.delete');
    });

    Route::controller(RegisterController::class)->prefix('setting/admin')->name('setting.')->group(function() {
        Route::get('/', 'create')->name('admin');
        Route::post('/store', 'store')->name('admin.store');
        Route::post('/update', 'update')->name('admin.update');
        Route::get('/trash/{id}', 'trash')->name('admin.trash');
    });

    Route::controller(RoleController::class)->prefix('setting/role')->name('setting.')->group(function() {
        Route::get('/', 'index')->name('role');
        Route::post('/store', 'store')->name('role.store');
        Route::post('/update', 'update')->name('role.update');
        Route::get('/trash/{id}', 'trash')->name('role.trash');
    });
    Route::controller(PermissionController::class)->prefix('setting/permissions')->name('setting.')->group(function() {
        Route::get('/', 'index')->name('permission');
        Route::post('/store', 'store')->name('permission.store');
        Route::post('/update', 'update')->name('permission.update');
        Route::get('/trash/{id}', 'trash')->name('permission.trash');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function() {
        Route::get('/', 'index')->name('create');
        Route::post('/update', 'update')->name('update');
        Route::post('/password/update', 'change')->name('password.update');
    });

    Route::controller(CategoryController::class)->prefix('categories')->name('category.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });
    Route::controller(CategoryController::class)->prefix('setting')->name('setting.')->group(function () {
        Route::get('/navigation/create', 'create')->name('navigation.create');
        Route::post('/navigation/update', 'navigationUpdate')->name('navigation.update');
    });
    Route::controller(CategoryController::class)->prefix('setting')->name('setting.')->group(function () {
        Route::get('/index/create', 'indexCreate')->name('index.create');
        Route::post('/index/update', 'indexUpdate')->name('index.update');
    });

    Route::controller(ShippingCostController::class)->prefix('shipping')->name('setting.')->group(function () {
        Route::get('/', 'index')->name('shipping.index');
        Route::post('/store', 'store')->name('shipping.store');
        Route::post('/update', 'update')->name('shipping.update');
        Route::get('/trash/{id}', 'trash')->name('shipping.trash');
    });

    Route::controller(ContactController::class)->prefix('contacts')->name('contact.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });
    Route::controller(BranchController::class)->prefix('contacts/branch')->name('contact.branch.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });
    Route::controller(SubCategoryController::class)->prefix('categories/sub')->name('category.sub.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(PageController::class)->prefix('pages')->name('page.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });


    Route::controller(SliderController::class)->prefix('slider')->name('slider.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(ProductController::class)->prefix('products')->name('product.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(ServiceController::class)->prefix('services')->name('services.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(LaborController::class)->prefix('labors')->name('services.labors.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(SpecialistController::class)->prefix('specialist')->name('services.specialist.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(EventController::class)->prefix('events')->name('services.events.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/status', 'status')->name('status');
        Route::post('/update', 'update')->name('update');
        Route::get('/trash/{id}', 'trash')->name('trash');
    });

    Route::controller(OrderManageController::class)->prefix('orders')->name('orders.')->group(function() {
        Route::get('/pending', 'pending')->name('pending');
    });




});


/**
 * Guest route
 */
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function() {
    Route::controller(AuthenticationController::class)->group(function() {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store')->name('login.store');
    });

    Route::controller(PasswordResetController::class)->group(function() {
        Route::get('password-reset', 'create')->name('password.reset');
        Route::post('password-reset/store', 'store')->name('password.reset.store');
        Route::get('password-reset/{token}', 'passwordForm')->name('new.password');
        Route::post('new-password', 'changePassword')->name('new.password.store');
    });

});
