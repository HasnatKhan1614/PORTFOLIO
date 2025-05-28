<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Inertia\Inertia;
use App\Models\{
    Product,
};


class LoginController extends Controller
{
    public function check(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
    
            $products = Product::all();
            return Inertia::render('Sale/POS', [
                // Include any data that your "pos" view requires
                'products' => $products,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function destroy() {
        Auth::guard('admin')->logout();

        return back();
    }
}
