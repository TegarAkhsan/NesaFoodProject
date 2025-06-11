<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemApiController extends Controller
{
    // Menampilkan semua order item
    public function index()
    {
        $items = OrderItem::with('order')->get();

        return response()->json([
            'success' => true,
            'message' => 'Semua order item berhasil diambil.',
            'data' => $items
        ]);
    }

    // Menampilkan order item berdasarkan order_id
    public function byOrder($order_id)
    {
        $items = OrderItem::where('order_id', $order_id)->get();

        return response()->json([
            'success' => true,
            'message' => "Order item untuk order_id $order_id berhasil diambil.",
            'data' => $items
        ]);
    }
}
