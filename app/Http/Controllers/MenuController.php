<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $limit = 4; // Atur jumlah item per kategori di sini
        return view('index', [
            'menus' => Menu::latest()->take($limit)->get(),
            'foods' => Menu::where('type', 'food')->latest()->take($limit)->get(),
            'drinks' => Menu::where('type', 'drink')->latest()->take($limit)->get(),
            'snacks' => Menu::where('type', 'snack')->latest()->take($limit)->get(),
        ]);
    }
}
