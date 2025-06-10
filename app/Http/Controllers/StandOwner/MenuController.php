<?php

namespace App\Http\Controllers\StandOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk mengelola data menu milik Stand Owner.
 */
class MenuController extends Controller
{
    /**
     * Tampilkan semua menu milik StandOwner yang sedang login.
     * Menggunakan relasi stand untuk mendapatkan stand_id berdasar user email.
     */
    public function index()
    {
        // Dapatkan id stand milik standowner yang login
        $standId = Auth::user()->stand->id ?? null;

        if (!$standId) {
            // Kalau tidak punya stand, return view dengan array kosong
            $menus = collect();
        } else {
            // Ambil semua menu yang milik stand tersebut
            $menus = Menu::where('stand_id', $standId)->get();
        }

        return view('standowner.menu.index', compact('menus'));
    }

    /**
     * Tampilkan form tambah menu baru.
     */
    public function create()
    {
        return view('standowner.menu.create');
    }

    /**
     * Simpan menu baru ke database.
     */
    /**
     * Simpan menu baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $standId = Auth::user()->stand->id ?? null;

        if (!$standId) {
            return redirect()->back()->with('error', 'Stand tidak ditemukan untuk user ini.');
        }

        $menu = new Menu();
        $menu->name = $request->nama;
        $menu->price = $request->harga;
        $menu->type = $request->kategori;
        $menu->stand_id = $standId;
        $menu->description = $request->description ?? 'Belum ada deskripsi';

        if ($request->hasFile('gambar')) {
            $menu->image = $request->file('gambar')->store('menu', 'public');
        } else {
            $menu->image = 'default-food.jpg';
        }

        $menu->save();

        return redirect()->route('standowner.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit menu.
     */
    public function edit(Menu $menu)
    {
        $standId = Auth::user()->stand->id ?? null;

        // Pastikan menu yang diedit milik stand owner
        if ($menu->stand_id !== $standId) {
            abort(403, 'Unauthorized action.');
        }

        return view('standowner.menu.edit', compact('menu'));
    }

    /**
     * Proses update menu.
     */
    /**
     * Proses update menu.
     */
    public function update(Request $request, Menu $menu)
    {
        $standId = Auth::user()->stand->id ?? null;

        // Pastikan menu yang diupdate milik stand owner
        if ($menu->stand_id !== $standId) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'description' => 'nullable|string|max:1000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $menu->name = $request->nama;
        $menu->price = $request->harga;
        $menu->type = $request->kategori;
        $menu->description = $request->description ?? $menu->description;

        if ($request->hasFile('gambar')) {
            $menu->image = $request->file('gambar')->store('menu', 'public');
        }

        $menu->save();

        return redirect()->route('standowner.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Hapus menu.
     */
    public function destroy(Menu $menu)
    {
        $standId = Auth::user()->stand->id ?? null;

        // Pastikan menu yang dihapus milik stand owner
        if ($menu->stand_id !== $standId) {
            abort(403, 'Unauthorized action.');
        }

        $menu->delete();

        return redirect()->route('standowner.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
