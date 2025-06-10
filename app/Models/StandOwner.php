<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
class StandOwner extends Authenticatable implements JWTSubject // ← Tambahkan interface
{
    use HasFactory, Notifiable;

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

    // === Tambahan untuk JWT ===
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Biasanya ID
    }

    public function getJWTCustomClaims()
    {
        return []; // Bisa isi tambahan jika mau
    }
}
