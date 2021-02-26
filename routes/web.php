<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\UserOfferController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
});
Route::get('/payment', function () {
    return view('pages.payment.payment');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Start Frontend Controller Sections
Route::get('products/details/{product:slug}', [ProductController::class, 'productDetails'])->name('products.details');
Route::get('products/categories/{category:slug}', [ProductController::class, 'byCategory'])->name('categories.products');
Route::get('products/brands/{brand:slug}', [ProductController::class, 'byBrand'])->name('brands.products');
Route::post('product/size/price', [ProductController::class, 'sizeWisePrice'])->name('product.get.size-wise-price');
Route::get('product/offers/{product}', [OfferController::class, 'getOfferProduct'])->name('products.get.offers');

// Start => product comment controller section
Route::post('product/comments/{product}', [ProductCommentController::class, 'store'])->name('product.comments.store');
Route::get('product/comments/like/unlike', [ProductCommentController::class, 'likeUnlike'])->name('product.comments.like-unlike');
// End => product comment controller section




// Cart Routes
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/{slug}', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/update/{rowId}', [CartController::class, 'updateQty'])->name('cart.update.qty');
Route::get('cart-empty', [CartController::class, 'empty'])->name('cart.empty');
Route::get('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('cartExist');
Route::post('cart/checkout/shipping/store', [CartController::class, 'shippingStore'])->name('cart.shipping.store');

Route::group(['middleware' => ['auth', 'cartExist']], function () {
    Route::get('cart/order', [CartController::class, 'gotToOrderPage'])->name('cart.order.page');

    // Order Routes
    Route::post('cart/order/submit', [OrderController::class, 'orderSubmit'])->name('cart.order.store');
});

Route::group(['middleware' => ['auth']], function () {
    // Order Routes
    Route::get('orders', [OrderController::class, 'orders'])->name('client.orders');
    Route::get('payment/{order}', [OrderController::class, 'paymentPage'])->name('payment.page');
    Route::post('order/cancel/{order}', [OrderController::class, 'orderCancel'])->name('order.cancel');


    // User Dashboard Route
    Route::get('user/profile', [UserProfileController::class, 'edit'])->name('user.profile');
    Route::put('user/profile/update', [UserProfileController::class, 'update'])->name('user.update.profile');
    Route::put('user/profile/update/password', [UserProfileController::class, 'changePassword'])->name('user.update.profile.password');
    Route::get('user/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('user/offers', [UserOfferController::class, 'index'])->name('user.offers.index');
    Route::get('user/decline/offers/{product}', [UserOfferController::class, 'offerDecline'])->name('user.offers-decline');
    Route::delete('user/delete/offers/{offer}', [UserOfferController::class, 'offerDelete'])->name('user.offers.delete');
    Route::Post('product/rating/store', [ProductRatingController::class, 'store'])->name('product.rating.store');
});
Route::post('offers/save-for-later', [UserOfferController::class, 'store'])->name('offers.save-for-later');


// For Admin
require __DIR__ . '/admin.php';

