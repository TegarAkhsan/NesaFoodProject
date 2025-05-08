<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Stand;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// =============================
// API: Mendapatkan semua Stand beserta menu
// =============================
Route::get('/stands', function () {
    return Stand::with('menus')->get();
});