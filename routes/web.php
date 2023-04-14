<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
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

        Route::get('/user', [UserController::class, 'index'])->name('user_list');
        Route::post('/user/create', [UserController::class, 'store'])->name('create_user');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete_user');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('edit_user');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('update_user');

        Route::get('/room', [RoomController::class, 'index'])->name('room_list');
        Route::post('/room/create', [RoomController::class, 'store'])->name('create_room');
        Route::delete('/room/{id}', [RoomController::class, 'destroy'])->name('delete_room');
        Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('edit_room');
        Route::put('/room/{id}', [RoomController::class, 'update'])->name('update_room');

    });

});
