<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seeders to call on artisan db:seed in order
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderItemSeeder::class);
    }
}
