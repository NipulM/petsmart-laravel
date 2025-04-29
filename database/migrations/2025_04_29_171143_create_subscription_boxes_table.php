<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sixth Migration - Subscription Boxes Table
class CreateSubscriptionBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_boxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_id');
            $table->decimal('total_amount', 10, 2);
            $table->text('order_items');
            $table->dateTime('start_date')->useCurrent();
            $table->dateTime('expiry_date');
            $table->string('status', 20)->default('active');
            $table->dateTime('created_at')->useCurrent();
            $table->string('customer_name', 100);
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subscription_id')->references('subscription_id')->on('subscriptions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_boxes');
    }
}