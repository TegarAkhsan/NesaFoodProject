<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code',
        'name',
        'customer_name',
        'address',
        'delivery_type',
        'delivery_fee',
        'payment_method',
        'note',
        'promo_code',
        'status',
        'total',
    ];

    // Relasi ke OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
