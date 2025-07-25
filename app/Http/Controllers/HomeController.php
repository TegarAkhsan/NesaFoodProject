<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bestsellers = Menu::latest()->limit(6)->get();
        return view('index', compact('bestsellers'));
    }
}