<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use App\Models\Stand;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

// =============================
// Halaman Utama
// =============================
Route::get('/', [StandController::class, 'index'])->name('index');

// =============================
// Menampilkan Semua Stand
// =============================
Route::get('/stand', [StandController::class, 'showStands'])->name('stands');

// =============================
// Menampilkan Detail Stand berdasarkan ID
// =============================
Route::get('/stand/{id}', [StandController::class, 'show'])->name('stand.show');

// =============================
// Cart / Keranjang Belanja
// =============================
Route::middleware(['web'])->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::get('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');  // Tombol Checkout
        Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout'); // Proses Checkout
        Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
    });
});

// =============================
// Halaman Statis
// =============================
Route::view('/aboutus', 'aboutus')->name('aboutus');
Route::view('/profile', 'profile')->name('profile');
Route::view('/login', 'login')->name('login');
Route::view('/signup', 'signup')->name('signup');
Route::view('/logout', 'logout')->name('logout');
Route::view('/order', 'order')->name('order');
Route::view('/orderdetail', 'orderdetail')->name('orderdetail');
Route::view('/orderhistory', 'orderhistory')->name('orderhistory');
Route::view('/orderhistorydetail', 'orderhistorydetail')->name('orderhistorydetail');

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/signup', [AuthController::class, 'showRegistrationForm'])->name('auth.signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup.submit');
});
