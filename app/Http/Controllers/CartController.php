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

    // API: Mengambil data keranjang
    public function apiIndex()
    {
        // Ambil data cart dari session
        $items = Session::get('cart', []);
        $note = Session::get('checkout_note', null); // hindari fungsi helper 'session()' di luar Laravel helper route

        return response()->json([
            'success' => true,
            'message' => 'Data keranjang berhasil diambil.',
            'data' => [
                'cart' => $items,
                'note' => $note,
                'count' => count($items)
            ]
        ]);
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
        $qtyToAdd = intval($request->input('quantity', 1));

        if ($itemIndex !== false) {
            $cart[$itemIndex]['quantity'] += $qtyToAdd;
        } else {
            $cart[] = [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $qtyToAdd
            ];
        }

        Session::put('cart', $cart);

        // Hitung total items di keranjang
        $cartCount = 0;
        foreach ($cart as $item) {
            $cartCount += $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil ditambahkan ke keranjang!',
            'cartCount' => $cartCount,
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

        // Validasi input
        $request->validate([
            'name'           => 'required|string|max:255',
            'address'        => 'required|string',
            'delivery_type'  => 'required|in:diantar,diambil',
            'payment_method' => 'required|in:transfer,cod,ewallet',
            'note'           => 'nullable|string|max:500',
            'promo_code'     => 'nullable|string|max:50',
        ]);

        // Validasi: jika diambil, tidak boleh COD
        if ($request->delivery_type === 'diambil' && $request->payment_method === 'cod') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jika memilih "Diambil Sendiri", pembayaran harus dilakukan terlebih dahulu (Transfer Bank atau E-Wallet). COD tidak tersedia untuk opsi ini.');
        }

        // Hitung subtotal
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Biaya pengiriman
        $deliveryFee = ($request->delivery_type === 'diantar') ? 5000 : 0;

        // Promo diskon
        $promoCode = $request->promo_code;
        $discount  = 0;
        if ($promoCode === 'DISKON10') {
            $discount = $subtotal * 0.10;
        }

        $finalTotal = ($subtotal - $discount) + $deliveryFee;

        // Simpan order
        $order = Order::create([
            'invoice_code'   => 'NSF-' . now()->format('His') . '-' . strtoupper(\Illuminate\Support\Str::random(5)),
            'customer_name'  => $request->name,
            'name'           => $request->name,
            'address'        => $request->address,
            'delivery_type'  => $request->delivery_type,
            'delivery_fee'   => $deliveryFee,
            'payment_method' => $request->payment_method,
            'note'           => $request->note,
            'promo_code'     => $promoCode,
            'status'         => 'pending',
            'total'          => $finalTotal,
        ]);

        // Simpan order items
        foreach ($cart as $item) {
            $order->orderItems()->create([
                'menu_id'  => $item['id'],
                'name'     => $item['name'],
                'price'    => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Hapus session cart
        session()->forget('cart');

        // Redirect ke halaman detail order
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
