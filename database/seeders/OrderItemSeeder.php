<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // grab all ids from the order table and convert it into an array
        $order_ids = Order::all()->pluck('id')->toArray();

        // grab all ids from the products table and convert it into an array
        $product_ids = Product::all()->pluck('id')->toArray();

        // loop to generate 20 entries
        for ($i=0; $i < 20; $i++) {
            $orderItems[] = [
                'order_id' => $order_ids[rand(1, count($order_ids) - 1)], // grab a random id from the order_ids array
                'product_id' => $product_ids[rand(1, count($product_ids) - 1)], // grab a random id from the product_ids array
                'quantity' => rand(1,10)
            ];
        }

        // loop through the orderItems array
        foreach ($orderItems as $item) {
            // insert each into the order_item table
            OrderItem::insert($item);
        }
    }
}
