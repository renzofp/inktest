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

    // many to many relationship with products
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // the function that encloses all the subprocesses to generate a print sheet from an order
    public static function generatePrintSheet($order) {
        // convert the order collection into an array
        $array_order = $order->toArray();

        // variable to determine whether the product fits on the printsheet or not
        $doesItFit = false;

        // varaible to determine whether the printsheet was generated or not
        $success = false;

        // loop through the products (items) in the order
        foreach ($order->products() as $key => $product) {
            // check if the product fits
            $doesItFit = self::checkFit($product);

            if ($doesItFit) {
                // if it fits, place it into the printsheet
                self::placeItem($product);

                // remove the product from the order array
                unset($array_order[$key]);
            }
        }

        // if all products were placed and removed, set success to true
        if (empty($array_order)) $success = true;

        // return result of the process
        return $success;
    }

    // function that checks if a product fits on a printsheet based on its size and the space available
    public static function checkFit($product) {

        $productSize = self::calculateSize($product->size);



        $checked = false;

        return $checked;
    }

    // function that places the product (item) into a printsheet
    public static function placeItem() {
        $position = null;

        return $position;
    }

    // function to process math within a string
    public static function calculateSize($expression) {
        if (preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $expression, $matches) !== FALSE) {
            $operator = $matches[2];

            switch($operator) {
                case '+':
                    $p = $matches[1] + $matches[3];
                    break;
                case '-':
                    $p = $matches[1] - $matches[3];
                    break;
                case '*':
                    $p = $matches[1] * $matches[3];
                    break;
                case '/':
                    $p = $matches[1] / $matches[3];
                    break;
            }

            return $p;
        }
    }
}
