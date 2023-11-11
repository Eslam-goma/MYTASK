<?php
// database/seeders/CountrySeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'US', 'shipping_rate' => 2.00],
            // Add other countries
        ];

        DB::table('countries')->insert($countries);
    }
}

