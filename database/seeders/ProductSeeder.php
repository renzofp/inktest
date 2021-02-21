<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sizes = ['1x1', '2x2', '3x3', '4x4', '5x2', '2x5'];

        for ($i=0; $i < 20; $i++) {
            $products[] = [
                'title' => Str::random(10),
                'size' => $sizes[rand(0,5)],
                'price' => rand(5,100),
                'inventory_quantity' => 10000,
                'sku' => 'TAT-'.now()->year.'-'.Str::random(15)
            ];
        }

        foreach ($products as $product) {
            Product::insert($product);
        }
    }
}
