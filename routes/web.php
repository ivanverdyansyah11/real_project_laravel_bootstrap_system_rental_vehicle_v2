<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportBookingController;
use App\Http\Controllers\ReportReturnTransactionController;
use App\Http\Controllers\ReportTransactionController;
use App\Http\Controllers\ReturnTransactionController;
use App\Http\Controllers\VehicleBrandController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleSeriesController;

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

Route::fallback(function () {
    return redirect()->back();
});

Route::redirect('/', '/dashboard');

Route::middleware(['guest'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/login', 'index')->name('login.index');
        Route::post('/login', 'login')->name('login.authentication');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/admin', AdminController::class)->middleware('checkRole:admin');
    Route::resource('/driver', DriverController::class)->middleware('checkRole:admin');
    Route::resource('/customer', CustomerController::class)->middleware('checkRole:admin');
    Route::resource('/profile', ProfileController::class);
    Route::resource('/vehicle', VehicleController::class)->middleware('checkRole:admin,customer');
    Route::resource('/vehicle-brand', VehicleBrandController::class)->middleware('checkRole:admin');
    Route::resource('/vehicle-series', VehicleSeriesController::class)->middleware('checkRole:admin');
    Route::resource('/booking', BookingController::class)->middleware('checkRole:admin,customer');
    Route::get('/booking/show-driver-vehicle/{pickup_date}/{return_date}', [BookingController::class, 'showDriverVehicle'])->middleware('checkRole:admin,customer');
    Route::resource('/return-transaction', ReturnTransactionController::class)->middleware('checkRole:admin');
    Route::resource('/report-booking', ReportBookingController::class);
    Route::resource('/report-transaction', ReportTransactionController::class);
    Route::resource('/report-return-transaction', ReportReturnTransactionController::class);
    Route::get('/report-return-transaction/export/return-transaction', [ReportReturnTransactionController::class, 'export'])->name('report-return-transaction.export');
});
