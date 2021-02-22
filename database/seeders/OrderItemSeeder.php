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
        $order_ids = Order::all()->pluck('id')->toArray();
        $product_ids = Product::all()->pluck('id')->toArray();

        for ($i=0; $i < 19; $i++) {
            $orderItems[] = [
                'order_id' => $order_ids[rand(1, count($order_ids) - 1)],
                'product_id' => $product_ids[rand(1, count($product_ids) - 1)],
                'quantity' => rand(1,10)
            ];
        }

        foreach ($orderItems as $item) {
            OrderItem::insert($item);
        }
    }
}
