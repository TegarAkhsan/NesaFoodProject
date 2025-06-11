<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StandOwner;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\Rules\Password;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login sebagai StandOwner
        $standOwner = StandOwner::where('email', $credentials['email'])->first();
        if ($standOwner && Hash::check($credentials['password'], $standOwner->password)) {
            // Autentikasi JWT dengan guard standowner_api
            auth()->shouldUse('standowner_api');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Login gagal sebagai StandOwner'], 401);
            }

            return response()->json([
                'message' => 'Login berhasil sebagai StandOwner',
                'user'    => $standOwner->only(['id', 'name', 'email']),
                'token'   => $token,
                'guard'   => 'standowner_api'
            ]);
        }

        // Coba login sebagai User
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Autentikasi JWT dengan guard api
            auth()->shouldUse('api');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Login gagal sebagai User'], 401);
            }

            return response()->json([
                'message' => 'Login berhasil sebagai User',
                'user'    => $user->only(['id', 'name', 'email']),
                'token'   => $token,
                'guard'   => 'api'
            ]);
        }

        return response()->json(['message' => 'Email atau password salah'], 401);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout berhasil']);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Gagal logout atau token tidak ditemukan'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate token via Sanctum
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }
}
