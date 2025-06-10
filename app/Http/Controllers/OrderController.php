<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Jika form dikirim POST (konfirmasi pembayaran)
        if ($request->isMethod('post')) {
            $request->validate([
                'order_id' => 'required|exists:orders,id',
                'invoice_code' => 'required|string'
            ]);

            $order = Order::find($request->order_id);

            if ($order->invoice_code === $request->invoice_code) {
                $order->status = 'paid'; // update status pembayaran
                $order->save();

                return back()->with('success', 'Pesanan telah terbayar.');
            }

            return back()->withErrors(['invoice_code' => 'Kode invoice tidak cocok.']);
        }

        // GET request (tampilan awal index)
        $orders = Order::all(); // atau data lain sesuai kebutuhan
        return view('orders.index', compact('orders'));
    }

    // Tampilkan halaman detail order
    public function show($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);

        // Generate QR dari invoice_code
        $qrCode = QrCode::size(200)->generate($order->invoice_code);

        return view('order.show', compact('order', 'qrCode'));
    }

    // API: Menampilkan detail order
    public function apiShow($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    // Proses checkout: simpan order dan order_items
    public function processCheckout(Request $request)
    {
        Log::info('Process checkout dipanggil');
        $request->validate([
            'invoice_code' => 'required|string|max:255|unique:orders,invoice_code',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'payment_method' => 'required|in:transfer,cod,ewallet',
            'note' => 'nullable|string|max:500',
            'promo_code' => 'nullable|string|max:50',
            'status' => 'in:pending,completed,cancelled',
            'total' => 'required|numeric|min:0',
        ]);

        // Ambil data keranjang dari session (atau cara kamu menyimpan cart)
        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung total harga sebelum promo
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Terapkan promo jika ada (contoh promo DISKON10 = diskon 10%)
        $promoCode = $request->promo_code;
        $discount = 0;
        if ($promoCode === 'DISKON10') {
            $discount = $totalPrice * 0.10;
        }
        $finalTotal = $totalPrice - $discount;

        DB::beginTransaction();

        try {
            // Generate kode invoice unik
            $invoiceCode = 'NSF-' . now()->format('His') . '-' . strtoupper(Str::random(5));

            // Simpan order
            $order = Order::create([
                'invoice_code' => $invoiceCode,
                'customer_name' => $request->name,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'promo_code' => $promoCode,
                'status' => 'pending',
                'total' => $finalTotal,
            ]);

            // Simpan detail order_items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['id'],
                    'name' => $item['name'],          // Pastikan kolom 'name' ada di order_items tabel
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            // Bersihkan session cart setelah checkout berhasil
            session()->forget('cart');

            // Redirect ke halaman detail order atau sukses checkout
            return redirect()->route('order.show', $order->id)->with('success', 'Checkout berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }
    
    public function apiInvoice($invoice)
    {
        $order = Order::where('invoice', $invoice)->firstOrFail();
        return response()->json($order);
    }
}
