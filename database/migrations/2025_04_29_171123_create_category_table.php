<?php

// First Migration - Categories Table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name', 255);
            $table->text('description')->nullable();
        });
        
        // Insert initial categories
        DB::table('category')->insert([
            ['category_id' => 1, 'name' => 'Food & Treats', 'description' => 'Nutritious food and treats for pets.'],
            ['category_id' => 2, 'name' => 'Toys & Entertainment', 'description' => 'Fun and engaging toys for pets.'],
            ['category_id' => 3, 'name' => 'Grooming & Hygiene', 'description' => 'Grooming essentials for cleanliness.']
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('category');
    }
}