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

    // Menampilkan detail stand berdasarkan ID atau Slug (view)
    public function show($idOrSlug)
    {
        if (is_numeric($idOrSlug)) {
            $stand = Stand::with('menus')->find($idOrSlug);
        } else {
            $stand = null;
        }

        if (!$stand) {
            $stands = Stand::with('menus')->get();
            $stand = $stands->first(function ($item) use ($idOrSlug) {
                return \Illuminate\Support\Str::slug($item->name) === $idOrSlug;
            });
        }

        if (!$stand) {
            abort(404);
        }

        $foods = $stand->menus->where('type', 'makanan')->values();
        $drinks = $stand->menus->where('type', 'minuman')->values();

        return view('stand.standdetail', compact('stand', 'foods', 'drinks'));
    }

    // Menampilkan detail stand sebagai JSON (API)
    public function apiShow($idOrSlug)
    {
        if (is_numeric($idOrSlug)) {
            $stand = Stand::with('menus')->find($idOrSlug);
        } else {
            $stand = null;
        }

        if (!$stand) {
            $stands = Stand::with('menus')->get();
            $stand = $stands->first(function ($item) use ($idOrSlug) {
                return \Illuminate\Support\Str::slug($item->name) === $idOrSlug;
            });
        }

        if (!$stand) {
            return response()->json(['error' => 'Stand not found'], 404);
        }

        return response()->json([
            'id' => $stand->id,
            'name' => $stand->name,
            'menus' => $stand->menus,
        ]);
    }
}
