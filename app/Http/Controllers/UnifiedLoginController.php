<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StandOwner;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UnifiedLoginController extends Controller
{
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
                $request->session()->regenerate();
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
                $request->session()->regenerate();
                return redirect()->route('user.dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'Login pembeli gagal. Cek kembali email & password.',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('standowner')->check()) {
            Auth::guard('standowner')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}

