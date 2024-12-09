<?php

use Illuminate\Http\Request;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the user login (typically done in the request validation)
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Redirect based on user role
            if ($user->usertype == 'admin') {
                return redirect()->route('admin.index'); // Redirect to admin dashboard
            } else {
                return redirect()->route('user.booking'); // Redirect to user booking page
            }
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
