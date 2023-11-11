
<?php
// database/seeders/ProductSeeder.php

use App\Models\CartItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



// database/seeders/CartItemSeeder.php
class CartItemSeeder extends Seeder

{
public function run()
{
    CartItem::create([
        'product_id' => 1, // Replace with a valid product ID
        'quantity' => 1,
    ]);
}
}