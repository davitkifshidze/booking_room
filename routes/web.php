<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/', [AdminAuthController::class, 'show'])->name('login.show');
    Route::get('/login', [AdminAuthController::class, 'show'])->name('login.show');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'adminAuth'], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');


    });

});
