<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StandOwner;

class AuthApiController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        $standOwner = \App\Models\StandOwner::where('email', $credentials['email'])->first();
        if ($standOwner && Hash::check($credentials['password'], $standOwner->password)) {
            $token = $standOwner->createToken('StandOwnerToken')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil sebagai StandOwner',
                'user'    => $standOwner->only(['id', 'name', 'email']),
                'token'   => $token
            ]);
        }

        $user = \App\Models\User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('UserToken')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil sebagai User',
                'user'    => $user,
                'token'   => $token
            ]);
        }

        return response()->json([
            'message' => 'Email atau password salah'
        ], 401);
    }


    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logout berhasil'
            ]);
        }

        return response()->json([
            'message' => 'Tidak ada token aktif'
        ], 401);
    }

}
