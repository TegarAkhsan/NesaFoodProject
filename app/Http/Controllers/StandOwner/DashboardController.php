<?php

namespace App\Http\Controllers\StandOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\OrderItem;

/**
 * Controller untuk dashboard Stand Owner yang menampilkan menu dan pesanan.
 */
class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan data menu dan order yang masuk.
     */
    public function index()
    {
        $standOwner = Auth::guard('standowner')->user();

        $menus = Menu::where('stand_id', $standOwner->id)->get();

        $orderItems = OrderItem::with('order', 'menu')
            ->whereHas('menu', function ($query) use ($standOwner) {
                $query->where('stand_id', $standOwner->id);
            })
            ->latest()
            ->get();

        return view('standowner.dashboard', compact('standOwner', 'menus', 'orderItems'));
    }

    /**
     * Tambahkan menu baru dari dashboard.
     */
    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|in:makanan,minuman',
        ]);

        Menu::create([
            'stand_id' => Auth::guard('standowner')->user()->id,
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'stand_owner_email' => Auth::guard('standowner')->user()->email,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Hapus menu berdasarkan ID.
     */
    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->stand_id != Auth::guard('standowner')->user()->id) {
            abort(403);
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus!');
    }
}
