<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/{timestamp}_add_quantity_to_cart_items_table.php

public function up()
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->integer('quantity'); // Make sure this line is present
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            //
        });
    }
};
