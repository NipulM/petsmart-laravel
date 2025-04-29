<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Second Migration - Products Table
class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name', 255);
            $table->text('short_description');
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity');
            $table->boolean('is_seasonal')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description');
            $table->boolean('is_new')->default(0);
            
            $table->foreign('category_id')->references('category_id')->on('category');
            $table->index('is_new', 'idx_is_new');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
