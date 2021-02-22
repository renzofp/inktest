<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_id', 'total_price', 'fulfillment_status', 'fulfilled_date', 'order_status', 'customer_order_count'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function generatePrintSheet($orders) {
        $ordered = self::orderBySize($orders);
        $doesItFit = null;

        foreach ($ordered as $key => $each) {
            $doesItFit = self::checkFit($each);

            if ($doesItFit) {
                self::placeItem($each);
                unset($ordered[$key]);
            }
        }

        if (empty($ordered)) return true;

        return false;
    }

    public static function orderbySize($orders) {
        $ordered = [];



        return $ordered;
    }

    public static function checkFit() {
        $checked = false;

        return $checked;
    }

    public static function placeItem() {
        $position = null;

        return $position;
    }
}
