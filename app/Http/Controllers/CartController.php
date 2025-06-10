<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order; // Jika Anda ingin menyimpan pesanan ke database
use App\Models\OrderItem; // Jika Anda ingin menyimpan item pesanan ke database
use Illuminate\Support\Facades\Log; // Jika Anda ingin menggunakan log

class CartController extends Controller
{
    // Menampilkan keranjang di Web
    public function index()
    {
        $items = Session::get('cart', []);
        return view('cart.index', compact('items'));
    }

    // Menghitung total harga dari cart session
    private function calculateTotal()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    
    // Menambah item ke dalam cart
    public function store(Request $request)
    {
        // Logika menambahkan item ke keranjang
        $menuId = $request->menu_id;

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
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
            'data' => ['cart' => $cart]
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

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus dari keranjang!',
            'data' => ['cart' => $cart]
        ]);
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

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui!',
            'data' => ['cart' => $cart]
        ]);
    }

    // API: Menghapus semua item di cart
    public function clearCart()
    {
        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan!',
            'data' => ['cart' => []]
        ]);
    }

    // API: Menyimpan catatan untuk checkout
    public function saveNote(Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:500'
        ]);

        session(['checkout_note' => $request->catatan]);

        return redirect()->route('cart.index')->with('success', 'Catatan berhasil disimpan.');
        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil disimpan.',
            'data' => ['note' => $request->catatan]
        ]);
    }

    public function apiSaveNote(Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:500'
        ]);

        session(['checkout_note' => $request->catatan]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil disimpan.',
            'data' => ['note' => $request->catatan]
        ]);
    }

    // Menampilkan halaman checkout
    public function checkout(Request $request)
    {
        $items = Session::get('cart', []);
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Simpan catatan ke session agar bisa digunakan di view checkout
        if ($request->has('catatan')) {
            Session::put('checkout_note', $request->input('catatan'));
        }

        return view('cart.checkout', compact('items', 'total'));
    }

    public function apiCheckout(Request $request)
    {
        $items = Session::get('cart', []);
        $total = $this->calculateTotal();

        return response()->json([
            'success' => true,
            'message' => 'Data checkout berhasil diambil.',
            'data' => [
                'items' => $items,
                'total' => $total
            ]
        ]);
    }

    // Memproses checkout
    public function processCheckout(Request $request)
    {
        Log::info('Process checkout dipanggil');
        // Validasi dan simpan order
        $order = Order::create([
            'invoice_code' => 'NSF-' . now()->format('His') . '-' . strtoupper(\Illuminate\Support\Str::random(5)),
            'name' => $request->name,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'promo_code' => $request->promo_code,
            'status' => 'pending',
            'total' => $this->calculateTotal(), // fungsi hitung total kamu
        ]);

        // Simpan order items (contoh)
        foreach(session('cart') as $item) {
            $order->orderItems()->create([
                'menu_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Hapus session cart atau sesuaikan
        session()->forget('cart');

        // Redirect ke halaman detail order, kirim id order
        return redirect()->route('order.show', $order->id);
    }

    #API Process Checkout
    public function apiProcessCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $order = Order::create([
            'invoice_code' => 'NSF-' . now()->format('His') . '-' . strtoupper(\Illuminate\Support\Str::random(5)),
            'name' => $request->name,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'promo_code' => $request->promo_code,
            'status' => 'pending',
            'total' => $this->calculateTotal(),
        ]);

        foreach ($cart as $item) {
            $order->orderItems()->create([
                'menu_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil',
            'data' => $order->load('orderItems')
        ]);
    }
}
