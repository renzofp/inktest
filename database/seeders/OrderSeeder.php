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
        $orderCount = Order::count();

        for ($i=0; $i < 9; $i++) {
            $orderCount++;

            $orders[] = [
                'order_number' => $orderCount
            ];
        }

        foreach ($orders as $order) {
            Order::insert($order);
        }
    }
}
