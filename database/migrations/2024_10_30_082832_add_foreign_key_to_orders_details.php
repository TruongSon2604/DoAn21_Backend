<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToOrdersDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            //
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            //
            $table->dropForeign(['orders_id']);
            $table->dropForeign(['products_id']);
        });
    }
}
