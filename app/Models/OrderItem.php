<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_product';

    protected $fillable = [
        'quantity', 'refund', 'resend_amount', 'order_id', 'product_id'
    ];

    // inverse hasMany relation with PrintSheetItem
    public function sheet_item()
    {
        return $this->belongsTo(PrintSheetItem::class);
    }
}
