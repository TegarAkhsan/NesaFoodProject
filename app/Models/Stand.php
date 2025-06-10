<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    protected $fillable = ['name', 'location', 'description'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'stand_id', 'id');
    }

    // public function index()
    // {
    //     $stands = Stand::all();
    //     return view('stand.index', compact('stands'));
    // }
    
}
