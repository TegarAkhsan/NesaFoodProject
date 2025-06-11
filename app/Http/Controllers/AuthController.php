<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StandOwner;
use App\Models\User;
use Illuminate\Support\Facades\Log;



class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // ke halaman resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        // dd('MASUK UNIFIED LOGIN CONTROLLER');
        $credentials = $request->only('email', 'password');
        Log::info('Login attempt', $credentials);

        // Cek apakah email milik StandOwner
        $isStandOwner = StandOwner::where('email', $credentials['email'])->exists();

        Log::info('Apakah StandOwner?', ['isStandOwner' => $isStandOwner]);

        if ($isStandOwner) {
            Log::info('Masuk blok StandOwner');
            logger("Coba login StandOwner", $credentials);
            if (Auth::guard('standowner')->attempt($credentials)) {
                Log::info('Password cocok, login StandOwner');
                logger("Berhasil login sebagai StandOwner");
                // $request->session()->regenerate();
                return redirect()->route('standowner.dashboard');
            } else {
                Log::warning('Gagal login manual StandOwner');
                logger("Gagal login StandOwner");
                return back()->withErrors([
                    'email' => 'Login pemilik stand gagal. Cek kembali email & password.',
                ]);
            }
        } 
        else {
            // Coba login sebagai pembeli biasa
            if (Auth::guard('web')->attempt($credentials)) {
                // $request->session()->regenerate();
                return redirect()->redirect()->route('/user/dashboard'); // atau redirect()->route('dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'Login pembeli gagal. Cek kembali email & password.',
                ]);
            }
        }
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

        return redirect()->redirect()->route('/user/dashboard'); // Redirect ke halaman utama setelah signup
    }
    public function showProfile()
    {
        return view('auth.profile'); // ke halaman resources/views/auth/profile.blade.php
    }
}

