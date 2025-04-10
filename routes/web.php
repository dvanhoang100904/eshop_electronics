<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminAuthController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\UserController;

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
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard')->middleware('require.admin.login');

    // CRUD Users
    Route::middleware('require.admin.login')->group(function () {
        // index
        Route::get('users', [UserController::class, 'index'])->name('user.list');
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
