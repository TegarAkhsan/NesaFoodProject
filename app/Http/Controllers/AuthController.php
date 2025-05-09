<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // ke halaman resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('index'); // Redirect ke halaman utama setelah login
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index'); // Redirect ke halaman utama setelah logout
    }

    public function showRegistrationForm()
    {
        return view('auth.signup'); // ke halaman resources/views/auth/signup.blade.php
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        
        ]); 

        Auth::login($user);

        return redirect()->route('index'); // Redirect ke halaman utama setelah signup
    }
    public function showProfile()
    {
        return view('auth.profile'); // ke halaman resources/views/auth/profile.blade.php
    }
}

