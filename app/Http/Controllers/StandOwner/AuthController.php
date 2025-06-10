<?php

namespace App\Http\Controllers\StandOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('standowner.auth.login');
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (auth()->guard('standowner')->attempt($credentials)) {
    //         return redirect()->intended('/standowner/dashboard');
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials']);
    // }


    // public function logout(Request $request)
    // {
    //     Auth::guard('standowner')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()->route('standowner.login');
    // }
}
