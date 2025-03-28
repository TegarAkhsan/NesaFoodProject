<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $items = Session::get('cart', []); // Gunakan nama variabel yang sama dengan di view
        return view('cart.index', compact('items'));
    }
    

    public function addToCart(Request $request)
    {
        $cart = Session::get('cart', []);

        // Cek apakah item sudah ada di keranjang
        $itemIndex = array_search($request->id, array_column($cart, 'id'));
        if ($itemIndex !== false) {
            $cart[$itemIndex]['quantity'] += 1;
        } else {
            $cart[] = [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true, 
            'message' => 'Item berhasil ditambahkan ke keranjang!',
            'cart' => $cart
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        Session::put('cart', array_values($cart));

        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function clearCart()
    {
        Session::forget('cart');
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        return view('checkout');
    }
}