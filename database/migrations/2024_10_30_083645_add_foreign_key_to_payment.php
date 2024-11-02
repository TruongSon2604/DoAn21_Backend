<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_method')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->dropForeign(['orders_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['status_id']);
        });
    }
}
