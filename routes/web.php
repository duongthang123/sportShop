<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Client
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/shop/sort', [\App\Http\Controllers\ShopController::class, 'sort'])->name('shop.sort');
Route::get('/shop/filter-product', [\App\Http\Controllers\ShopController::class, 'filterProduct'])->name('shop.filterProduct');
Route::get('/shop/{category_id}/category', [\App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
Route::get('/shop/search', [\App\Http\Controllers\ShopController::class, 'search'])->name('shop.search');
Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/product', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store')->middleware('auth');


Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::post('/update-cart', [\App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/apply-coupon', [\App\Http\Controllers\CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
    Route::DELETE('/delete-cart/{product_id}', [\App\Http\Controllers\CartController::class, 'deleteProductInCart']);
});

Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout')->middleware(['auth', 'user_can_checkout_cart']);

Route::group(['prefix' => 'order', 'middleware' => 'auth'], function () {
    Route::get('/list-order', [\App\Http\Controllers\OrderController::class, 'index'])->name('order.list-order');
    Route::post('/cancel-order/{order_id}', [\App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('order.cancel-order');
    Route::post('/store', [\App\Http\Controllers\OrderController::class, 'store'])->name('order.store')->middleware('user_can_checkout_cart');
    Route::post('/payment_vnpay', [\App\Http\Controllers\OrderController::class, 'payment_vnpay'])->name('order.payment_vnpay')->middleware('user_can_checkout_cart');
    Route::post('/payment_momo', [\App\Http\Controllers\OrderController::class, 'payment_momo'])->name('order.payment_momo')->middleware('user_can_checkout_cart');
});

// Authenticated
Auth::routes();

// Admin
Route::middleware('checkRoleUser:super-admin,admin,employee,manager')->group(function () {
    // Các route khác
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard')->middleware('auth');

    Route::group(['prefix' => 'roles', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
        Route::get('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/store', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
        Route::put('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
        Route::DELETE('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy']);
    });

    Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
        Route::get('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::put('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::DELETE('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);
    });

    Route::group(['prefix' => 'categories', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
        Route::get('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('categories.show');
        Route::get('/{category}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::put('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
        Route::DELETE('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
    });

    Route::group(['prefix' => 'products', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
        Route::get('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('products.show');
        Route::get('/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
        Route::post('/store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
        Route::put('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
        Route::DELETE('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy']);
    });

    Route::group(['prefix' => 'productDetails', 'middleware' => ['auth']], function () {
        Route::DELETE('/{productDetail}', [\App\Http\Controllers\Admin\ProductDetailController::class, 'destroy'])->name('productDetails.destroy');
    });

    Route::group(['prefix' => 'coupons', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CouponController::class, 'index'])->name('coupons.index');
        Route::get('/create', [\App\Http\Controllers\Admin\CouponController::class, 'create'])->name('coupons.create');
        Route::get('/{coupon}/edit', [\App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('coupons.edit');
        Route::post('/store', [\App\Http\Controllers\Admin\CouponController::class, 'store'])->name('coupons.store');
        Route::put('/{coupon}', [\App\Http\Controllers\Admin\CouponController::class, 'update'])->name('coupons.update');
        Route::DELETE('/{coupon}', [\App\Http\Controllers\Admin\CouponController::class, 'destroy']);
    });

});
