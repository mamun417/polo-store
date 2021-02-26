<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shipping_method_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->float('shipping_charge')->nullable();
            $table->float('tax')->nullable();
            $table->float('sub_total');
            $table->float('grand_total');
            $table->integer('payment_status')->default(0)->comment('0 => unpaid, 1 => paid');
            $table->integer('order_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
