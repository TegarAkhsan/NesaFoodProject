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

    // API: Menampilkan semua data order beserta item-nya
    public function apiIndex()
    {
        $orders = Order::with('orderItems')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data semua order berhasil diambil.',
            'data' => $orders
        ]);
    }

    // Tampilkan halaman detail order
    public function show($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);

        // Generate QR hanya untuk metode selain COD
        $qrCode = null;
        if ($order->payment_method !== 'cod') {
            $qrCode = QrCode::size(200)->generate($order->invoice_code);
        }

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
            'name'           => 'required|string|max:255',
            'address'        => 'required|string',
            'delivery_type'  => 'required|in:diantar,diambil',
            'payment_method' => 'required|in:transfer,cod,ewallet',
            'note'           => 'nullable|string|max:500',
            'promo_code'     => 'nullable|string|max:50',
        ]);

        // Validasi: jika diambil, tidak boleh COD — harus bayar dulu (transfer/ewallet)
        if ($request->delivery_type === 'diambil' && $request->payment_method === 'cod') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jika memilih "Diambil Sendiri", pembayaran harus dilakukan terlebih dahulu (Transfer Bank atau E-Wallet). COD tidak tersedia untuk pilihan ini.');
        }

        // Ambil data keranjang dari session
        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung subtotal item
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Biaya pengiriman (ongkir)
        $deliveryFee = ($request->delivery_type === 'diantar') ? 5000 : 0;

        // Terapkan promo jika ada
        $promoCode = $request->promo_code;
        $discount  = 0;
        if ($promoCode === 'DISKON10') {
            $discount = $subtotal * 0.10;
        }

        // Total akhir = subtotal - diskon + ongkir
        $finalTotal = ($subtotal - $discount) + $deliveryFee;

        DB::beginTransaction();

        try {
            $invoiceCode = 'NSF-' . now()->format('His') . '-' . strtoupper(Str::random(5));

            $order = Order::create([
                'invoice_code'   => $invoiceCode,
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

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id'  => $item['id'],
                    'name'     => $item['name'],
                    'price'    => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            session()->forget('cart');

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
