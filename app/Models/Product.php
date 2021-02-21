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

    public function items()
    {
        return $this->belongsToMany(OrderItem::class);
    }
}
