<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrintSheetItem;


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
        // get the total number of blocks in the grid that the product occupies
        $productSize = self::calculateSize($product->size);

        // my plan here begun to fall appart
        // i thought i would compare the number of blocks available (150 - the products already placed) against the $productSize and that would determine whether it would fit or not
        // but this doesn't account for shapes or overlaps... so it doesn't really work at all

        $checked = false;

        return $checked;
    }

    // function that places the product (item) into a printsheet
    public static function placeItem($product) {
        // variable to store the position of the placed item
        $position = null;

        // variable to get the width of the item
        $product_width_raw = explode('*', $product->size);
        $product_width = $product_width_raw[0];

        // variable to get the height of the item
        $product_height_raw = explode('*', $product->size);
        $product_height = $product_height_raw[1];

        // variable to get the corresponding entry in the order_product table
        $order_item_id = OrderItem::where('product_id', $product->orders()->first()->pivot->product_id)->where('order_id', $product->orders()->first()->pivot->order_id)->first()->id;

        // create a new entry in the print_sheet_item table with the product/order details
        $item = new PrintSheetItem();
        $item->width = $product_width;
        $item->height = $product_height;
        $item->x_pos = null; // not sure how to determine the x position
        $item->y_pos = null; // not sure how to determine the y position
        $item->order_item_id = $order_item_id;
        $item->ps_id = null; // need to create the printsheet before this
        $item->save();

        // return the position of the placed item
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
