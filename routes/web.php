<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminAuthController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Backend\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Backend\Admin\SlideController;
use App\Http\Controllers\Backend\Admin\OrderController as AdminOrderController;

use App\Http\Controllers\Fronted\Customer\CustomerAuthController;
use App\Http\Controllers\Fronted\Customer\HomeController;
use App\Http\Controllers\Fronted\Customer\CategoryController as CustomerCategoryController;
use App\Http\Controllers\Fronted\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Fronted\Customer\CartController;
use App\Http\Controllers\Fronted\Customer\OrderController as CustomerOrderController;

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

/* admin */

route::prefix('admin')->group(function () {
    // login
    Route::get('login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('redirectIf.admin.auth');
    Route::post('login', [AdminAuthController::class, 'authLogin'])->name('admin.authLogin')->middleware('redirectIf.admin.auth');

    // logout
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

    // dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard')->middleware('require.admin.login');

    // CRUD Users
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('users', [UserController::class, 'index'])->name('user.index');
        // create
        Route::get('users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('users', [UserController::class, 'store'])->name('user.store');
        // show
        Route::get('users/{user_id}', [UserController::class, 'show'])->name('user.show');
        // edit
        Route::get('users/{user_id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('users/{user_id}', [UserController::class, 'update'])->name('user.update');
        // delete
        Route::delete('users/{user_id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // CRUD Products
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('products', [AdminProductController::class, 'index'])->name('product.index');
        // create
        Route::get('products/create', [AdminProductController::class, 'create'])->name('product.create');
        Route::post('products', [AdminProductController::class, 'store'])->name('product.store');
        // show
        Route::get('products/{product_id}', [AdminProductController::class, 'show'])->name('product.show');
        // edit
        Route::get('products/{product_id}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::put('products/{product_id}', [AdminProductController::class, 'update'])->name('product.update');
        // delete
        Route::delete('products/{product_id}', [AdminProductController::class, 'destroy'])->name('product.destroy');
    });

    // CRUD Slide
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('slides', [SlideController::class, 'index'])->name('slide.index');
        // create
        Route::get('slides/create', [SlideController::class, 'create'])->name('slide.create');
        Route::post('/slides', [SlideController::class, 'store'])->name('slides.store');
        // edit
        Route::get('slides/{slide_id}/edit', [SlideController::class, 'edit'])->name('slide.edit');
        Route::put('slides/{slide_id}', [SlideController::class, 'update'])->name('slide.update');
        // delete
        Route::delete('slides/{slide_id}', [SlideController::class, 'destroy'])->name('slide.destroy');
    });

    // CRUD Categories
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('categories', [AdminCategoryController::class, 'index'])->name('category.index');
        // create
        Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('category.create');
        Route::post('categories', [AdminCategoryController::class, 'store'])->name('category.store');
        // show
        Route::get('categories/{category_id}', [AdminCategoryController::class, 'show'])->name('category.show');
        // edit
        Route::get('categories/{category_id}/edit', [AdminCategoryController::class, 'edit'])->name('category.edit');
        Route::put('categories/{category_id}', [AdminCategoryController::class, 'update'])->name('category.update');
        // delete
        Route::delete('categories/{category_id}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Orders
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('orders', [AdminOrderController::class, 'index'])->name('order.index');
        // show
        Route::get('orders/{order_id}', [AdminOrderController::class, 'show'])->name('order.show');
        // edit
        Route::get('orders/{order_id}/edit', [AdminOrderController::class, 'edit'])->name('order.edit');
        Route::put('orders/{order_id}', [AdminOrderController::class, 'update'])->name('order.update');
        // delete
        Route::delete('orders/{order_id}', [AdminOrderController::class, 'destroy'])->name('order.destroy');
    });
});


/* customer */

// home
Route::get('/', [HomeController::class, 'index'])->name('customer.index');

// product
Route::get('/san-pham', [CustomerProductController::class, 'index'])->name('customer.product');
Route::get('/san-pham/{slug}', [CustomerProductController::class, 'show'])->name('customer.product.show');

Route::get('/tim-kiem', [CustomerProductController::class, 'search'])->name('customer.product.search');

Route::get('/danh-muc/{slug}', [CustomerCategoryController::class, 'showProductsByCategory'])->name('customer.category.products');

// cart
route::middleware(['web'])->group(function () { 
    route::get('/gio-hang', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/them-vao-gio-hang', [CartController::class, 'addToCart'])->name('customer.addToCart');
    Route::post('/gio-hang/update', [CartController::class, 'updateCart'])->name('customer.updateCart');
    Route::post('/gio-hang/remove', [CartController::class, 'removeFromCart'])->name('customer.removeFromCart');
});

// payment
Route::get('/thanh-toan', [CustomerOrderController::class, 'checkout'])->name('customer.checkout')->middleware('require.customer.login');
// order
Route::post('/dat-hang', [CustomerOrderController::class, 'placeOrder'])->name('customer.placeOrder')->middleware('require.customer.login');
Route::get('/dat-hang-thanh-cong/{order}', [CustomerOrderController::class, 'orderSuccess'])->name('customer.order.success')->middleware('require.customer.login');
Route::get('/lich-su-don-hang', [CustomerOrderController::class, 'orderHistory'])->name('customer.orders')->middleware('require.customer.login');
Route::get('/don-hang/{order}', [CustomerOrderController::class, 'orderDetail'])->name('customer.order.detail')->middleware('require.customer.login');

// login
Route::get('login', [CustomerAuthController::class, 'login'])->name('customer.login')->middleware('redirectIf.customer.auth');
Route::post('login', [CustomerAuthController::class, 'authLogin'])->name('customer.authLogin')->middleware('redirectIf.customer.auth');

// register
route::get('register', [CustomerAuthController::class, 'register'])->name('customer.register')->middleware('redirectIf.customer.auth');
route::post('register', [CustomerAuthController::class, 'authRegister'])->name('customer.authRegister')->middleware('redirectIf.customer.auth');;

// logout
Route::post('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout')->middleware('auth');
