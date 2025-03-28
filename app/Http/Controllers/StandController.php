<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stand;
use App\Models\Menu;

class StandController extends Controller
{
    public function index()
    {
        // Gunakan pagination agar tidak berat
        $stands = Stand::with('menus')->paginate(9);
        return view('index', compact('stands'));
    }

    // public function showStands()
    // {
    //     // Pagination untuk halaman stands
    //     $stands = Stand::paginate(9);
    //     return view('stand', compact('stands'));
    // }

    public function show($id)
    {
        $stand = Stand::with('menus')->find($id);
    
        if (!$stand) {
            abort(404); // Jika tidak ditemukan, tampilkan halaman 404
        }
    
        return view('standdetail', [
            'stand' => $stand,
            'foods' => $stand->menus
        ]);
    }
    

    public function standDetail($id)
    {
        $stand = Stand::with('menus')->find($id);
    
        if (!$stand) {
            abort(404, 'Stand not found');
        }
    
        $foods = $stand->menus->where('type', 'makanan')->values(); // Reset keys
        $drinks = $stand->menus->where('type', 'minuman')->values(); // Reset keys
    
        return view('standdetail', [
            'stand' => $stand, 
            'foods' => $foods, 
            'drinks' => $drinks
        ]);
    }
    
}
