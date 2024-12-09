<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::put('/booking/{bookingId}', [AdminController::class, 'updateBookingStatus'])->name('admin.updateBookingStatus');


});

Route::middleware('auth')->group(function () {
Route::get('/user/book', [UserController::class, 'showBookingForm'])->name('user.booking');
Route::post('/user/book', [UserController::class, 'storeBooking']);
});