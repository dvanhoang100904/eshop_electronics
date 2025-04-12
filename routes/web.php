<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminAuthController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\ProductController;
use App\Http\Controllers\Backend\Admin\CategoryController;

use App\Http\Controllers\Fronted\Customer\CustomerAuthController;
use App\Http\Controllers\Fronted\Customer\HomeController;


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

// admin
route::prefix('admin')->group(function () {
    // login
    Route::get('login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('redirectIf.admin.auth');
    Route::post('login', [AdminAuthController::class, 'authLogin'])->name('admin.authLogin');

    // logout
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

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
        Route::get('products', [ProductController::class, 'index'])->name('product.index');
        // create
        Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('products', [ProductController::class, 'store'])->name('product.store');
        // show
        Route::get('products/{product_id}', [ProductController::class, 'show'])->name('product.show');
        // edit
        Route::get('products/{product_id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('products/{product_id}', [ProductController::class, 'update'])->name('product.update');
        // delete
        Route::delete('products/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });


    // CRUD Categories
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
        // create
        Route::get('categories/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('category.store');
        // show
        Route::get('categories/{category_id}', [CategoryController::class, 'show'])->name('category.show');
        // edit
        Route::get('categories/{category_id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('categories/{category_id}', [CategoryController::class, 'update'])->name('category.update');
        // delete
        Route::delete('categories/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});

// Customer 
Route::prefix('/')->group(function () {
    // login
    Route::get('login', [CustomerAuthController::class, 'login'])->name('customer.login')->middleware('redirectIf.customer.auth');
    Route::post('login', [CustomerAuthController::class, 'authLogin'])->name('customer.authLogin');

    // logout
    Route::post('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

    // home
    Route::get('/', [HomeController::class, 'index'])->name('customer.index');
});
