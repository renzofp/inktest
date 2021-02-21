<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_numer', 'customer_id', 'total_price', 'fulfillment_status', 'fulfilled_date', 'order_status', 'customer_order_count'
    ];

    public function items()
    {
        return $this->belongsToMany(OrderItem::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderItem::class);
    }
}
