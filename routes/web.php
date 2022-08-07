<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;

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

//Frontend section

//autentification
Route::get('user/auth', [IndexController::class, 'userAuth'])->name('user.auth');
Route::post('user/login', [IndexController::class, 'loginSubmit'])->name('login.submit');
Route::post('user/register', [IndexController::class, 'registerSubmit'])->name('register.submit');

Route::get('user/logout', [IndexController::class, 'userLogout'])->name('user.logout');

Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/terms-of-use', [IndexController::class, 'termsOfUse'])->name('termsOfUse');
Route::get('/privacy-policy', [IndexController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/frequently-asked-questions', [IndexController::class, 'frequentlyAskedQuestions'])->name('faq');

// Product category
Route::get('product-category/{slug}/', [IndexController::class, 'productCategory'])->name('product.category');

// Product detail
Route::get('product-detail/{slug}/', [IndexController::class, 'productDetail'])->name('product.detail');

//Summer Sale
Route::get('shop/summer-sale', [IndexController::class, 'summerSale'])->name('shop.summer-sale');

//New games
Route::get('shop/new', [IndexController::class, 'summerNew'])->name('shop.new');


//Product review
Route::post('product-review/{slug}', [ProductReviewController::class, 'productReview'])->name('product.review');

//cart section
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('cart/store', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');

// coupon section
Route::post('coupon/add', [CartController::class, 'couponAdd'])->name('coupon.add');

// Wishlist section

Route::get('whishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('whishlist/store', [WishlistController::class, 'wishlistStore'])->name('wishlist.store');
Route::post('whishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move.cart');
Route::post('whishlist/delete', [WishlistController::class, 'wishlistDelete'])->name('wishlist.delete');

// Checkout Section
Route::get('checkout1', [CheckoutController::class, 'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-first', [CheckoutController::class, 'checkout1Store'])->name('checkout1.store');
Route::post('checkout-two', [CheckoutController::class, 'checkout2Store'])->name('checkout2.store');
Route::get('checkout-store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
Route::get('complete/{order}', [CheckoutController::class, 'complete'])->name('complete');


//Shop section
Route::get('shop', [IndexController::class, 'shop'])->name('shop');
Route::post('shop-filter', [IndexController::class, 'shopFilter'])->name('shop.filter');

//search product
// Route::get('autosearch', [IndexController::class, 'autoSearch'])->name('autosearch');
Route::get('search', [IndexController::class, 'search'])->name('search');

//End frontend section


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);



// Admin dashboard
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'admin'], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // Baner section
    Route::resource('banner', BannerController::class);
    Route::post('banner_status', [BannerController::class, 'bannerStatus'])->name('banner.status');

    // Category section
    Route::resource('category', CategoryController::class);
    Route::post('category_status', [CategoryController::class, 'categoryStatus'])->name('category.status');

    Route::post('category/{id}/child', [CategoryController::class, 'getChildByParentID']);

    // Brand section
    Route::resource('brand', BrandController::class);
    Route::post('brand_status', [BrandController::class, 'brandStatus'])->name('brand.status');

    // Product section
    Route::resource('product', ProductController::class);
    Route::post('product_status', [ProductController::class, 'productStatus'])->name('product.status');

    // User section
    Route::resource('user', UserController::class);
    Route::post('user_status', [UserController::class, 'userStatus'])->name('user.status');
    // Coupon section
    Route::resource('coupon', CouponController::class);
    Route::post('coupon_status', [CouponController::class, 'couponStatus'])->name('coupon.status');

    Route::resource('order', OrderController::class);
    Route::post('order-status', [OrderController::class, 'orderStatus'])->name('order.status');

});

Route::group(['prefix' => 'seller', 'middleware' => 'auth', 'seller'], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('seller');
});

// User Dashboard
Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', [IndexController::class, 'userDashboard'])->name('user.dashbaord');
    Route::get('/order', [IndexController::class, 'userOrder'])->name('user.order');
    Route::get('/account-detail', [IndexController::class, 'userAccount'])->name('user.account');
    Route::post('/update/account/{id}', [IndexController::class, 'updateAccount'])->name('update.account');
});
