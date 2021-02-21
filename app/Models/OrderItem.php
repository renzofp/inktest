<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    protected $fillable = [
        'quantity', 'refund', 'resend_amount', 'order_id', 'product_id'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
