<?php

use App\Http\Controllers\BankUpController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\RentServiceController;
use App\Http\Controllers\ServiceController;
use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/parent');
Route::resource('coins', CoinController::class);
Route::resource('service', ServiceController::class);
Route::resource('bankup',BankUpController::class);
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::resource('/rentService/{rentService}/booking',BookingController::class)->only('create', 'store');
Route::get('/services/category/{category}', [ServiceController::class, 'getServicesByCategory']);
Route::resource('rentService', RentServiceController::class);
Route::put('/rentService/{rentService}/status', [RentServiceController::class, 'responseOffer']);
Route::get('/rentService/service/{service}/data', [RentServiceController::class, 'serviceData']);
Route::get('/rentService/{rentService}/pdf', [RentServiceController::class, 'toPdf'])->name('rentService.pdf');
Route::view('/parent', 'parent')->name('parent');