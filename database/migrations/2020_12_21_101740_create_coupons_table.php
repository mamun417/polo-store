<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('slug');
            $table->string('apply_type');
            $table->integer('value');
            $table->integer('usable_quantity')->nullable()->comment('how many time you can use it');
            $table->integer('count')->nullable()->comment('how many time this coupon is used');
            $table->date('started_at');
            $table->date('expired_at');
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
