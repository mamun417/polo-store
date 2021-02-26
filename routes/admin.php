<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TaxController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

Route::group(['middleware' => ['auth:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    // dashboard v_2
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*************categories sections*************/
    Route::resource('categories', CategoryController::class);
    Route::get('categories/change-status/{category}', [CategoryController::class, 'changeStatus'])
        ->name('categories.status.change');

    /*************product sections*************/
    Route::resource('products', ProductController::class);
    Route::get('products/change-status/{product}', [ProductController::class, 'changeStatus'])
        ->name('products.status.change');
    Route::get('products/size/remove', [ProductController::class, 'sizeRemove'])->name('products.remove.size');
    Route::get('products/remove/image', [ProductController::class, 'removeProductImage'])->name('products.remove.image');

    /*************brand sections*************/
    Route::resource('brands', BrandController::class);
    Route::get('brands/change-status/{brand}', [BrandController::class, 'changeStatus'])
        ->name('brands.status.change');

    /*************brand sections*************/
    Route::resource('offers', OfferController::class);
    Route::get('offers/change-status/{offer}', [OfferController::class, 'changeStatus'])
        ->name('offers.status.change');

    /*************customers sections*************/
    Route::resource('customers', CustomerController::class);

    /************* Shipping Method *************/
    Route::resource('shipping-methods', ShippingMethodController::class);
    Route::get('shipping-methods/change-status/{shipping_method}', [ShippingMethodController::class, 'changeStatus'])
         ->name('shipping-methods.status.change');

    /************* slider sections *************/
    Route::resource('sliders', SlidersController::class)->except( 'show');
    Route::get('sliders/change-status/{slider}', [SlidersController::class, 'changeStatus'])
        ->name('sliders.status.change');
    /*************social sections*************/
    Route::resource('socials', SocialController::class);
    Route::get('socials/change-status/{social}', [SocialController::class, 'changeStatus'])
        ->name('socials.status.change');

/******************************* Start => setting sections *********************************/

    /*******site setting controller*******/
    Route::resource('settings', SettingController::class);
    Route::get('settings/change-status/{setting}', [SettingController::class, 'changeStatus'])
        ->name('settings.status.change');

    /*******site setting controller*******/
    Route::resource('taxes', TaxController::class);
    Route::get('taxes/change-status/{tax}', [TaxController::class, 'changeStatus'])
        ->name('taxes.status.change');

/******************************* End => setting sections *********************************/



    /*************order sections*************/
    Route::resource('orders', OrderController::class)->only('index', 'show');
    Route::post('orders/change-status/{order}', [OrderController::class, 'ChangeStatus'])->name('orders.change-status');
    Route::post('orders/change-payment-status/{order}', [OrderController::class, 'changePaymentStatus'])->name('orders.change-payment-status');

    /*************Admin Profile Update*************/
    Route::get('/profile', [AdminController::class, 'index'])->name('profile');
    Route::PATCH('/profile/{admin}/update', [AdminController::class, 'update'])->name('profile.update');

    /*************Admin Password Update*************/
    Route::PATCH('/password/change', [AdminController::class, 'changePassword'])->name('password.change');
});





