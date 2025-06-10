<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Stand;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckoutController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// // =============================
// // API: Mendapatkan semua Stand beserta menu
// // =============================
// Route::get('/stands', function () {
//     return Stand::with('menus')->get();
// });

// // API: Melakukan Sign Up
// Route::post('/register', function (Request $request) {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:8|confirmed',
//     ]);

//     $user = User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => bcrypt($request->password),
//     ]);

//     return response()->json(['message' => 'User registered successfully!'], 201);
// });

// // API: Melakukan Login
// Route::post('/login', function (Request $request) {
//     $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string',
//     ]);

//     if (Auth::attempt($request->only('email', 'password'))) {
//         $user = Auth::user();
//         return response()->json(['message' => 'Login successful!', 'user' => $user]);
//     }

//     return response()->json(['message' => 'Invalid credentials'], 401);
// });

// // API: Melakukan Logout
// Route::post('/logout', function (Request $request) {
//     Auth::logout();
//     return response()->json(['message' => 'Logout successful!']);
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store']);
});