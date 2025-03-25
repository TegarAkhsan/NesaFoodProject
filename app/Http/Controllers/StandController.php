<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stand;
use App\Models\Menu;

class StandController extends Controller
{
    public function index()
    {
        $stands = Stand::with('menus')->get();
        return view('index', compact('stands'));
    }

    public function showStands()
    {
        $stands = Stand::paginate(9);
        return view('stand', compact('stands'));
    }

    public function standDetail($id)
    {
        $stand = Stand::with(['menus' => function ($query) {
            $query->orderBy('category');
        }])->findOrFail($id);

        $stands = Stand::all(); // Untuk dropdown

        return view('standdetail', compact('stand', 'stands'));
    }

    public function show($id)
    {
        $stand = Stand::with('menus')->find($id);

        if (!$stand) {
            return response()->json(['error' => 'Stand not found'], 404);
        }

        $foods = $stand->menus->where('category', 'Food');
        $drinks = $stand->menus->where('category', 'Drink');
        $snacks = $stand->menus->where('category', 'Snack');

        return view('standdetail', compact('stand', 'foods', 'drinks', 'snacks'));
    }
}
