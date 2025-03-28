<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Stand;
use App\Models\Menu;

// Menampilkan semua Stand dengan menu (API)
Route::get('/stands', function () {
    return Stand::with('menus')->get();
});

// Halaman utama
Route::get('/', [StandController::class, 'index'])->name('index');
Route::get('/stand', [StandController::class, 'showStands'])->name('stands');

// Detail Stand
Route::get('/standdetail/{id}', [StandController::class, 'standDetail'])->name('stand.detail');

// Cart Routes
Route::middleware(['web'])->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::get('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Halaman Statis
Route::view('/aboutus', 'aboutus')->name('aboutus');
Route::view('/profile', 'profile')->name('profile');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/logout', 'logout')->name('logout');
Route::view('/order', 'order')->name('order');
Route::view('/stand1', 'stand1')->name('stand1');

// Tes Cek data Stand dengan Menu
Route::get('/stands', function () {
    return Stand::with('menus')->get();
});
