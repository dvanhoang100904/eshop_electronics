<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\UserController;

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



// Route cho user chưa login
Route::middleware('require.login')->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('user.login');
    Route::post('login', [UserController::class, 'authUser'])->name('user.authUser');
});


// Route cho user đã login
Route::middleware('check.login')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
});


Route::get('/', function () {
    return view('welcome');
});
