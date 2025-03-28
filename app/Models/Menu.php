<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['stand_id', 'name', 'price', 'type'];

    public function stand()
    {
        return $this->belongsTo(Stand::class, 'stand_id', 'id');
    }
    
}
