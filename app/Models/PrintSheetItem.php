<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSheetItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'image_url', 'size', 'x_pos', 'y_pos', 'width', 'height', 'identifier', 'ps_id', 'order_item_id'
    ];

    // inverse hasmany relation with PrintSheet
    public function sheet()
    {
        return $this->belongsTo(PrintSheet::class);
    }

    // hasmany relation with OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
