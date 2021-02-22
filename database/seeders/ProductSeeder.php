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
        // possible sizes of products
        $sizes = ['1*1', '2*2', '3*3', '4*4', '5*2', '2*5'];

        // loop to generate 20 entries
        for ($i=0; $i < 20; $i++) {
            $products[] = [
                'title' => Str::random(10),
                'size' => $sizes[rand(0,5)], // grab a random size from the sizes array
                'price' => rand(5,100),
                'inventory_quantity' => 10000,
                'sku' => 'TAT-'.now()->year.'-'.Str::random(15)
            ];
        }

        // loop through the products array
        foreach ($products as $product) {
            // insert each one into the products table
            Product::insert($product);
        }
    }
}
