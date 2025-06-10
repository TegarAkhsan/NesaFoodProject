<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StandOwner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'stand_name'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'stand_id');
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItem::class, 'menu_id', 'id', 'id', 'order_id');
    }
}

