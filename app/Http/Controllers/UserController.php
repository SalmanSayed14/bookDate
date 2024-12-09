<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show the user's booking page
    public function showBookingForm()
    {
        // Fetch bookings associated with the logged-in user
        $bookings = Auth::user()->bookings; // or you can use ->with('bookings') if necessary
        
        return view('user.booking', compact('bookings'));
    }

    // Store the user's booking (handle form submission)
    public function storeBooking(Request $request)
    {
        // Validate the booking form
        $request->validate([
            'booking_date' => 'required|date|after:today',
            'user_letter' => 'nullable|string|max:255',

        ]);

        // Create a new booking for the logged-in user
        Auth::user()->bookings()->create([
            'booking_date' => $request->booking_date,
            'status' => 'pending',  // Default status
            'user_letter' => $request->user_letter, 
        ]);

        return redirect()->route('user.booking');
    }
    public function sendUserLetter(Request $request, $bookingId)
{
    // Validate the user letter
    $request->validate([
        'user_letter' => 'required|string|max:1000',
    ]);

    // Find the booking by ID
    $booking = Booking::findOrFail($bookingId);

    // Debug: Check what data is being passed in the request
    \Log::info('User letter received: ', ['user_letter' => $request->input('user_letter')]);

    // Update the user's letter in the database
    $booking->user_letter = $request->input('user_letter');
    $booking->save();

    // Debug: Check if the booking was saved with the letter
    \Log::info('Booking after saving: ', $booking->toArray());

    // Redirect back with success message
    return redirect()->route('user.booking')->with('success', 'User letter sent successfully.');
}
}