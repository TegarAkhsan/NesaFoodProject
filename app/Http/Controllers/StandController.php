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

        // dd(get_class($stands));
        // Harus keluar: Illuminate\Pagination\LengthAwarePaginator

        return view('stand.stand', compact('stands'));
    }


    // Menampilkan detail stand berdasarkan ID
    public function show($id)
    {
        $stand = Stand::with('menus')->findOrFail($id);
        
        $foods = $stand->menus->where('type', 'makanan')->values();
        $drinks = $stand->menus->where('type', 'minuman')->values();

        // Disesuaikan dengan file view standdetail.blade.php
        return view('stand.standdetail', compact('stand', 'foods', 'drinks'));
    }
}
