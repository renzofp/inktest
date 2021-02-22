<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // count the number of orders in the orders table
        $orderCount = Order::count();

        // loop to generate 9 entries
        for ($i=0; $i < 9; $i++) {
            // increase the count by 1 since we're adding one
            $orderCount++;

            // data to insert into the orders table
            $orders[] = [
                'order_number' => $orderCount
            ];
        }

        // loop through the orders array
        foreach ($orders as $order) {
            // insert the data into the table
            Order::insert($order);
        }
    }
}
