<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->prefix('admin')->group(function () {
    // Route for the admin dashboard to view all bookings
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Route for updating the status of a booking and sending admin letter
    Route::put('/booking/{bookingId}', [AdminController::class, 'updateBookingStatus'])->name('admin.updateBookingStatus');


});

Route::middleware('auth')->group(function () {

    // Show the booking form
Route::get('/user/book', [UserController::class, 'showBookingForm'])->name('user.booking');

// Store a new booking
Route::post('/user/book', [UserController::class, 'storeBooking']);
});