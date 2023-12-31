<?php
// database/migrations/{timestamp}_create_countries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('shipping_rate', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
