<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stand;

class StandController extends Controller
{
    // Halaman utama menampilkan daftar stand (dengan paginasi)
    public function index()
    {
        $stands = Stand::paginate(6);
        return view('index', compact('stands'));
    }

    // Menampilkan semua stand (tanpa paginasi)
    public function showStands()
    {
        $stands = Stand::paginate(6);
        return view('stand.stand', compact('stands'));
    }

    // Menampilkan detail stand berdasarkan ID (view)
    public function show($id)
    {
        $stand = Stand::with('menus')->findOrFail($id);
        $foods = $stand->menus->where('type', 'makanan')->values();
        $drinks = $stand->menus->where('type', 'minuman')->values();

        return view('stand.standdetail', compact('stand', 'foods', 'drinks'));
    }

    // Menampilkan detail stand sebagai JSON (API)
    public function apiShow($id)
    {
        $stand = Stand::with('menus')->findOrFail($id);
        return response()->json([
            'id' => $stand->id,
            'name' => $stand->name,
            'menus' => $stand->menus,
        ]);
    }
}
