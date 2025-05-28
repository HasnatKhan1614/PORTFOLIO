<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showLoginForm() 
    {
        return view('user.auth.login');
    }

    public function logout(Request $request)
    {
        // Perform the logout
        Auth::logout();

        // Optionally, invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page or another page
        return redirect('user/login');
    }
}
