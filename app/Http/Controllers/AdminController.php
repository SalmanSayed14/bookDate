<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show all bookings for the admin
    public function index()
    {
        $bookings = Booking::with('user')->orderBy('booking_date', 'desc')->get();
        return view('admin.index', compact('bookings'));
    }

    // Update the booking status and admin letter
    public function updateBookingStatus($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);

        // Determine the action based on the hidden input
        $action = $request->input('action');

        // Handle different actions
        if ($action == 'send_admin_letter') {
            // Validate and save the admin letter
            $request->validate([
                'admin_letter' => 'required|string|max:1000',
            ]);
            $booking->admin_letter = $request->admin_letter;
        } elseif ($action == 'confirm') {
            // Update status to confirmed
            $booking->status = 'confirmed';
        } elseif ($action == 'reject') {
            // Update status to rejected
            $booking->status = 'rejected';
        }

        // Save the updated booking
        $booking->save();    

        return redirect()->route('admin.index')->with('success', 'Booking status and letter updated successfully.');
    }
}