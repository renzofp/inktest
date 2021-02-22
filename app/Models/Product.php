<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'vendor', 'type', 'size', 'price', 'handle', 'inventory_quantity', 'sku', 'design_url', 'published_state'
    ];

    // many to many relationship with orders
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
