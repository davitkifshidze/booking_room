<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\Tablet\TabletController;
use App\Http\Controllers\Site\User\RegisterController;
use App\Http\Controllers\Site\User\UserBookingController;
use App\Http\Controllers\Site\User\UserDashboardController;
use App\Http\Controllers\Site\User\UserAuthController;
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

    Route::get('/', [AdminAuthController::class, 'show'])->name('admin_login_show');
    Route::get('/login', [AdminAuthController::class, 'show'])->name('admin_login_show');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'adminAuth'], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');

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

        Route::get('/booking', [BookingController::class, 'index'])->name('booking');
        Route::get('/booking/create', [BookingController::class, 'create'])->name('booking_form');
        Route::post('/booking/create', [BookingController::class, 'store'])->name('create_booking');
        Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('delete_booking');
        Route::get('/booking/room/{id}', [BookingController::class, 'room'])->name('room');

    });

});

Route::group(['namespace' => 'Site'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'user'], function () {

        Route::get('/', [UserAuthController::class, 'show'])->name('user_login_show');
        Route::get('/login', [UserAuthController::class, 'show'])->name('user_login_show');
        Route::post('/login', [UserAuthController::class, 'login'])->name('user_login');
        Route::get('/registration', [RegisterController::class, 'show'])->name('user_registration_show');
        Route::post('/registration', [RegisterController::class, 'register'])->name('user_register');

        Route::group(['middleware' => 'userAuth'], function () {

            Route::get('/logout', [UserAuthController::class, 'logout'])->name('user_logout');
            Route::get('/', [UserDashboardController::class, 'index'])->name('user_dashboard');
            Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user_dashboard');

            Route::get('/booking', [UserBookingController::class, 'index'])->name('user_booking');
            Route::delete('/booking/{id}', [UserBookingController::class, 'destroy'])->name('delete_user_booking');
            Route::get('/booking/create', [UserBookingController::class, 'create'])->name('user_booking_form');
            Route::get('/booking/room/{id}', [UserBookingController::class, 'room'])->name('user_room');
            Route::post('/booking/create', [UserBookingController::class, 'store'])->name('create_booking');

        });

    });

    Route::group(['prefix' => 'tablet'], function () {

        Route::get('/', [TabletController::class, 'index'])->name('tablet');
        Route::get('/room', [TabletController::class, 'index'])->name('tablet');
        Route::get('/room/{id}', [TabletController::class, 'create'])->name('show_room');
        Route::get('/room/{id}/booking', [TabletController::class, 'room'])->name('room_booking');
        Route::post('/room/user', [TabletController::class, 'user'])->name('check_user');
        Route::post('/room/create', [TabletController::class, 'store'])->name('tablet_booking');


    });



});
