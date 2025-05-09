<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order; // Jika Anda ingin menyimpan pesanan ke database

class CartController extends Controller
{
    // Menampilkan keranjang di Web
    public function index()
    {
        $items = Session::get('cart', []);
        return view('cart.index', compact('items'));
    }

    // API: Menambah item ke dalam cart
    public function addToCart(Request $request)
    {
        $cart = Session::get('cart', []);
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

    // API: Menghapus item dari cart
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        Session::put('cart', array_values($cart));

        return response()->json(['success' => true, 'cart' => $cart]);
    }

    // API: Mengupdate jumlah item dalam cart
    public function updateCart(Request $request)
    {
        $cart = Session::get('cart', []);
        foreach ($cart as &$item) {
            if ($item['id'] == $request->id) {
                if ($request->type === 'increase') {
                    $item['quantity'] += 1;
                } elseif ($request->type === 'decrease' && $item['quantity'] > 1) {
                    $item['quantity'] -= 1;
                }
                break;
            }
        }

        Session::put('cart', $cart);
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    // API: Menghapus semua item di cart
    public function clearCart()
    {
        Session::forget('cart');
        return response()->json(['success' => true]);
    }

    // Menampilkan halaman checkout
    public function checkout()
    {
        $items = Session::get('cart', []);
        $total = 0;
    
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    
        // Kirim data keranjang dan total ke halaman checkout
        return view('checkout', compact('items', 'total'));  // Pastikan 'items' dikirim ke view
    }

    // Memproses checkout
    public function processCheckout(Request $request)
    {
        // Validasi input dari form checkout
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'note' => 'nullable|string',  // Catatan pembeli
            'promo_code' => 'nullable|string', // Kode promo (opsional)
        ]);

        // Perhitungan total harga setelah memasukkan kode promo (jika ada)
        $total = 0;
        $cart = Session::get('cart', []);
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Cek apakah ada kode promo yang valid
        if ($request->promo_code) {
            // Lakukan pengecekan kode promo di sini
            // Misalnya, jika kode promo valid, diskon 10%
            if ($request->promo_code === 'DISKON10') {
                $total *= 0.9;  // Diskon 10%
            }
        }

        // Proses pemesanan dan simpan di database (opsional)
        // Anda bisa membuat model Order atau transaksi untuk menyimpan data pesanan
        // Contoh:
        /*
        Order::create([
            'user_id' => auth()->id(),  // Jika menggunakan sistem login
            'name' => $validated['name'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'note' => $validated['note'],
            'promo_code' => $validated['promo_code'],
            'total' => $total,
            'items' => json_encode($cart),  // Menyimpan item sebagai JSON
        ]);
        */

        // Kosongkan keranjang setelah checkout selesai
        Session::forget('cart');

        // Redirect ke halaman order dengan pesan sukses
        return redirect()->route('order')->with('success', 'Pemesanan berhasil!');
    }
}
