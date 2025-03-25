<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $cart = Session::get('cart', []);
        $item = $request->only(['id', 'name', 'price']);

        if (isset($cart[$item['id']])) {
            $cart[$item['id']]['quantity']++;
        } else {
            $item['quantity'] = 1;
            $cart[$item['id']] = $item;
        }

        Session::put('cart', $cart);

        return back()->with('success', 'Item ditambahkan ke keranjang');
    }

    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            Session::put('cart', $cart);
        }

        return back()->with('success', 'Item dihapus dari keranjang');
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        return view('checkout', compact('cart'));
    }
}
