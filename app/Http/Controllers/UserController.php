<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showBookingForm()
    {
        $bookings = Auth::user()->bookings;
        
        return view('user.booking', compact('bookings'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date|after:today',
            'user_letter' => 'nullable|string|max:255',

        ]);

        Auth::user()->bookings()->create([
            'booking_date' => $request->booking_date,
            'status' => 'pending', 
            'user_letter' => $request->user_letter, 
        ]);

        return redirect()->route('user.booking');
    }
    public function sendUserLetter(Request $request, $bookingId)
{
    $request->validate([
        'user_letter' => 'required|string|max:1000',
    ]);

    $booking = Booking::findOrFail($bookingId);

    \Log::info('User letter received: ', ['user_letter' => $request->input('user_letter')]);

    $booking->user_letter = $request->input('user_letter');
    $booking->save();

    \Log::info('Booking after saving: ', $booking->toArray());

    return redirect()->route('user.booking')->with('success', 'User letter sent successfully.');
}
}