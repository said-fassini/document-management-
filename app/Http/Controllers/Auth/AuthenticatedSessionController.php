<?php

namespace App\Http\Controllers\Auth;  

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  
use App\Models\User;  

class AuthenticatedSessionController extends Controller  
{  
    public function create()  
    {  
        // Return the login view (if you have a dedicated login view)  
        return view('auth.login'); // Adjust as necessary  
    }  

    public function store(Request $request)  
    {  
        $request->validate([  
            'email' => 'required|email',  
            'password' => 'required',  
        ]);  

        // Attempt to log the user in  
        if (Auth::attempt($request->only('email', 'password'))) {  
            $request->session()->regenerate();  

            // Retrieve the authenticated user  
            $user = Auth::user();  

            // Redirect based on user role (string)  
            switch ($user->role) {  
                case 'President':  
                    return redirect()->route('president.home'); // Admin dashboard  
                case 'General Director':  
                    return redirect()->route('dgs.dashboard'); // Editor dashboard  
                case 'Bureau dOrdre':  
                    return redirect()->route('bureau.home'); // Editor dashboard  
                default:  
                    return redirect()->route('welcome'); // Default user dashboard  
            }  
        }  

        return back()->withErrors([  
            'email' => 'The provided credentials do not match our records.',  
        ]);  
    }  

    public function destroy(Request $request)  
    {  
        Auth::logout();  
        $request->session()->invalidate();  
        $request->session()->regenerateToken();  

        return redirect('/'); // Customize this redirect as necessary  
    }  
}