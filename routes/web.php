<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnifiedLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StandOwner\DashboardController;
use App\Http\Controllers\StandOwner\MenuController;
use App\Http\Controllers\HomeController;
use App\Models\Menu;

// =============================
// Halaman Utama & Stand
// =============================
// Route::get('/', function () {
//     $bestsellers = Menu::latest()->limit(6)->get();
//     return view('index', compact('bestsellers'));
// });
Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/', [StandController::class, 'index'])->name('index');
Route::post('/', [OrderController::class, 'index'])->name('index');
// Route::get('/stand', [StandController::class, 'showStands'])->name('stand.index');
// Route::get('/stand/{id}', [StandController::class, 'show'])->name('stand.show');
Route::get('/stand/{id}', [StandController::class, 'show'])
    ->middleware('auth')
    ->name('stand.show');

// =============================
// Cart
// =============================
Route::middleware(['web'])->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::post('/store', [CartController::class, 'store'])->name('store');
    Route::post('/update', [CartController::class, 'updateCart'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'removeFromCart'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('processCheckout');
    Route::post('/save-note', [CartController::class, 'saveNote'])->name('cart.saveNote');
});

// =============================
// Order & Contact
// =============================
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::get('/orders/{invoice}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// =============================
// Halaman Statis
// =============================
Route::view('/aboutus', 'aboutus')->name('aboutus');
Route::view('/order', 'order')->name('order');
Route::view('/orderdetail', 'orderdetail')->name('orderdetail');
Route::view('/orderhistory', 'orderhistory')->name('orderhistory');
Route::view('/orderhistorydetail', 'orderhistorydetail')->name('orderhistorydetail');

// =============================
// Login & Auth
// =============================
Route::get('/auth/login', fn () => view('auth.login'))->name('login');
Route::post('/auth/login', [UnifiedLoginController::class, 'login'])->name('auth.login');
Route::view('auth/register', 'auth.register')->name('register');
Route::post('/auth/logout', [UnifiedLoginController::class, 'logout'])->name('auth.logout');

// Route::post('/login', [UnifiedLoginController::class, 'login'])->name('login');
// =============================
// User Dashboard
// =============================
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');

// =============================
// StandOwner Auth & Dashboard
// =============================
Route::prefix('standowner')->name('standowner.')->group(function () {
    // Auth routes (tanpa middleware)
    // Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Proteksi semua route ini dengan guard 'standowner'
    Route::middleware('auth:standowner')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/dashboard/menu', [DashboardController::class, 'storeMenu'])->name('dashboard.storeMenu');
        Route::delete('/dashboard/menu/{id}', [DashboardController::class, 'destroyMenu'])->name('dashboard.destroyMenu');

        // Menu CRUD
        Route::resource('menu', MenuController::class)->names([
            'index' => 'menu.index',
            'create' => 'menu.create',
            'store' => 'menu.store',
            'edit' => 'menu.edit',
            'update' => 'menu.update',
            'destroy' => 'menu.destroy',
        ]);
    });
});

// =============================
// Profil
// =============================
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->middleware('auth')->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('edit');
    Route::post('/update', [ProfileController::class, 'update'])->middleware('auth')->name('update');
});



require __DIR__.'/auth.php';