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
Route::get('/news', [\App\Http\Controllers\NewsFeedController::class, 'index'])->name('news');
Route::get('/coupon', [\App\Http\Controllers\NewsFeedController::class, 'coupon'])->name('coupon');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::put('/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
});

//Botman
Route::match(['get', 'post'], '/botman', [\App\Http\Controllers\BotManController::class, 'handle']);

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
    Route::get('/dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::get('/dashboard/revenue', [\App\Http\Controllers\Admin\HomeController::class, 'revenue'])->name('dashboard.revenue')->middleware('auth');
    Route::post('/dashboard/revenue-month', [\App\Http\Controllers\Admin\HomeController::class, 'revenueMonth'])->name('dashboard.revenue-month')->middleware('auth');
    Route::post('/dashboard/revenue-day', [\App\Http\Controllers\Admin\HomeController::class, 'revenueDay'])->name('dashboard.revenue-day')->middleware('auth');
    Route::get('/dashboard/product', [\App\Http\Controllers\Admin\HomeController::class, 'revenueProduct'])->name('dashboard.product')->middleware('auth');
    Route::post('/dashboard/product', [\App\Http\Controllers\Admin\HomeController::class, 'revenueProductByKey'])->name('dashboard.product-filter')->middleware('auth');

    Route::group(['prefix' => 'roles', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index')->middleware('role:super-admin');
        Route::get('/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create')->middleware('role:super-admin');
        Route::get('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'show'])->name('roles.show')->middleware('role:super-admin');
        Route::get('/{role}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit')->middleware('role:super-admin');
        Route::post('/store', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store')->middleware('role:super-admin');
        Route::put('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update')->middleware('role:super-admin');
        Route::DELETE('/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy'])->middleware('role:super-admin');
    });

    Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index')->middleware('permission:show-user');
        Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create')->middleware('permission:create-user');
        Route::get('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show')->middleware('permission:show-user');
        Route::get('/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit')->middleware('permission:update-user');
        Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store')->middleware('permission:create-user');
        Route::put('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update')->middleware('permission:update-user');
        Route::DELETE('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->middleware('permission:delete-user');
        Route::post('/search', [\App\Http\Controllers\Admin\UserController::class, 'search'])->name('users.search')->middleware('permission:show-user');

    });

    Route::group(['prefix' => 'categories', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index')->middleware('permission:show-category');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create')->middleware('permission:create-category');
        Route::get('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('categories.show')->middleware('permission:show-category');
        Route::get('/{category}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit')->middleware('permission:update-category');
        Route::post('/store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store')->middleware('permission:create-category');
        Route::put('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update')->middleware('permission:update-category');
        Route::DELETE('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->middleware('permission:delete-category');
    });

    Route::group(['prefix' => 'products', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index')->middleware('permission:show-product');
        Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create')->middleware('permission:create-product');
        Route::get('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('products.show')->middleware('permission:show-product');
        Route::get('/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit')->middleware('permission:update-product');
        Route::post('/store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store')->middleware('permission:create-product');
        Route::put('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update')->middleware('permission:update-product');
        Route::DELETE('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->middleware('permission:delete-product');
        Route::post('/search', [\App\Http\Controllers\Admin\ProductController::class, 'search'])->name('products.search')->middleware('permission:show-product');

    });

    Route::group(['prefix' => 'productDetails', 'middleware' => ['auth']], function () {
        Route::DELETE('/{productDetail}', [\App\Http\Controllers\Admin\ProductDetailController::class, 'destroy'])->name('productDetails.destroy')->middleware('permission:delete-product');
    });

    Route::group(['prefix' => 'coupons', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CouponController::class, 'index'])->name('coupons.index')->middleware('permission:show-coupon');
        Route::get('/create', [\App\Http\Controllers\Admin\CouponController::class, 'create'])->name('coupons.create')->middleware('permission:create-coupon');
        Route::get('/{coupon}/edit', [\App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('coupons.edit')->middleware('permission:update-coupon');
        Route::post('/store', [\App\Http\Controllers\Admin\CouponController::class, 'store'])->name('coupons.store')->middleware('permission:create-coupon');
        Route::put('/{coupon}', [\App\Http\Controllers\Admin\CouponController::class, 'update'])->name('coupons.update')->middleware('permission:update-coupon');
        Route::DELETE('/{coupon}', [\App\Http\Controllers\Admin\CouponController::class, 'destroy'])->middleware('permission:delete-coupon');
    });

    Route::group(['prefix' => 'orders', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index')->middleware('permission:list-order');
        Route::get('/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show')->middleware('permission:show-order');
        Route::put('/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update_status');
        Route::get('/order-pdf/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'orderPdf'])->name('orders.order_pdf');
        Route::post('/order-filter', [\App\Http\Controllers\Admin\OrderController::class, 'orderFilter'])->name('orders.order-filter');
        Route::post('/search', [\App\Http\Controllers\Admin\OrderController::class, 'search'])->name('orders.search');
    });

    Route::group(['prefix' => 'chats', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chats.index');
        Route::post('/message', [\App\Http\Controllers\Admin\ChatController::class, 'messageReceived'])->name('chats.message');
        Route::get('/message', [\App\Http\Controllers\Admin\ChatController::class, 'getMessage'])->name('chats.getMessage');
    });

});
