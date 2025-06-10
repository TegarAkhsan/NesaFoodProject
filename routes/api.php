<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\Api\AuthApiController;

// AUTH API
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

// STAND API
Route::middleware('auth:api')->get('/stand/{id}', [StandController::class, 'apiShow']);

// CART API
Route::middleware('auth:api')->prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart']);
    Route::post('/update', [CartController::class, 'updateCart']);
    Route::delete('/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::delete('/clear', [CartController::class, 'clearCart']);

    Route::get('/checkout', [CartController::class, 'apiCheckout']);
    Route::post('/checkout', [CartController::class, 'apiProcessCheckout']);

    Route::post('/note', [CartController::class, 'apiSaveNote']);
});


// ORDER API
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/order/{id}', [OrderController::class, 'apiShow']);
    Route::get('/orders/{invoice}', [OrderController::class, 'apiInvoice']);
});

// CONTACT API
Route::post('/contact', [ContactController::class, 'apiStore']);
