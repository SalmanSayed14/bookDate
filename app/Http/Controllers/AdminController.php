<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user')->orderBy('booking_date', 'desc')->get();
        return view('admin.index', compact('bookings'));
    }

    public function updateBookingStatus($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);

        $action = $request->input('action');

        if ($action == 'send_admin_letter') {
            $request->validate([
                'admin_letter' => 'required|string|max:1000',
            ]);
            $booking->admin_letter = $request->admin_letter;
        } elseif ($action == 'confirm') {
            $booking->status = 'confirmed';
        } elseif ($action == 'reject') {
            $booking->status = 'rejected';
        }

        $booking->save();    

        return redirect()->route('admin.index')->with('success', 'Booking status and letter updated successfully.');
    }
}