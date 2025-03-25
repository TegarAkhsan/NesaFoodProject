<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandController;
use App\Http\Controllers\CartController;

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/stand', function () {
//     return view('stand');
// });

// Route::get('/standdetail', function () {
//     return view('standdetail');
// });

// Route::get('/aboutus', function () {
//     return view('aboutus');
// });

// Route::get('/checkout', function () {
//     return view('checkout');
// });

// Route::get('/profile', function () {
//     return view('profile');
// });

Route::get('/', [StandController::class, 'index'])->name('index');
Route::get('/stand', [StandController::class, 'showStands'])->name('stands');
Route::get('/standdetail/{id}', function ($id) {
    if ($id == 1) {
        return view('stand1');
    }
    // Add more conditions for other stands if needed
    return view('standdetail', ['id' => $id]);
});
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CartController::class, 'checkout']);
Route::post('/cart/add/{id}', [CartController::class, 'addToCart']);
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
Route::get('/aboutus', function () {
    return view('aboutus');
});