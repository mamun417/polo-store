<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('brand_id');
            $table->foreignId('tax_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('code')->nullable();
            $table->string('color')->nullable();
            $table->longText('details')->nullable();
            $table->integer('weight')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('feature')->default(false);
            $table->boolean('on_sale')->default(false);
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
        Schema::dropIfExists('products');
    }
}
