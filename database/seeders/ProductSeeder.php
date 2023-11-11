<?php
// database/seeders/ProductSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'T-shirt', 'price' => 30.99, 'shipped_from' => 'US', 'weight' => 0.2],
            // Add other products
        ];

        DB::table('products')->insert($products);
    }
}

